<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Modules\Common\Models\CreditPlanSubscription;
use Modules\Common\Models\Payment;
use Modules\Common\Notifications\Notification as EurekaNotification;
use Modules\Common\Services\CreditService;
use Modules\Common\Services\PaystackService;

class RenewMonthlySubscriptions extends Command
{
    protected $signature   = 'credits:renew-subscriptions';
    protected $description = 'Auto-renew monthly credit subscriptions using stored card authorizations.';

    public function handle(CreditService $creditService, PaystackService $paystackService): int
    {
        // Find active monthly subscriptions expiring within the next 25 hours
        $due = CreditPlanSubscription::with(['user', 'plan'])
            ->where('status', 'active')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', now()->addHours(25))
            ->get();

        if ($due->isEmpty()) {
            $this->info('No subscriptions due for renewal.');
            return self::SUCCESS;
        }

        $this->info("Found {$due->count()} subscription(s) due for renewal.");
        $bar = $this->output->createProgressBar($due->count());
        $bar->start();

        $renewed = 0;
        $failed  = 0;

        foreach ($due as $subscription) {
            $user = $subscription->user;
            $plan = $subscription->plan;

            if (!$user || !$plan || $plan->price_ngn === 0) {
                $bar->advance();
                continue;
            }

            // Find the most recent reusable authorization for this user + plan
            $sourcePayment = Payment::where('user_id', $user->id)
                ->where('plan_id', $plan->id)
                ->where('status', 'success')
                ->whereNotNull('authorization_code')
                ->latest('processed_at')
                ->first();

            if (!$sourcePayment) {
                $this->newLine();
                $this->warn("User #{$user->id} ({$user->email}): no stored card authorization — skipping.");
                $this->notifyPaymentFailed($user, $plan, 'No stored card on file. Please re-subscribe to continue.');
                $subscription->update(['status' => 'expired']);
                $failed++;
                $bar->advance();
                continue;
            }

            // Create a pending Payment record for this renewal cycle
            $reference = 'EK_REN_' . Str::upper(Str::random(10)) . '_' . time();
            $payment   = Payment::create([
                'user_id'             => $user->id,
                'plan_id'             => $plan->id,
                'quantity'            => 1,
                'paystack_reference'  => $reference,
                'amount'              => $plan->price_ngn,
                'status'              => 'pending',
            ]);

            try {
                $data = $paystackService->chargeAuthorization(
                    $sourcePayment->authorization_code,
                    $sourcePayment->authorization_email ?? $user->email,
                    $plan->price_ngn,
                    $reference,
                );

                if (($data['status'] ?? '') === 'success') {
                    // Store auth code on the new payment record too
                    $authCode = $data['authorization']['authorization_code'] ?? $sourcePayment->authorization_code;
                    $payment->update([
                        'status'              => 'success',
                        'processed_at'        => now(),
                        'authorization_code'  => $authCode,
                        'authorization_email' => $sourcePayment->authorization_email ?? $user->email,
                        'meta'                => $data,
                    ]);

                    // Assign the plan — this closes the old subscription and opens a new one
                    $creditService->assignPlan($user, $plan, 1);
                    $this->notifyPaymentSuccess($user, $plan, $payment);
                    $renewed++;
                } else {
                    $payment->update(['status' => 'failed', 'meta' => $data]);
                    $subscription->update(['status' => 'expired']);
                    $this->notifyPaymentFailed($user, $plan);
                    $failed++;
                }
            } catch (\Throwable $e) {
                $payment->update(['status' => 'failed']);
                $subscription->update(['status' => 'expired']);
                $this->newLine();
                $this->warn("User #{$user->id} ({$user->email}): charge failed — {$e->getMessage()}");
                $this->notifyPaymentFailed($user, $plan);
                $failed++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Done. Renewed: {$renewed} | Failed: {$failed}.");

        return self::SUCCESS;
    }

    private function notifyPaymentSuccess($user, $plan, Payment $payment): void
    {
        try {
            $credits   = $plan->monthly_credits ?? 0;
            $dbContent = [
                'title'     => 'Subscription Renewed',
                'text'      => "Your {$plan->name} subscription has been renewed. {$credits} credits have been added to your account.",
                'entity'    => get_class($payment),
                'entity_id' => $payment->id,
                'meta'      => ['plan_id' => $plan->id, 'credits' => $credits],
            ];
            $user->notify(new EurekaNotification(null, $dbContent, ['database', 'push']));
        } catch (\Throwable) {}
    }

    private function notifyPaymentFailed($user, $plan, string $message = null): void
    {
        try {
            $text = $message ?? "We could not renew your {$plan->name} subscription. Please update your payment method.";
            $dbContent = [
                'title'  => 'Subscription Renewal Failed',
                'text'   => $text,
                'meta'   => ['plan_id' => $plan->id],
            ];
            $user->notify(new EurekaNotification(null, $dbContent, ['database', 'push']));
        } catch (\Throwable) {}
    }
}
