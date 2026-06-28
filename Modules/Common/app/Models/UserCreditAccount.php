<?php

namespace Modules\Common\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserCreditAccount extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'balance',
        'monthly_allowance',
        'next_reset_at',
    ];

    protected $casts = [
        'next_reset_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(CreditPlan::class, 'plan_id');
    }

    public function transactions()
    {
        return $this->hasMany(CreditTransaction::class, 'user_id', 'user_id');
    }

    public function isDueForReset(): bool
    {
        return $this->next_reset_at->isPast();
    }
}
