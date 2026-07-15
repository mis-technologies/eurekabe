<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;

class CreditPlan extends Model
{
    protected $fillable = ['name', 'slug', 'type', 'monthly_credits', 'price_ngn', 'is_active', 'rollover'];

    protected $casts = [
        'is_active' => 'boolean',
        'rollover'  => 'boolean',
        'type'      => 'string',
    ];

    public function userAccounts()
    {
        return $this->hasMany(UserCreditAccount::class, 'plan_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(CreditPlanSubscription::class, 'plan_id');
    }

    public function isFree(): bool
    {
        return $this->price_ngn === 0;
    }
}
