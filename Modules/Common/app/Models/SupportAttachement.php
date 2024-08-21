<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Database\Factories\SupportAttachementFactory;

class SupportAttachement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): SupportAttachementFactory
    {
        //return SupportAttachementFactory::new();
    }
}
