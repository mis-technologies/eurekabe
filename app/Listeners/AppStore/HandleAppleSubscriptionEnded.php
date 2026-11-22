<?php

namespace App\Listeners\AppStore;

use App\Listeners\AppStore\Concerns\ResolvesAppleSubscription;
use Imdhemy\Purchases\Events\PurchaseEvent;
use Modules\Common\Services\CreditService;

/**
 * Handles Expired, Refund, and Revoke — in every case the subscription is no
 * longer entitled, so downgrade to Free immediately (matches the existing
 * Paystack failure behavior in RenewMonthlySubscriptions.php; no separate
 * grace window beyond what Apple itself already grants via GRACE_PERIOD,
 * handled in HandleAppleDidFailToRenew).
 */
class HandleAppleSubscriptionEnded
{
    use ResolvesAppleSubscription;

    public function __construct(private CreditService $creditService)
    {
    }

    public function handle(PurchaseEvent $event): void
    {
        $info = $this->transactionInfo($event);

        if (!$info || !$info->getOriginalTransactionId()) {
            return;
        }

        $subscription = $this->findSubscription($info->getOriginalTransactionId());

        if (!$subscription || $subscription->status !== 'active') {
            return; // already downgraded, nothing to do
        }

        $this->creditService->revokePlan($subscription->user);

        $status = $event->getServerNotification()->getType() === 'REFUND' ? 'cancelled' : 'expired';
        $subscription->update(['status' => $status]);
    }
}
