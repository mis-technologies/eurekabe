<?php

namespace Modules\Common\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Common\Models\CreditFeatureCost;
use Modules\Common\Models\CreditPlan;
use Modules\Common\Models\CreditTransaction;
use Modules\Common\Services\CreditService;

class CreditController extends Controller
{
    public function __construct(private CreditService $credits) {}

    /**
     * GET /v1/credits/account
     * Current user's credit balance, plan, and reset schedule.
     */
    public function account(Request $request)
    {
        $account = $this->credits->getAccount($request->user());

        return response()->json([
            'status' => 'success',
            'data'   => [
                'balance'           => $account->balance,
                'monthly_allowance' => $account->monthly_allowance,
                'next_reset_at'     => $account->next_reset_at?->toISOString(),
                'plan'              => $account->plan ? [
                    'id'              => $account->plan->id,
                    'name'            => $account->plan->name,
                    'slug'            => $account->plan->slug,
                    'monthly_credits' => $account->plan->monthly_credits,
                    'price_ngn'       => $account->plan->price_ngn,
                ] : null,
            ],
        ]);
    }

    /**
     * GET /v1/credits/plans
     * All available credit plans.
     */
    public function plans()
    {
        $plans = CreditPlan::where('is_active', true)->orderBy('price_ngn')->get();

        return response()->json([
            'status' => 'success',
            'data'   => $plans->map(fn ($p) => [
                'id'              => $p->id,
                'name'            => $p->name,
                'slug'            => $p->slug,
                'monthly_credits' => $p->monthly_credits,
                'price_ngn'       => $p->price_ngn,
            ]),
        ]);
    }

    /**
     * GET /v1/credits/costs
     * Credit cost for each AI feature action.
     */
    public function costs()
    {
        $costs = CreditFeatureCost::where('is_active', true)->orderBy('feature_key')->get();

        return response()->json([
            'status' => 'success',
            'data'   => $costs->map(fn ($c) => [
                'feature_key' => $c->feature_key,
                'credits'     => $c->credits,
                'description' => $c->description,
            ]),
        ]);
    }

    /**
     * GET /v1/credits/history
     * Paginated transaction history for the current user.
     */
    public function history(Request $request)
    {
        $transactions = CreditTransaction::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(15);

        return response()->json([
            'status' => 'success',
            'data'   => $transactions,
        ]);
    }
}
