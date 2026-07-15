<?php

namespace Modules\Common\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Common\Models\CreditPlan;
use Modules\Common\Models\Payment;
use Modules\Common\Services\CreditService;
use Modules\Common\Services\PaystackService;

class PaymentController extends Controller
{
    public function __construct(
        private CreditService $creditService,
        private PaystackService $paystackService,
    ) {}

    /**
     * POST /v1/credits/payment/initiate
     */
    public function initiate(Request $request)
    {
        $request->validate(['plan_id' => 'required|integer|exists:credit_plans,id']);

        $user = Auth::user();
        $plan = CreditPlan::findOrFail($request->plan_id);

        if (!$plan->is_active) {
            return response()->json(['status' => 'error', 'message' => 'Plan is not available.'], 400);
        }

        if ($plan->price_ngn === 0) {
            return response()->json(['status' => 'error', 'message' => 'Free plan requires no payment.'], 400);
        }

        $payment = Payment::create([
            'user_id'            => $user->id,
            'plan_id'            => $plan->id,
            'paystack_reference' => 'EK_' . Str::upper(Str::random(12)) . '_' . time(),
            'amount'             => $plan->price_ngn,
            'status'             => 'pending',
        ]);

        try {
            $data = $this->paystackService->initiate($user, $plan, $payment);
            return response()->json(['status' => 'success', 'data' => $data]);
        } catch (\Exception $e) {
            $payment->update(['status' => 'failed']);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * GET /v1/credits/payment/verify/{reference}
     */
    public function verify(string $reference)
    {
        $payment = Payment::where('paystack_reference', $reference)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($payment->status === 'success') {
            return response()->json(['status' => 'success', 'message' => 'Payment already processed.', 'data' => ['status' => 'success']]);
        }

        try {
            $data = $this->paystackService->verify($reference);

            if ($data['status'] === 'success') {
                $this->processSuccessfulPayment($payment);
                return response()->json(['status' => 'success', 'data' => ['status' => 'success', 'plan' => $payment->plan]]);
            }

            $payment->update(['status' => 'failed', 'meta' => $data]);
            return response()->json(['status' => 'error', 'message' => 'Payment was not successful.', 'data' => ['status' => $data['status']]], 402);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * POST /v1/credits/payment/webhook (no auth middleware)
     */
    public function webhook(Request $request)
    {
        $payload   = $request->getContent();
        $signature = $request->header('X-Paystack-Signature', '');

        if (!$this->paystackService->validateWebhook($payload, $signature)) {
            return response()->json(['message' => 'Invalid signature'], 401);
        }

        $event = json_decode($payload, true);

        if (($event['event'] ?? '') === 'charge.success') {
            $reference = $event['data']['reference'] ?? null;
            if ($reference) {
                $payment = Payment::where('paystack_reference', $reference)
                    ->where('status', 'pending')
                    ->first();

                if ($payment) {
                    $this->processSuccessfulPayment($payment, $event['data']);
                }
            }
        }

        return response()->json(['status' => 'success']);
    }

    private function processSuccessfulPayment(Payment $payment, array $meta = []): void
    {
        $payment->update([
            'status'       => 'success',
            'processed_at' => now(),
            'meta'         => $meta ?: null,
        ]);

        $user = $payment->user;
        $plan = $payment->plan;

        $this->creditService->assignPlan($user, $plan);
    }
}
