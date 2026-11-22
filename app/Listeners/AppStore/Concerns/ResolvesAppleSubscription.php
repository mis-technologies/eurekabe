<?php

namespace App\Listeners\AppStore\Concerns;

use Illuminate\Support\Facades\Log;
use Imdhemy\AppStore\ServerNotifications\V2DecodedPayload;
use Imdhemy\AppStore\ValueObjects\JwsTransactionInfo;
use Imdhemy\Purchases\Events\PurchaseEvent;
use Modules\Common\Models\CreditPlanSubscription;
use Modules\Common\Models\Payment;

/**
 * Shared resolution logic for Apple Server Notifications V2 listeners: pull
 * the verified transaction info out of the event, and find which of our
 * users/subscriptions it belongs to.
 */
trait ResolvesAppleSubscription
{
    private function transactionInfo(PurchaseEvent $event): ?JwsTransactionInfo
    {
        $representation = $event->getSubscription()->getProviderRepresentation();

        if (!$representation instanceof V2DecodedPayload) {
            Log::warning('Apple server notification listener received a non-App-Store payload.', [
                'event' => get_class($event),
            ]);

            return null;
        }

        return $representation->getTransactionInfo();
    }

    private function findSubscription(string $originalTransactionId): ?CreditPlanSubscription
    {
        $subscription = CreditPlanSubscription::where('apple_original_transaction_id', $originalTransactionId)
            ->latest('id')
            ->first();

        if ($subscription) {
            return $subscription;
        }

        // Fallback: the client-initiated verify() call may not have landed yet
        // (e.g. Apple's webhook raced ahead of our own app's network call).
        $payment = Payment::where('apple_original_transaction_id', $originalTransactionId)
            ->where('provider', 'apple')
            ->latest('id')
            ->first();

        if (!$payment) {
            Log::warning('Apple server notification for an unknown subscription — no matching user found.', [
                'apple_original_transaction_id' => $originalTransactionId,
            ]);

            return null;
        }

        return CreditPlanSubscription::where('user_id', $payment->user_id)
            ->where('plan_id', $payment->plan_id)
            ->latest('id')
            ->first();
    }
}
