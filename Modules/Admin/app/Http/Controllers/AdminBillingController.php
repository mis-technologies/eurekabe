<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Common\Models\CreditFeatureCost;
use Modules\Common\Models\CreditPlan;
use Modules\Common\Models\CreditPlanSubscription;
use Modules\Common\Models\Payment;
use Modules\Common\Notifications\Notification as EurekaNotification;
use Modules\Common\Services\CreditService;
use Modules\Common\Services\PaystackService;

class AdminBillingController extends Controller
{
    public function __construct(
        protected CreditService $creditService,
        protected PaystackService $paystackService,
    ) {}

    // ─── Credit Plans ─────────────────────────────────────────────────────────

    public function plans()
    {
        $plans = CreditPlan::latest()->get();
        return view('admin::billing.plans', compact('plans'));
    }

    public function storePlan(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'slug'            => 'required|string|max:255|unique:credit_plans,slug',
            'type'            => 'required|in:monthly,pay_as_you_go',
            'monthly_credits' => 'required|integer|min:0',
            'price_ngn'       => 'required|numeric|min:0',
            'rollover'        => 'sometimes|boolean',
            'is_active'       => 'sometimes|boolean',
        ]);

        $validated['rollover']  = $request->boolean('rollover');
        $validated['is_active'] = $request->boolean('is_active', true);

        CreditPlan::create($validated);

        session()->flash('success', 'Credit plan created successfully.');
        return redirect()->route('admin.billing.plans');
    }

    public function updatePlan(Request $request, $id)
    {
        $plan = CreditPlan::findOrFail($id);

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'slug'            => 'required|string|max:255|unique:credit_plans,slug,' . $id,
            'type'            => 'required|in:monthly,pay_as_you_go',
            'monthly_credits' => 'required|integer|min:0',
            'price_ngn'       => 'required|numeric|min:0',
            'rollover'        => 'sometimes|boolean',
            'is_active'       => 'sometimes|boolean',
        ]);

        $validated['rollover']  = $request->boolean('rollover');
        $validated['is_active'] = $request->boolean('is_active');

        $plan->update($validated);

        session()->flash('success', 'Credit plan updated successfully.');
        return redirect()->route('admin.billing.plans');
    }

    public function togglePlan($id)
    {
        $plan = CreditPlan::findOrFail($id);
        $plan->update(['is_active' => !$plan->is_active]);

        session()->flash('success', 'Plan status toggled.');
        return redirect()->route('admin.billing.plans');
    }

    public function deletePlan($id)
    {
        $plan = CreditPlan::findOrFail($id);
        $plan->delete();

        session()->flash('success', 'Credit plan deleted.');
        return redirect()->route('admin.billing.plans');
    }

    // ─── Feature Costs ────────────────────────────────────────────────────────

    public function costs()
    {
        $costs = CreditFeatureCost::orderBy('feature_key')->get();
        return view('admin::billing.costs', compact('costs'));
    }

    public function updateCost(Request $request, $id)
    {
        $cost = CreditFeatureCost::findOrFail($id);

        $validated = $request->validate([
            'credits'     => 'required|integer|min:0',
            'description' => 'nullable|string|max:500',
            'is_active'   => 'sometimes|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $cost->update($validated);

        session()->flash('success', 'Feature cost updated.');
        return redirect()->route('admin.billing.costs');
    }

    // ─── Payments ─────────────────────────────────────────────────────────────

    public function payments(Request $request)
    {
        $query = Payment::with(['user', 'plan'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('paystack_reference', 'like', "%{$term}%")
                  ->orWhereHas('user', fn($u) => $u->where('email', 'like', "%{$term}%")
                      ->orWhere('firstname', 'like', "%{$term}%")
                      ->orWhere('lastname', 'like', "%{$term}%"));
            });
        }

        $payments = $query->paginate(25)->withQueryString();

        $stats = [
            'total'    => Payment::count(),
            'success'  => Payment::where('status', 'success')->count(),
            'pending'  => Payment::where('status', 'pending')->count(),
            'failed'   => Payment::where('status', 'failed')->count(),
            'revenue'  => Payment::where('status', 'success')->sum('amount'),
        ];

        return view('admin::billing.payments', compact('payments', 'stats'));
    }

    // ─── Subscriptions ────────────────────────────────────────────────────────

    public function subscriptions(Request $request)
    {
        $query = CreditPlanSubscription::with(['user', 'plan'])->latest('started_at');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        if ($request->filled('plan_id')) {
            $query->where('plan_id', $request->plan_id);
        }
        if ($request->filled('search')) {
            $term = $request->search;
            $query->whereHas('user', fn($u) => $u->where('email', 'like', "%{$term}%")
                ->orWhere('firstname', 'like', "%{$term}%")
                ->orWhere('lastname', 'like', "%{$term}%"));
        }

        $subscriptions = $query->paginate(25)->withQueryString();

        $plans = CreditPlan::where('type', 'monthly')->orderBy('name')->get();

        $stats = [
            'active'         => CreditPlanSubscription::where('status', 'active')->count(),
            'expiring_soon'  => CreditPlanSubscription::where('status', 'active')
                                    ->where('expires_at', '<=', now()->addDays(7))
                                    ->whereNotNull('expires_at')
                                    ->count(),
            'cancelled'      => CreditPlanSubscription::where('status', 'cancelled')->count(),
            'expired'        => CreditPlanSubscription::where('status', 'expired')->count(),
            'with_card'      => CreditPlanSubscription::where('status', 'active')
                                    ->whereHas('user', fn($u) => $u->whereExists(
                                        fn($p) => $p->from('payments')
                                            ->whereColumn('payments.user_id', 'credit_plan_subscriptions.user_id')
                                            ->whereNotNull('payments.authorization_code')
                                            ->where('payments.status', 'success')
                                    ))
                                    ->count(),
        ];

        return view('admin::billing.subscriptions', compact('subscriptions', 'plans', 'stats'));
    }

    public function cancelSubscription($id)
    {
        $subscription = CreditPlanSubscription::with(['user', 'plan'])->findOrFail($id);

        if ($subscription->status !== 'active') {
            session()->flash('error', 'Subscription is not active.');
            return redirect()->route('admin.billing.subscriptions');
        }

        $subscription->update([
            'status'     => 'cancelled',
            'expires_at' => now(),
        ]);

        // Downgrade user's credit account to the free plan
        $freePlan = CreditPlan::where('slug', 'free')->first();
        if ($freePlan && $subscription->user) {
            $this->creditService->assignPlan($subscription->user, $freePlan);
        }

        // Notify the user
        try {
            $subscription->user?->notify(new EurekaNotification(null, [
                'title' => 'Subscription Cancelled',
                'text'  => "Your {$subscription->plan?->name} subscription has been cancelled by an administrator.",
                'meta'  => ['plan_id' => $subscription->plan_id],
            ], ['database', 'push']));
        } catch (\Throwable) {}

        session()->flash('success', "Subscription #{$id} cancelled and user downgraded to free plan.");
        return redirect()->route('admin.billing.subscriptions');
    }

    public function extendSubscription(Request $request, $id)
    {
        $request->validate(['months' => 'required|integer|min:1|max:12']);

        $subscription = CreditPlanSubscription::findOrFail($id);

        $base = ($subscription->expires_at && $subscription->expires_at->isFuture())
            ? $subscription->expires_at
            : now();

        $subscription->update([
            'expires_at' => $base->addMonths((int) $request->months),
            'status'     => 'active',
        ]);

        $months = $request->months;
        session()->flash('success', "Subscription #{$id} extended by {$months} month(s).");
        return redirect()->route('admin.billing.subscriptions');
    }

    public function forceRenewSubscription($id)
    {
        $subscription = CreditPlanSubscription::with(['user', 'plan'])->findOrFail($id);
        $user = $subscription->user;
        $plan = $subscription->plan;

        if (!$user || !$plan) {
            session()->flash('error', 'User or plan not found.');
            return redirect()->route('admin.billing.subscriptions');
        }

        // Find stored authorization
        $sourcePayment = Payment::where('user_id', $user->id)
            ->where('plan_id', $plan->id)
            ->where('status', 'success')
            ->whereNotNull('authorization_code')
            ->latest('processed_at')
            ->first();

        if (!$sourcePayment) {
            session()->flash('error', "No stored card authorization found for {$user->email}. User must re-subscribe manually.");
            return redirect()->route('admin.billing.subscriptions');
        }

        $reference = 'EK_REN_ADM_' . Str::upper(Str::random(8)) . '_' . time();
        $payment   = Payment::create([
            'user_id'            => $user->id,
            'plan_id'            => $plan->id,
            'quantity'           => 1,
            'paystack_reference' => $reference,
            'amount'             => $plan->price_ngn,
            'status'             => 'pending',
        ]);

        try {
            $data = $this->paystackService->chargeAuthorization(
                $sourcePayment->authorization_code,
                $sourcePayment->authorization_email ?? $user->email,
                $plan->price_ngn,
                $reference,
            );

            if (($data['status'] ?? '') === 'success') {
                $authCode = $data['authorization']['authorization_code'] ?? $sourcePayment->authorization_code;
                $payment->update([
                    'status'              => 'success',
                    'processed_at'        => now(),
                    'authorization_code'  => $authCode,
                    'authorization_email' => $sourcePayment->authorization_email ?? $user->email,
                    'meta'                => $data,
                ]);
                $this->creditService->assignPlan($user, $plan, 1);

                try {
                    $credits = $plan->monthly_credits ?? 0;
                    $user->notify(new EurekaNotification(null, [
                        'title' => 'Subscription Renewed',
                        'text'  => "Your {$plan->name} subscription has been renewed. {$credits} credits added.",
                        'meta'  => ['plan_id' => $plan->id, 'credits' => $credits],
                    ], ['database', 'push']));
                } catch (\Throwable) {}

                session()->flash('success', "Force renewal succeeded for {$user->email}. Credits applied.");
            } else {
                $payment->update(['status' => 'failed', 'meta' => $data]);
                session()->flash('error', "Charge attempted but Paystack returned status: " . ($data['status'] ?? 'unknown'));
            }
        } catch (\Throwable $e) {
            $payment->update(['status' => 'failed']);
            session()->flash('error', "Charge failed: {$e->getMessage()}");
        }

        return redirect()->route('admin.billing.subscriptions');
    }

    // ─── Adjust Credits ───────────────────────────────────────────────────────

    public function adjustCredits()
    {
        return view('admin::billing.adjust-credits');
    }

    public function applyAdjustment(Request $request)
    {
        $request->validate([
            'email'       => 'required|email',
            'amount'      => 'required|integer|not_in:0',
            'description' => 'required|string|max:500',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            session()->flash('error', 'No user found with that email address.');
            return redirect()->route('admin.billing.adjust');
        }

        $amount      = (int) $request->amount;
        $description = $request->description;
        $type        = $amount > 0 ? 'credit' : 'debit';

        $this->creditService->credit($user, $amount, $type, $description);

        $action = $amount > 0 ? "Added {$amount} credits to" : "Deducted " . abs($amount) . " credits from";
        session()->flash('success', "{$action} {$user->name} ({$user->email}).");

        return redirect()->route('admin.billing.adjust');
    }
}
