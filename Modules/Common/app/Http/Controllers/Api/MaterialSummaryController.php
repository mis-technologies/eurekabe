<?php

namespace Modules\Common\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Modules\Common\Models\Material;
use Modules\Common\Models\MaterialSummary;
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
     * Return cached summary (free) or indicate it hasn't been generated yet.
     */
    public function show(Request $request, int $id)
    {
        $material = $this->findMaterial($request, $id);
        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        $length  = in_array($request->query('length'), ['short', 'medium', 'detailed'])
            ? $request->query('length') : 'short';

        $summary = MaterialSummary::where('material_id', $id)->where('length_type', $length)->first();

        if (!$summary) {
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
            'data'      => ['id' => $summary->id, 'length_type' => $summary->length_type, 'content' => $summary->content],
        ]);
    }

    /**
     * POST /v1/materials/{id}/summary/generate
     * Generate (or return existing) summary. Costs credits only on first generation.
     */
    public function generate(Request $request, int $id)
    {
        $request->validate(['length' => ['required', 'string', 'in:short,medium,detailed']]);

        $material = $this->findMaterial($request, $id);
        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        if (!$material->isReady()) {
            return response()->json(['status' => 'error', 'message' => 'Material text extraction failed. Cannot generate summary.'], 422);
        }

        $length  = $request->input('length');
        $featureKey = "material_summary_{$length}";

        // Return cached (free)
        $existing = MaterialSummary::where('material_id', $id)->where('length_type', $length)->first();
        if ($existing) {
            return response()->json([
                'status' => 'success',
                'data'   => ['id' => $existing->id, 'length_type' => $existing->length_type, 'content' => $existing->content],
            ]);
        }

        // Deduct credits
        $user = $request->user();
        if (!$this->credits->deduct($user, $featureKey)) {
            $account = $this->credits->getAccount($user);
            $cost    = $this->credits->getCost($featureKey);
            return $this->insufficientCredits($account->balance, $cost);
        }

        // Call OpenAI
        $config  = self::CONFIGS[$length];
        $system  = 'You are an expert academic summariser. Respond using Markdown (bold for key terms, bullet points for lists). Do not use LaTeX. Be clear and educational.';
        $prompt  = $config['instruction'] . "\n\nMaterial:\n" . $material->extracted_text;

        try {
            $content = $this->callOpenAI($system, $prompt, $config['max_tokens']);
        } catch (\Throwable $e) {
            $this->credits->refund($user, $featureKey);
            return response()->json(['status' => 'error', 'message' => 'AI service error. Credits have been refunded.'], 503);
        }

        $summary = MaterialSummary::create([
            'material_id' => $id,
            'length_type' => $length,
            'content'     => $content,
        ]);

        return response()->json([
            'status' => 'success',
            'data'   => ['id' => $summary->id, 'length_type' => $summary->length_type, 'content' => $summary->content],
        ], 201);
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function findMaterial(Request $request, int $id): ?Material
    {
        return Material::where('id', $id)->where('user_id', $request->user()->id)->first();
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
            'message' => "Insufficient credits. You have {$balance} credits but this action costs {$required}.",
            'data'    => ['balance' => $balance, 'required' => $required],
        ], 402);
    }
}
