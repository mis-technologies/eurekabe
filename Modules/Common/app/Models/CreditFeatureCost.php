<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;

class CreditFeatureCost extends Model
{
    protected $fillable = ['feature_key', 'credits', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function costFor(string $featureKey): int
    {
        $cost = static::where('feature_key', $featureKey)->where('is_active', true)->first();

        return $cost ? $cost->credits : 0;
    }
}
