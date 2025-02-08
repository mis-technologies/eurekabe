<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Database\Factories\GatewayCurrencyFactory;

class GatewayCurrency extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): GatewayCurrencyFactory
    {
        //return GatewayCurrencyFactory::new();
    }
}
