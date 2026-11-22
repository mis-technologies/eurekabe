<?php

namespace App\Listeners\AppStore;

use App\Listeners\AppStore\Concerns\ResolvesAppleSubscription;
use Illuminate\Support\Facades\Log;
use Imdhemy\Purchases\Events\PurchaseEvent;
use Modules\Common\Models\CreditPlan;
use Modules\Common\Models\CreditPlanSubscription;
use Modules\Common\Models\Payment;
use Modules\Common\Services\PaymentFulfillmentService;

/**
 * Handles Imdhemy\Purchases\Events\AppStore\Subscribed and DidRenew — both are
 * "the user has an active, paid-up subscription as of now" events, so they're
 * handled identically: credit the plan's allowance and refresh expires_at.
 */
class HandleAppleSubscriptionActive
{
    use ResolvesAppleSubscription;

    public function __construct(private PaymentFulfillmentService $fulfillmentService)
    {
    }

    public function handle(PurchaseEvent $event): void
    {
        $info = $this->transactionInfo($event);

        if (!$info || !$info->getTransactionId() || !$info->getOriginalTransactionId()) {
            return;
        }

        if (Payment::where('provider', 'apple')->where('apple_transaction_id', $info->getTransactionId())->exists()) {
            return; // already processed (Apple retries notifications)
        }

        $plan = CreditPlan::where('apple_product_id', $info->getProductId())->first();

        if (!$plan) {
            Log::warning('Apple subscription-active event for an unmapped product.', ['product_id' => $info->getProductId()]);

            return;
        }

        $subscription = $this->findSubscription($info->getOriginalTransactionId());

        if (!$subscription) {
            return;
        }

        $payment = Payment::create([
            'user_id'                       => $subscription->user_id,
            'plan_id'                       => $plan->id,
            'provider'                      => 'apple',
            'quantity'                      => 1,
            'amount'                        => $plan->price_ngn,
            'status'                        => 'success',
            'processed_at'                  => now(),
            'apple_transaction_id'          => $info->getTransactionId(),
            'apple_original_transaction_id' => $info->getOriginalTransactionId(),
            'meta'                          => $info->getClaims(),
        ]);

        $this->fulfillmentService->fulfill($payment);

        CreditPlanSubscription::where('user_id', $subscription->user_id)
            ->where('plan_id', $plan->id)
            ->latest('id')
            ->first()
            ?->update([
                'provider'                      => 'apple',
                'apple_original_transaction_id' => $info->getOriginalTransactionId(),
                'expires_at'                    => $info->getExpiresDate()?->toCarbon(),
                'status'                        => 'active',
            ]);
    }
}
