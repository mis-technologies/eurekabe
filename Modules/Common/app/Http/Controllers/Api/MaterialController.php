<?php

namespace Modules\Common\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Common\Models\Material;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Admin\AdminApi;

class MaterialController extends Controller
{
    /**
     * GET /v1/materials
     * List the authenticated user's uploaded materials (paginated, no extracted_text).
     */
    public function index(Request $request)
    {
        $materials = Material::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(15, ['id', 'title', 'original_filename', 'path', 'word_count', 'status', 'created_at', 'updated_at']);

        return response()->json(['status' => 'success', 'data' => $materials]);
    }

    /**
     * POST /v1/materials
     * Upload a PDF or TXT file, extract text, and save the material.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file'  => ['required', 'file', 'mimes:pdf,txt', 'max:20480'],
            'title' => ['nullable', 'string', 'max:255'],
        ]);

        $file             = $request->file('file');
        $originalFilename = $file->getClientOriginalName();
        $title            = $request->input('title') ?: pathinfo($originalFilename, PATHINFO_FILENAME);
        $extension        = strtolower($file->getClientOriginalExtension());

        // ── Upload to Cloudinary ──────────────────────────────────────────────
        $cloudinaryUrl = null;
        try {
            $this->configureCloudinary();
            $result = (new UploadApi())->upload($file->getRealPath(), [
                'folder'        => 'materials',
                'resource_type' => 'raw',
                'overwrite'     => false,
            ]);
            $cloudinaryUrl = $result['secure_url'];
        } catch (\Throwable $e) {
            // Non-fatal: we can still store the material without a permanent URL
            $cloudinaryUrl = '';
        }

        // ── Extract text ──────────────────────────────────────────────────────
        $extractedText = null;
        $status        = 'failed';

        try {
            if ($extension === 'pdf') {
                $parser        = new \Smalot\PdfParser\Parser();
                $pdf           = $parser->parseFile($file->getRealPath());
                $extractedText = $pdf->getText();
            } else {
                $extractedText = file_get_contents($file->getRealPath());
            }

            if ($extractedText !== null) {
                // Truncate to 100,000 chars to stay within AI token limits
                if (strlen($extractedText) > 100000) {
                    $extractedText = substr($extractedText, 0, 100000)
                        . "\n\n[Note: Document was truncated to 100,000 characters.]";
                }
                $status = 'ready';
            }
        } catch (\Throwable $e) {
            $extractedText = null;
            $status        = 'failed';
        }

        $wordCount = $extractedText ? str_word_count($extractedText) : null;

        $material = Material::create([
            'user_id'           => $request->user()->id,
            'title'             => $title,
            'original_filename' => $originalFilename,
            'path'              => $cloudinaryUrl,
            'extracted_text'    => $extractedText,
            'word_count'        => $wordCount,
            'status'            => $status,
        ]);

        if ($status === 'failed') {
            return response()->json([
                'status'  => 'error',
                'message' => 'Could not extract text from this file. Please ensure the PDF contains selectable text (not a scanned image).',
                'data'    => $this->materialResource($material),
            ], 422);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Material uploaded successfully.',
            'data'    => $this->materialResource($material),
        ], 201);
    }

    /**
     * GET /v1/materials/{id}
     */
    public function show(Request $request, int $id)
    {
        $material = Material::where('id', $id)->where('user_id', $request->user()->id)->first();

        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $this->materialResource($material)]);
    }

    /**
     * DELETE /v1/materials/{id}
     */
    public function destroy(Request $request, int $id)
    {
        $material = Material::where('id', $id)->where('user_id', $request->user()->id)->first();

        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        // Best-effort Cloudinary delete
        if ($material->path) {
            try {
                $this->configureCloudinary();
                // Extract public_id from URL (everything between /materials/ and the extension)
                if (preg_match('/\/materials\/(.+?)(?:\.\w+)?$/', $material->path, $m)) {
                    (new AdminApi())->deleteAssets(["materials/{$m[1]}"], ['resource_type' => 'raw']);
                }
            } catch (\Throwable) {
                // Ignore Cloudinary errors on delete
            }
        }

        $material->delete();

        return response()->json(['status' => 'success', 'message' => 'Material deleted.']);
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function materialResource(Material $m): array
    {
        return [
            'id'                => $m->id,
            'title'             => $m->title,
            'original_filename' => $m->original_filename,
            'path'              => $m->path,
            'word_count'        => $m->word_count,
            'status'            => $m->status,
            'created_at'        => $m->created_at?->toISOString(),
            'updated_at'        => $m->updated_at?->toISOString(),
        ];
    }

    private function configureCloudinary(): void
    {
        Configuration::instance([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key'    => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => ['secure' => true],
        ]);
    }
}
