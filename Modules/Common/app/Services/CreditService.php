<?php

namespace Modules\Common\Services;

use App\Models\User;
use Illuminate\Support\Carbon;
use Modules\Common\Models\CreditFeatureCost;
use Modules\Common\Models\CreditPlan;
use Modules\Common\Models\CreditPlanSubscription;
use Modules\Common\Models\CreditTransaction;
use Modules\Common\Models\UserCreditAccount;

class CreditService
{
    /**
     * Retrieve the user's credit account, triggering a monthly reset first if overdue.
     */
    public function getAccount(User $user): UserCreditAccount
    {
        $account = UserCreditAccount::with('plan')->firstOrCreate(
            ['user_id' => $user->id],
            $this->defaultAccountAttributes($user)
        );

        $this->maybeReset($account);

        return $account->fresh('plan');
    }

    /**
     * Returns true if the user can afford the action (after resetting if overdue).
     */
    public function canAfford(User $user, string $featureKey, int $multiplier = 1): bool
    {
        $account = $this->getAccount($user);

        return $account->balance >= $this->getCost($featureKey, $multiplier);
    }

    /**
     * Deduct credits for a feature action.
     *
     * Returns false (without deducting) if the user cannot afford the action.
     * Returns true on success.
     */
    public function deduct(User $user, string $featureKey, int $multiplier = 1, ?string $description = null): bool
    {
        $account = $this->getAccount($user);
        $cost    = $this->getCost($featureKey, $multiplier);

        if ($account->balance < $cost) {
            return false;
        }

        $newBalance = $account->balance - $cost;
        $account->update(['balance' => $newBalance]);

        CreditTransaction::create([
            'user_id'     => $user->id,
            'type'        => 'debit',
            'amount'      => $cost,
            'balance_after' => $newBalance,
            'feature_key' => $featureKey,
            'description' => $description ?? "Used: {$featureKey}" . ($multiplier > 1 ? " ×{$multiplier}" : ''),
            'meta'        => $multiplier > 1 ? ['multiplier' => $multiplier] : null,
        ]);

        return true;
    }

    /**
     * Refund credits after a failed AI action.
     */
    public function refund(User $user, string $featureKey, int $multiplier = 1): void
    {
        $account = $this->getAccount($user);
        $cost    = $this->getCost($featureKey, $multiplier);
        $newBalance = $account->balance + $cost;

        $account->update(['balance' => $newBalance]);

        CreditTransaction::create([
            'user_id'     => $user->id,
            'type'        => 'refund',
            'amount'      => $cost,
            'balance_after' => $newBalance,
            'feature_key' => $featureKey,
            'description' => "Refund: {$featureKey}" . ($multiplier > 1 ? " ×{$multiplier}" : ''),
        ]);
    }

    /**
     * Add credits to a user's account (admin top-up, bonus, etc.).
     */
    public function credit(User $user, int $amount, string $type = 'credit', string $description = 'Credits added', ?array $meta = null): void
    {
        $account    = $this->getAccount($user);
        $newBalance = $account->balance + $amount;

        $account->update(['balance' => $newBalance]);

        CreditTransaction::create([
            'user_id'     => $user->id,
            'type'        => $type,
            'amount'      => $amount,
            'balance_after' => $newBalance,
            'feature_key' => null,
            'description' => $description,
            'meta'        => $meta,
        ]);
    }

    /**
     * Assign a plan to a user. Creates/updates the credit account and logs a subscription.
     * For pay_as_you_go plans, credits are added directly without creating a subscription.
     */
    public function assignPlan(User $user, CreditPlan $plan): UserCreditAccount
    {
        // PAYG plans: just top up credits, no subscription lifecycle
        if ($plan->type === 'pay_as_you_go') {
            $account = $this->getAccount($user);
            $this->credit($user, $plan->monthly_credits, 'credit', "Credit pack purchase: {$plan->name} ({$plan->monthly_credits} credits)", ['plan_slug' => $plan->slug]);
            return $account->fresh('plan');
        }

        // Close any active subscriptions for other plans
        CreditPlanSubscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->update(['status' => 'cancelled', 'expires_at' => Carbon::now()]);

        // Create new subscription record
        CreditPlanSubscription::create([
            'user_id'    => $user->id,
            'plan_id'    => $plan->id,
            'started_at' => Carbon::now(),
            'status'     => 'active',
        ]);

        // Create or update the credit account
        $account = UserCreditAccount::updateOrCreate(
            ['user_id' => $user->id],
            [
                'plan_id'           => $plan->id,
                'monthly_allowance' => $plan->monthly_credits,
                'next_reset_at'     => Carbon::now()->addMonth(),
            ]
        );

        // Credit the new monthly allowance immediately (full reset to plan amount)
        $previous = $account->balance;
        $account->update(['balance' => $plan->monthly_credits]);

        CreditTransaction::create([
            'user_id'     => $user->id,
            'type'        => 'credit',
            'amount'      => $plan->monthly_credits,
            'balance_after' => $plan->monthly_credits,
            'feature_key' => null,
            'description' => "Plan activated: {$plan->name} ({$plan->monthly_credits} credits)",
            'meta'        => ['plan_slug' => $plan->slug, 'previous_balance' => $previous],
        ]);

        return $account->fresh('plan');
    }

    /**
     * Reset a user's monthly credits (called by scheduler or lazily on next action).
     * Respects rollover: if the plan has rollover=true, the allowance is added to the existing
     * balance instead of replacing it.
     */
    public function resetMonthlyCredits(UserCreditAccount $account): void
    {
        $plan      = $account->plan;
        $allowance = $account->monthly_allowance;

        // Rollover: add allowance to existing balance; otherwise reset to allowance
        $newBalance = ($plan && $plan->rollover)
            ? $account->balance + $allowance
            : $allowance;

        $account->update([
            'balance'       => $newBalance,
            'next_reset_at' => Carbon::now()->addMonth(),
        ]);

        CreditTransaction::create([
            'user_id'       => $account->user_id,
            'type'          => 'reset',
            'amount'        => $allowance,
            'balance_after' => $newBalance,
            'feature_key'   => null,
            'description'   => "Monthly credits reset ({$allowance} credits)" . ($plan?->rollover ? ' + rollover' : ''),
        ]);
    }

    /**
     * Get the credit cost for a feature, optionally multiplied.
     */
    public function getCost(string $featureKey, int $multiplier = 1): int
    {
        return CreditFeatureCost::costFor($featureKey) * max(1, $multiplier);
    }

    // ─── Private helpers ──────────────────────────────────────────────────────

    /**
     * Trigger a monthly reset if the account's next_reset_at is in the past.
     */
    private function maybeReset(UserCreditAccount $account): void
    {
        if ($account->isDueForReset()) {
            $this->resetMonthlyCredits($account);
        }
    }

    /**
     * Default attributes for auto-creating a credit account (fallback if free plan not seeded yet).
     */
    private function defaultAccountAttributes(User $user): array
    {
        $freePlan = CreditPlan::where('slug', 'free')->first();

        return [
            'plan_id'           => $freePlan?->id,
            'balance'           => $freePlan?->monthly_credits ?? 50,
            'monthly_allowance' => $freePlan?->monthly_credits ?? 50,
            'next_reset_at'     => Carbon::now()->addMonth(),
        ];
    }
}
