<?php

namespace Modules\Common\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CreditTransaction extends Model
{
    public const UPDATED_AT = null; // transactions are immutable — no updated_at

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'balance_after',
        'feature_key',
        'description',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
