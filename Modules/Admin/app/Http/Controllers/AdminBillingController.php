<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Common\Models\CreditFeatureCost;
use Modules\Common\Models\CreditPlan;
use Modules\Common\Models\Payment;
use Modules\Common\Services\CreditService;

class AdminBillingController extends Controller
{
    public function __construct(protected CreditService $creditService)
    {
    }

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

    public function payments()
    {
        $payments = Payment::with(['user', 'plan'])->latest()->paginate(20);
        return view('admin::billing.payments', compact('payments'));
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
