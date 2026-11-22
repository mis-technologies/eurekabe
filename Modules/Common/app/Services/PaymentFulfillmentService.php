<?php

namespace Modules\Common\Services;

use Modules\Common\Models\Payment;
use Modules\Common\Notifications\Notification as EurekaNotification;

/**
 * Shared final step for any successful payment, regardless of provider
 * (Paystack, Apple IAP, ...): grant the plan/credits and notify the user.
 * Callers are responsible for their own provider-specific bookkeeping on the
 * Payment record (status, references, authorization codes, etc.) before
 * calling this.
 */
class PaymentFulfillmentService
{
    public function __construct(private CreditService $creditService)
    {
    }

    public function fulfill(Payment $payment): void
    {
        $user     = $payment->user;
        $plan     = $payment->plan;
        $quantity = $payment->quantity ?? 1;

        $this->creditService->assignPlan($user, $plan, $quantity);

        // Notify user of successful credit purchase (best-effort — never fail the payment)
        try {
            $creditsAdded = ($plan->monthly_credits ?? 0) * $quantity;
            $dbContent = [
                'title'     => 'Payment Successful',
                'text'      => "Your payment was successful. {$creditsAdded} credits have been added to your account.",
                'entity'    => get_class($payment),
                'entity_id' => $payment->id,
                'meta'      => ['plan_id' => $plan->id, 'credits' => $creditsAdded],
            ];
            $user->notify(new EurekaNotification(null, $dbContent, ['database', 'push']));
        } catch (\Throwable) {
            // Notification failure must never roll back or fail the payment
        }
    }
}
