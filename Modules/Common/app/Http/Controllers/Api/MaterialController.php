<?php

namespace Modules\Common\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Common\Facades\FileFacade;
use Modules\Common\Jobs\ProcessMaterialJob;
use Modules\Common\Models\Material;

class MaterialController extends Controller
{
    /**
     * GET /v1/materials
     * List the authenticated user's materials (paginated).
     */
    public function index(Request $request)
    {
        $materials = Material::where('user_id', $request->user()->id)
            ->with('file')
            ->orderByDesc('created_at')
            ->paginate(15, ['id', 'file_id', 'title', 'original_filename', 'word_count', 'status', 'created_at', 'updated_at']);

        return response()->json(['status' => 'success', 'data' => $materials->through(
            fn ($m) => $this->materialResource($m)
        )]);
    }

    /**
     * POST /v1/materials
     * Upload a PDF or TXT file. Returns immediately with status=processing.
     * Text extraction runs asynchronously via ProcessMaterialJob.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file'  => ['required', 'file', 'mimes:pdf,txt', 'max:20480'],
            'title' => ['nullable', 'string', 'max:255'],
        ]);

        $file     = $request->file('file');
        $title    = $request->input('title') ?: pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        // Keep the upload on local disk only until text extraction finishes;
        // ProcessMaterialJob deletes it afterwards. No remote storage needed.
        $path = $file->store('material-uploads', 'local');

        $material = Material::create([
            'user_id'           => $request->user()->id,
            'title'             => $title,
            'original_filename' => $file->getClientOriginalName(),
            'path'              => $path,
            'status'            => 'processing',
        ]);

        // Dispatch async job to extract text and update status
        ProcessMaterialJob::dispatch($material->id);

        return response()->json([
            'status'  => 'success',
            'message' => 'Material uploaded. Text extraction is processing.',
            'data'    => $this->materialResource($material->fresh('file')),
        ], 201);
    }

    /**
     * GET /v1/materials/{id}
     */
    public function show(Request $request, int $id)
    {
        $material = $this->findMaterial($request, $id);

        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $this->materialResource($material)]);
    }

    /**
     * DELETE /v1/materials/{id}
     * Deletes the material, its linked File (+ Cloudinary asset), and its practice exam.
     */
    public function destroy(Request $request, int $id)
    {
        $material = $this->findMaterial($request, $id);

        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        // Remove any upload still waiting to be processed
        if ($material->path) {
            \Illuminate\Support\Facades\Storage::disk('local')->delete($material->path);
        }

        // Legacy rows: file stored via FileFacade (Cloudinary/public disk)
        if ($material->file) {
            FileFacade::deleteRawFile($material->file);
        }

        // Cascade handles questions; also delete linked private practice exam
        $material->practiceExam?->delete();
        $material->delete();

        return response()->json(['status' => 'success', 'message' => 'Material deleted.']);
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function findMaterial(Request $request, int $id): ?Material
    {
        return Material::with('file')->where('id', $id)->where('user_id', $request->user()->id)->first();
    }

    private function materialResource(Material $m): array
    {
        return [
            'id'                => $m->id,
            'title'             => $m->title,
            'original_filename' => $m->display_filename,
            'path'              => $m->file?->path,
            'word_count'        => $m->word_count,
            'status'            => $m->status,
            'created_at'        => $m->created_at?->toISOString(),
            'updated_at'        => $m->updated_at?->toISOString(),
        ];
    }
}
