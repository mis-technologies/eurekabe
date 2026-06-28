<?php

namespace Modules\Common\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Modules\Common\Models\Exam;
use Modules\Common\Services\CreditService;

class AiTutorController extends Controller
{
    /**
     * Flexible AI tutor endpoint.
     *
     * POST /ai/ask
     *
     * Payload:
     *   type    – "hint" | "explain" | "chat"
     *   context – object with type-specific fields (see buildPrompt)
     */
    public function ask(Request $request)
    {
        $validated = $request->validate([
            'type'    => ['required', 'string', 'in:hint,explain,chat'],
            'context' => ['required', 'array'],
        ]);

        // Block hints if the exam has AI hints disabled
        if ($validated['type'] === 'hint' && !empty($validated['context']['exam_id'])) {
            $exam = Exam::find($validated['context']['exam_id']);
            if ($exam && !$exam->allow_ai_hints) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'AI hints are disabled for this exam.',
                ], 403);
            }
        }

        // ── Credit check & deduction ───────────────────────────────────────────
        $featureKey = match ($validated['type']) {
            'hint'    => 'ai_hint',
            'explain' => 'ai_explain',
            default   => 'ai_chat_message',
        };

        $credits = app(CreditService::class);
        $user    = $request->user();

        if (!$credits->deduct($user, $featureKey)) {
            $account = $credits->getAccount($user);
            $cost    = $credits->getCost($featureKey);
            return response()->json([
                'status'  => 'error',
                'code'    => 'INSUFFICIENT_CREDITS',
                'message' => "Insufficient credits. You have {$account->balance} credits but this action costs {$cost}.",
                'data'    => ['balance' => $account->balance, 'required' => $cost],
            ], 402);
        }

        [$system, $messages] = $this->buildMessages($validated['type'], $validated['context']);

        $response = Http::withToken(config('services.openai.key'))
            ->timeout(30)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model'       => 'gpt-4o-mini',
                'max_tokens'  => 600,
                'temperature' => 0.7,
                'messages'    => array_merge(
                    [['role' => 'system', 'content' => $system]],
                    $messages,
                ),
            ]);

        if (!$response->successful()) {
            $credits->refund($user, $featureKey);
            return response()->json([
                'status'  => 'error',
                'message' => 'AI service unavailable. Credits have been refunded.',
            ], 502);
        }

        $reply = $response->json('choices.0.message.content', '');

        return response()->json([
            'status' => 'success',
            'data'   => ['reply' => trim($reply)],
        ]);
    }

    // ─── Message builder ──────────────────────────────────────────────────────

    /**
     * Returns [$systemPrompt, $messagesArray] where $messagesArray is ready
     * to be merged after the system message in the OpenAI payload.
     */
    private function buildMessages(string $type, array $ctx): array
    {
        $base = 'You are Eureka AI, a friendly and concise academic tutor for Nigerian university and secondary school students. '
              . 'Keep responses short and encouraging. Never be condescending. '
              . 'Format responses using Markdown: use **bold** for key terms, `inline code` for formulas or variables, '
              . 'and numbered lists or bullet points for steps. '
              . 'Do NOT use headings (no # ## ###) — plain bold text and lists are enough for a chat interface. '
              . 'For mathematics, write symbols directly using Unicode — x² not x^2, √ not \\sqrt, × for multiply, '
              . '÷ for divide, ± for plus-minus, π for pi, ∞ for infinity, ≠ ≤ ≥ for comparisons. '
              . 'Write fractions as (numerator)/(denominator), e.g. `(-b ± √(b²-4ac)) / 2a`. '
              . 'NEVER use LaTeX notation (no \\( \\), \\[ \\], \\frac, \\sqrt{}, or any backslash commands).';

        return match ($type) {

            // Single-shot hint — no history needed
            'hint' => [
                $base . ' When asked for a hint, guide the student toward the answer without stating it outright.',
                [['role' => 'user', 'content' => $this->examContext($ctx) . "\n\nThe student needs a hint. Give a helpful nudge."]],
            ],

            // Single-shot explanation — no history needed
            'explain' => [
                $base . ' Explain answers clearly, covering the key concept and why the correct option is right.',
                [['role' => 'user', 'content'
                    => $this->examContext($ctx)
                    . "\n\nThe correct answer is: {$ctx['correct_option']}."
                    . (isset($ctx['selected_option']) ? " The student chose: {$ctx['selected_option']}." : '')
                    . "\n\nExplain why the correct answer is right.",
                ]],
            ],

            // Multi-turn chat — prepend conversation history
            'chat' => [
                $base . ' Answer any academic question clearly and concisely.',
                array_merge(
                    $this->formatHistory($ctx['history'] ?? []),
                    [['role' => 'user', 'content' => $ctx['user_message'] ?? 'Hello']],
                ),
            ],
        };
    }

    /**
     * Sanitise and cap history to the last 20 messages (~10 turns).
     */
    private function formatHistory(array $history): array
    {
        $allowed = array_slice($history, -20);

        return array_values(array_map(fn ($m) => [
            'role'    => in_array($m['role'] ?? '', ['user', 'assistant']) ? $m['role'] : 'user',
            'content' => (string) ($m['content'] ?? ''),
        ], $allowed));
    }

    private function examContext(array $ctx): string
    {
        $lines = [];

        if (!empty($ctx['subject']))  $lines[] = "Subject: {$ctx['subject']}";
        if (!empty($ctx['question'])) $lines[] = "Question: {$ctx['question']}";

        if (!empty($ctx['options']) && is_array($ctx['options'])) {
            $letters = ['A', 'B', 'C', 'D', 'E'];
            $opts = [];
            foreach (array_values($ctx['options']) as $i => $opt) {
                $label  = $letters[$i] ?? ($i + 1);
                $text   = is_array($opt) ? ($opt['option'] ?? '') : $opt;
                $opts[] = "{$label}. {$text}";
            }
            $lines[] = 'Options: ' . implode(' | ', $opts);
        }

        return implode("\n", $lines);
    }
}
