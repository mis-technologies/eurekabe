<?php

namespace Modules\Common\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Modules\Common\Models\Material;
use Modules\Common\Services\CreditService;

class MaterialSummaryController extends Controller
{
    private const CONFIGS = [
        'short'    => ['max_tokens' => 350,  'instruction' => 'List exactly 5 key concepts from this material as bullet points. Be concise.'],
        'medium'   => ['max_tokens' => 900,  'instruction' => 'Break down the major sections of this material. Write a short paragraph for each section.'],
        'detailed' => ['max_tokens' => 2200, 'instruction' => 'Produce a comprehensive breakdown of this material covering all major concepts, examples, definitions, and key implications. Use bullet points and sub-sections as appropriate.'],
    ];

    public function __construct(private CreditService $credits) {}

    /**
     * GET /v1/materials/{id}/summary?length=short|medium|detailed
     * Returns the cached summary from the Material column (free).
     */
    public function show(Request $request, int $id)
    {
        $material = $this->findMaterial($request, $id);
        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        $length  = $this->validLength($request->query('length'));
        $content = $material->summary($length);

        if (!$content) {
            return response()->json([
                'status'    => 'success',
                'generated' => false,
                'data'      => null,
                'cost'      => $this->credits->getCost("material_summary_{$length}"),
            ]);
        }

        return response()->json([
            'status'    => 'success',
            'generated' => true,
            'data'      => ['length_type' => $length, 'content' => $content],
        ]);
    }

    /**
     * POST /v1/materials/{id}/summary/generate
     * Generate summary via AI and store in the Material column. Idempotent (free on repeat).
     */
    public function generate(Request $request, int $id)
    {
        $request->validate(['length' => ['required', 'string', 'in:short,medium,detailed']]);

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

        $length     = $this->validLength($request->input('length'));
        $featureKey = "material_summary_{$length}";

        // Return cached (free)
        $existing = $material->summary($length);
        if ($existing) {
            return response()->json([
                'status' => 'success',
                'data'   => ['length_type' => $length, 'content' => $existing],
            ]);
        }

        // Deduct credits
        $user = $request->user();
        if (!$this->credits->deduct($user, $featureKey)) {
            $account = $this->credits->getAccount($user);
            return $this->insufficientCredits($account->balance, $this->credits->getCost($featureKey));
        }

        $config = self::CONFIGS[$length];
        $prompt = $config['instruction'] . "\n\nMaterial:\n" . $material->extracted_text;

        try {
            $content = $this->callOpenAI(
                'You are an expert academic summariser. Respond using Markdown (bold for key terms, bullet points for lists). Do not use LaTeX. Be clear and educational.',
                $prompt,
                $config['max_tokens'],
            );
        } catch (\Throwable) {
            $this->credits->refund($user, $featureKey);
            return response()->json(['status' => 'error', 'message' => 'AI service error. Credits have been refunded.'], 503);
        }

        $material->setSummary($length, $content);

        return response()->json([
            'status' => 'success',
            'data'   => ['length_type' => $length, 'content' => $content],
        ], 201);
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function findMaterial(Request $request, int $id): ?Material
    {
        return Material::where('id', $id)->where('user_id', $request->user()->id)->first();
    }

    private function validLength(?string $length): string
    {
        return in_array($length, ['short', 'medium', 'detailed']) ? $length : 'short';
    }

    private function callOpenAI(string $system, string $prompt, int $maxTokens): string
    {
        $response = Http::withToken(config('services.openai.key'))
            ->timeout(60)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model'       => 'gpt-4o-mini',
                'max_tokens'  => $maxTokens,
                'temperature' => 0.5,
                'messages'    => [
                    ['role' => 'system', 'content' => $system],
                    ['role' => 'user',   'content' => $prompt],
                ],
            ]);

        if (!$response->successful()) {
            throw new \RuntimeException('OpenAI request failed: ' . $response->status());
        }

        return trim($response->json('choices.0.message.content', ''));
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
