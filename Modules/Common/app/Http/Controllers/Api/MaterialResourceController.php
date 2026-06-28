<?php

namespace Modules\Common\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Modules\Common\Models\Material;
use Modules\Common\Models\MaterialResource;
use Modules\Common\Services\CreditService;

class MaterialResourceController extends Controller
{
    public function __construct(private CreditService $credits) {}

    /**
     * GET /v1/materials/{id}/resources
     */
    public function index(Request $request, int $id)
    {
        $material = $this->findMaterial($request, $id);
        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        $resources = MaterialResource::where('material_id', $id)->get();

        return response()->json([
            'status'    => 'success',
            'generated' => $resources->isNotEmpty(),
            'cost'      => $resources->isEmpty() ? $this->credits->getCost('material_resources') : 0,
            'data'      => $resources,
        ]);
    }

    /**
     * POST /v1/materials/{id}/resources/generate
     * Idempotent: returns existing if already generated (no charge).
     */
    public function generate(Request $request, int $id)
    {
        $material = $this->findMaterial($request, $id);
        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        if (!$material->isReady()) {
            return response()->json(['status' => 'error', 'message' => 'Material text extraction failed. Cannot generate resources.'], 422);
        }

        // Idempotent — return existing for free
        $existing = MaterialResource::where('material_id', $id)->get();
        if ($existing->isNotEmpty()) {
            return response()->json(['status' => 'success', 'data' => $existing]);
        }

        // Deduct credits
        $user = $request->user();
        if (!$this->credits->deduct($user, 'material_resources')) {
            $account = $this->credits->getAccount($user);
            $cost    = $this->credits->getCost('material_resources');
            return $this->insufficientCredits($account->balance, $cost);
        }

        // Call OpenAI with JSON mode
        $system = 'You are an academic research assistant. You suggest relevant learning resources for students. Always respond with valid JSON only.';
        $prompt = 'Based on the following study material, suggest exactly 6 related learning resources a student could use to deepen their understanding. '
            . 'Return a JSON object with a "resources" array. Each item must have: '
            . '"title" (string), "type" (one of: article, video, journal, book, podcast), '
            . '"description" (one sentence), "author" (string or null). '
            . "\n\nMaterial:\n" . substr($material->extracted_text, 0, 6000);

        try {
            $parsed = $this->callOpenAIJson($system, $prompt, 1200);
        } catch (\Throwable $e) {
            $this->credits->refund($user, 'material_resources');
            return response()->json(['status' => 'error', 'message' => 'AI service error. Credits have been refunded.'], 503);
        }

        $items = $parsed['resources'] ?? [];
        if (empty($items) || !is_array($items)) {
            $this->credits->refund($user, 'material_resources');
            return response()->json(['status' => 'error', 'message' => 'AI returned an unexpected response. Credits have been refunded.'], 500);
        }

        $allowed = ['article', 'video', 'journal', 'book', 'podcast'];
        $toInsert = [];
        foreach (array_slice($items, 0, 6) as $item) {
            $type = in_array($item['type'] ?? '', $allowed) ? $item['type'] : 'article';
            $toInsert[] = [
                'material_id' => $id,
                'title'       => substr($item['title'] ?? 'Untitled', 0, 255),
                'type'        => $type,
                'description' => $item['description'] ?? '',
                'author'      => isset($item['author']) && $item['author'] ? substr($item['author'], 0, 255) : null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        MaterialResource::insert($toInsert);

        return response()->json([
            'status' => 'success',
            'data'   => MaterialResource::where('material_id', $id)->get(),
        ], 201);
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function findMaterial(Request $request, int $id): ?Material
    {
        return Material::where('id', $id)->where('user_id', $request->user()->id)->first();
    }

    private function callOpenAIJson(string $system, string $prompt, int $maxTokens): array
    {
        $response = Http::withToken(config('services.openai.key'))
            ->timeout(60)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model'           => 'gpt-4o-mini',
                'max_tokens'      => $maxTokens,
                'temperature'     => 0.6,
                'response_format' => ['type' => 'json_object'],
                'messages'        => [
                    ['role' => 'system', 'content' => $system],
                    ['role' => 'user',   'content' => $prompt],
                ],
            ]);

        if (!$response->successful()) {
            throw new \RuntimeException('OpenAI request failed: ' . $response->status());
        }

        $content = $response->json('choices.0.message.content', '');
        $parsed  = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Failed to parse AI JSON response.');
        }

        return $parsed;
    }

    private function insufficientCredits(int $balance, int $required)
    {
        return response()->json([
            'status'  => 'error',
            'code'    => 'INSUFFICIENT_CREDITS',
            'message' => "Insufficient credits. You have {$balance} credits but this action costs {$required}.",
            'data'    => ['balance' => $balance, 'required' => $required],
        ], 402);
    }
}
