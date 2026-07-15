<?php

namespace Modules\Common\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'paystack_reference',
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
