<?php

namespace Modules\Common\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'provider',
        'quantity',
        'paystack_reference',
        'authorization_code',
        'authorization_email',
        'apple_transaction_id',
        'apple_original_transaction_id',
        'amount',
        'status',
        'processed_at',
        'meta',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
        'meta'         => 'array',
        'status'       => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(CreditPlan::class, 'plan_id');
    }
}
