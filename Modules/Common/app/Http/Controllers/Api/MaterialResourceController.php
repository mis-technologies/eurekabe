<?php

namespace Modules\Common\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Modules\Common\Models\Material;
use Modules\Common\Services\CreditService;

class MaterialResourceController extends Controller
{
    public function __construct(private CreditService $credits) {}

    /**
     * GET /v1/materials/{id}/resources
     * Returns the resources JSON stored on the material (no cost).
     */
    public function index(Request $request, int $id)
    {
        $material = $this->findMaterial($request, $id);
        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        $resources = $material->resources ?? [];

        return response()->json([
            'status'    => 'success',
            'generated' => !empty($resources),
            'cost'      => empty($resources) ? $this->credits->getCost('material_resources') : 0,
            'data'      => $resources,
        ]);
    }

    /**
     * POST /v1/materials/{id}/resources/generate
     * Generate resource suggestions via AI and store as JSON on the Material. Idempotent.
     */
    public function generate(Request $request, int $id)
    {
        $material = $this->findMaterial($request, $id);
        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        if ($material->isProcessing()) {
            return response()->json(['status' => 'error', 'message' => 'Material is still being processed. Please try again shortly.'], 422);
        }

        if (!$material->isReady()) {
            return response()->json(['status' => 'error', 'message' => 'Text extraction failed for this material.'], 422);
        }

        // Idempotent — return existing for free
        if (!empty($material->resources)) {
            return response()->json(['status' => 'success', 'data' => $material->resources]);
        }

        // Deduct credits
        $user = $request->user();
        if (!$this->credits->deduct($user, 'material_resources')) {
            $account = $this->credits->getAccount($user);
            return $this->insufficientCredits($account->balance, $this->credits->getCost('material_resources'));
        }

        $system = 'You are an academic research assistant. You suggest relevant learning resources for students. Always respond with valid JSON only.';
        $prompt = 'Based on the following study material, suggest exactly 6 related learning resources a student could use to deepen their understanding. '
            . 'Return a JSON object with a "resources" array. Each item must have: '
            . '"title" (string), "type" (one of: article, video, journal, book, podcast), '
            . '"description" (one sentence), "author" (string or null). '
            . "\n\nMaterial:\n" . substr($material->extracted_text, 0, 6000);

        try {
            $parsed = $this->callOpenAIJson($system, $prompt, 1200);
        } catch (\Throwable) {
            $this->credits->refund($user, 'material_resources');
            return response()->json(['status' => 'error', 'message' => 'AI service error. Credits have been refunded.'], 503);
        }

        $items   = $parsed['resources'] ?? [];
        $allowed = ['article', 'video', 'journal', 'book', 'podcast'];

        if (empty($items) || !is_array($items)) {
            $this->credits->refund($user, 'material_resources');
            return response()->json(['status' => 'error', 'message' => 'AI returned an unexpected response. Credits have been refunded.'], 500);
        }

        $resources = [];
        foreach (array_slice($items, 0, 6) as $item) {
            $resources[] = [
                'title'       => substr($item['title'] ?? 'Untitled', 0, 255),
                'type'        => in_array($item['type'] ?? '', $allowed) ? $item['type'] : 'article',
                'description' => $item['description'] ?? '',
                'author'      => isset($item['author']) && $item['author'] ? substr($item['author'], 0, 255) : null,
            ];
        }

        $material->update(['resources' => $resources]);

        return response()->json(['status' => 'success', 'data' => $resources], 201);
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

        $parsed = json_decode($response->json('choices.0.message.content', ''), true);

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
            'message' => "Insufficient credits. You have {$balance} but this action costs {$required}.",
            'data'    => ['balance' => $balance, 'required' => $required],
        ], 402);
    }
}
