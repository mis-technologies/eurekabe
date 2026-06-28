<?php

namespace Modules\Common\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Modules\Common\Models\Material;
use Modules\Common\Models\MaterialQuestion;
use Modules\Common\Services\CreditService;

class MaterialQuestionController extends Controller
{
    public function __construct(private CreditService $credits) {}

    /**
     * GET /v1/materials/{id}/questions
     * Returns all generated questions, filterable by type and difficulty.
     */
    public function index(Request $request, int $id)
    {
        $material = $this->findMaterial($request, $id);
        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        $query = MaterialQuestion::where('material_id', $id);

        if ($request->has('type') && in_array($request->query('type'), ['mcq', 'theory'])) {
            $query->where('question_type', $request->query('type'));
        }
        if ($request->has('difficulty') && in_array($request->query('difficulty'), ['easy', 'medium', 'hard'])) {
            $query->where('difficulty', $request->query('difficulty'));
        }

        $questions = $query->orderBy('created_at')->get();

        return response()->json([
            'status'    => 'success',
            'generated' => $questions->isNotEmpty(),
            'cost_per_question' => $this->credits->getCost('material_questions'),
            'data'      => $questions,
        ]);
    }

    /**
     * POST /v1/materials/{id}/questions/generate
     * Generate new questions (accumulates — does not replace existing).
     */
    public function generate(Request $request, int $id)
    {
        $request->validate([
            'type'                 => ['required', 'string', 'in:mcq,theory'],
            'difficulty'           => ['required', 'string', 'in:easy,medium,hard'],
            'count'                => ['nullable', 'integer', 'min:1', 'max:20'],
            'past_questions_text'  => ['nullable', 'string', 'max:8000'],
        ]);

        $material = $this->findMaterial($request, $id);
        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        if (!$material->isReady()) {
            return response()->json(['status' => 'error', 'message' => 'Material text extraction failed. Cannot generate questions.'], 422);
        }

        $count      = (int) ($request->input('count') ?? 10);
        $type       = $request->input('type');
        $difficulty = $request->input('difficulty');
        $pastText   = $request->input('past_questions_text');

        // Deduct credits (cost × count)
        $user = $request->user();
        if (!$this->credits->deduct($user, 'material_questions', $count)) {
            $account = $this->credits->getAccount($user);
            $cost    = $this->credits->getCost('material_questions', $count);
            return $this->insufficientCredits($account->balance, $cost);
        }

        // Build prompt
        $typeLabel       = $type === 'mcq' ? 'multiple-choice (MCQ)' : 'theory/essay';
        $difficultyLabel = ucfirst($difficulty);

        $schemaInstruction = $type === 'mcq'
            ? 'Each item must have: "question" (string), "options" (array of exactly 4 strings), "correct_answer" (string: "A", "B", "C", or "D"), "explanation" (string).'
            : 'Each item must have: "question" (string), "correct_answer" (string — a model answer paragraph), "explanation" (string). Omit the "options" field.';

        $pastContext = $pastText
            ? "\n\nAdditionally, here are previous exam questions from this course (use these to help predict the style and focus areas of likely future questions):\n{$pastText}"
            : '';

        $system = 'You are an expert exam question writer for Nigerian university students. Always respond with valid JSON only.';
        $prompt = "Generate exactly {$count} {$difficultyLabel} difficulty {$typeLabel} practice questions based on the following study material. "
            . "Return a JSON object with a \"questions\" array. {$schemaInstruction}"
            . "\n\nStudy Material:\n" . substr($material->extracted_text, 0, 8000)
            . $pastContext;

        try {
            $parsed = $this->callOpenAIJson($system, $prompt, min(4000, $count * 200));
        } catch (\Throwable $e) {
            $this->credits->refund($user, 'material_questions', $count);
            return response()->json(['status' => 'error', 'message' => 'AI service error. Credits have been refunded.'], 503);
        }

        $items = $parsed['questions'] ?? [];
        if (empty($items) || !is_array($items)) {
            $this->credits->refund($user, 'material_questions', $count);
            return response()->json(['status' => 'error', 'message' => 'AI returned an unexpected response. Credits have been refunded.'], 500);
        }

        $toInsert = [];
        foreach (array_slice($items, 0, $count) as $item) {
            $options = null;
            if ($type === 'mcq' && isset($item['options']) && is_array($item['options'])) {
                $options = array_slice(array_values($item['options']), 0, 4);
            }

            $toInsert[] = [
                'material_id'   => $id,
                'question'      => $item['question'] ?? '',
                'question_type' => $type,
                'difficulty'    => $difficulty,
                'options'       => $options ? json_encode($options) : null,
                'correct_answer' => $item['correct_answer'] ?? null,
                'explanation'   => $item['explanation'] ?? null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        MaterialQuestion::insert($toInsert);

        $newIds     = MaterialQuestion::where('material_id', $id)->latest('id')->limit(count($toInsert))->pluck('id');
        $newQuestions = MaterialQuestion::whereIn('id', $newIds)->get();

        return response()->json(['status' => 'success', 'data' => $newQuestions], 201);
    }

    /**
     * DELETE /v1/materials/{id}/questions
     * Delete all questions for this material (free — allows regeneration from scratch).
     */
    public function destroyAll(Request $request, int $id)
    {
        $material = $this->findMaterial($request, $id);
        if (!$material) {
            return response()->json(['status' => 'error', 'message' => 'Material not found.'], 404);
        }

        MaterialQuestion::where('material_id', $id)->delete();

        return response()->json(null, 204);
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function findMaterial(Request $request, int $id): ?Material
    {
        return Material::where('id', $id)->where('user_id', $request->user()->id)->first();
    }

    private function callOpenAIJson(string $system, string $prompt, int $maxTokens): array
    {
        $response = Http::withToken(config('services.openai.key'))
            ->timeout(90)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model'           => 'gpt-4o-mini',
                'max_tokens'      => $maxTokens,
                'temperature'     => 0.7,
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
