<?php

namespace App\Listeners\AppStore;

use App\Listeners\AppStore\Concerns\ResolvesAppleSubscription;
use Illuminate\Support\Facades\Log;
use Imdhemy\AppStore\ServerNotifications\V2DecodedPayload;
use Imdhemy\Purchases\Contracts\HasSubtype;
use Imdhemy\Purchases\Events\PurchaseEvent;
use Modules\Common\Services\CreditService;

/**
 * DID_FAIL_TO_RENEW: Apple couldn't charge the user for the next period.
 * During GRACE_PERIOD, Apple is still retrying billing — leave access intact.
 * Otherwise, the subscription has effectively lapsed — downgrade to Free
 * (EXPIRED will also fire separately once the grace period itself runs out,
 * which is handled by HandleAppleSubscriptionEnded).
 */
class HandleAppleDidFailToRenew
{
    use ResolvesAppleSubscription;

    public function __construct(private CreditService $creditService)
    {
    }

    public function handle(PurchaseEvent $event): void
    {
        $notification = $event->getServerNotification();

        if ($notification instanceof HasSubtype && $notification->getSubtype() === V2DecodedPayload::SUBTYPE_GRACE_PERIOD) {
            Log::info('Apple subscription billing retry in grace period — access left intact.', [
                'original_transaction_id' => $event->getSubscriptionIdentifier(),
            ]);

            return;
        }

        $info = $this->transactionInfo($event);

        if (!$info || !$info->getOriginalTransactionId()) {
            return;
        }

        $subscription = $this->findSubscription($info->getOriginalTransactionId());

        if (!$subscription) {
            return;
        }

        $this->creditService->revokePlan($subscription->user);
        $subscription->update(['status' => 'expired']);
    }
}
