<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Common\Models\CreditPlan;
use Modules\Common\Models\CreditTransaction;
use Modules\Common\Models\Payment;
use Modules\Common\Services\CreditService;
use Modules\Common\Services\PaymentFulfillmentService;
use Modules\Common\Services\PaystackService;

/**
 * The web counterpart to the mobile app's in-app Paystack flow — reachable
 * only via the signed link emailed by CreditService::notifyLowBalance(), for
 * users (iOS) who have no in-app purchasing surface. Reuses the same
 * PaystackService/PaymentFulfillmentService as mobile and the Apple IAP flow,
 * so crediting logic isn't duplicated anywhere.
 */
class CreditsWebController extends Controller
{
    public function __construct(
        private CreditService $creditService,
        private PaystackService $paystackService,
        private PaymentFulfillmentService $fulfillmentService,
    ) {}

    /**
     * GET /credits/topup — the signed entry point from the email.
     */
    public function show(Request $request)
    {
        $user = User::findOrFail($request->query('user'));
        $request->session()->put('credits_web_user_id', $user->id);

        return $this->renderTopupPage($user);
    }

    /**
     * POST /credits/topup/initiate
     */
    public function initiatePayment(Request $request)
    {
        $request->validate([
            'plan_id'  => 'required|integer|exists:credit_plans,id',
            'quantity' => 'nullable|integer|min:1|max:100',
        ]);

        $user = User::findOrFail($request->session()->get('credits_web_user_id'));
        $plan = CreditPlan::findOrFail($request->input('plan_id'));

        if (!$plan->is_active || $plan->price_ngn === 0) {
            return back()->withErrors(['plan_id' => 'That plan is not available.']);
        }

        $quantity = $plan->type === 'pay_as_you_go' ? (int) $request->input('quantity', 1) : 1;

        $payment = Payment::create([
            'user_id'            => $user->id,
            'plan_id'            => $plan->id,
            'quantity'           => $quantity,
            'paystack_reference' => 'EKW_' . Str::upper(Str::random(12)) . '_' . time(),
            'amount'             => $plan->price_ngn * $quantity,
            'status'             => 'pending',
        ]);

        try {
            $data = $this->paystackService->initiate($user, $plan, $payment, route('credits.web.callback'));
            return redirect($data['authorization_url']);
        } catch (\Exception $e) {
            $payment->update(['status' => 'failed']);
            return back()->withErrors(['plan_id' => 'Could not start payment. Please try again.']);
        }
    }

    /**
     * GET /credits/topup/callback — Paystack redirects here after payment.
     */
    public function callback(Request $request)
    {
        $payment = Payment::where('paystack_reference', $request->query('reference'))->firstOrFail();

        abort_unless(
            $payment->user_id === (int) $request->session()->get('credits_web_user_id'),
            403
        );

        if ($payment->status !== 'success') {
            try {
                $data = $this->paystackService->verify($payment->paystack_reference);

                if (($data['status'] ?? null) === 'success') {
                    $payment->update(['status' => 'success', 'processed_at' => now(), 'meta' => $data]);
                    $this->fulfillmentService->fulfill($payment);
                } else {
                    $payment->update(['status' => 'failed', 'meta' => $data]);
                }
            } catch (\Exception $e) {
                // Leave status as-is — the Paystack webhook will independently
                // retry fulfillment if this verify call failed transiently.
            }
        }

        return $this->renderTopupPage($payment->user, justPaid: $payment->status === 'success');
    }

    private function renderTopupPage(User $user, bool $justPaid = false)
    {
        $account      = $this->creditService->getAccount($user);
        $plans        = CreditPlan::where('is_active', true)->where('price_ngn', '>', 0)->orderBy('price_ngn')->get();
        $transactions = CreditTransaction::where('user_id', $user->id)->latest()->paginate(15);

        return view('pages.credits-topup', compact('user', 'account', 'plans', 'transactions', 'justPaid'));
    }
}
