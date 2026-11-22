<?php

namespace Modules\Common\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Models\CreditPlan;
use Modules\Common\Models\CreditPlanSubscription;
use Modules\Common\Models\Payment;
use Modules\Common\Services\AppleIapService;
use Modules\Common\Services\PaymentFulfillmentService;

class AppleIapController extends Controller
{
    public function __construct(
        private AppleIapService $appleIapService,
        private PaymentFulfillmentService $fulfillmentService,
    ) {}

    /**
     * POST /v1/credits/payment/apple/verify
     *
     * Called by the client right after react-native-iap completes a StoreKit
     * purchase (consumable credit pack, or an initial subscription purchase).
     * Renewals/expirations/refunds instead arrive asynchronously via Apple's
     * Server Notifications V2, handled by the imdhemy/laravel-purchases
     * package's own route + our listeners in app/Listeners/AppStore.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'product_id'     => 'required|string',
            'transaction_id' => 'required|string',
        ]);

        $user          = Auth::user();
        $productId     = (string) $request->input('product_id');
        $transactionId = (string) $request->input('transaction_id');

        $existing = Payment::where('provider', 'apple')
            ->where('apple_transaction_id', $transactionId)
            ->first();

        if ($existing && $existing->status === 'success') {
            return response()->json(['status' => 'success', 'data' => ['status' => 'success', 'plan' => $existing->plan]]);
        }

        $plan = CreditPlan::where('apple_product_id', $productId)->where('is_active', true)->first();

        if (!$plan) {
            return response()->json(['status' => 'error', 'message' => 'Unknown product.'], 422);
        }

        try {
            $info = $this->appleIapService->getTransactionInfo($transactionId);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }

        if (
            $info->getBundleId() !== config('liap.appstore_bundle_id')
            || $info->getProductId() !== $productId
            || $info->getTransactionId() !== $transactionId
        ) {
            return response()->json(['status' => 'error', 'message' => 'Transaction does not match request.'], 422);
        }

        if ($info->getRevocationDate() !== null) {
            return response()->json(['status' => 'error', 'message' => 'This transaction has been revoked.'], 422);
        }

        $payment = Payment::create([
            'user_id'                       => $user->id,
            'plan_id'                       => $plan->id,
            'provider'                      => 'apple',
            'quantity'                      => 1,
            'amount'                        => $plan->price_ngn,
            'status'                        => 'success',
            'processed_at'                  => now(),
            'apple_transaction_id'          => $transactionId,
            'apple_original_transaction_id' => $info->getOriginalTransactionId(),
            'meta'                          => $info->getClaims(),
        ]);

        $this->fulfillmentService->fulfill($payment);

        if ($plan->type === 'monthly') {
            CreditPlanSubscription::where('user_id', $user->id)
                ->where('plan_id', $plan->id)
                ->latest('id')
                ->first()
                ?->update([
                    'provider'                      => 'apple',
                    'apple_original_transaction_id' => $info->getOriginalTransactionId(),
                    'expires_at'                    => $info->getExpiresDate()?->toCarbon(),
                ]);
        }

        return response()->json(['status' => 'success', 'data' => ['status' => 'success', 'plan' => $payment->plan]]);
    }
}
