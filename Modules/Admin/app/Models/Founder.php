<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;


class Founder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'position',
        'image_path',
        'bio',
        'order_column',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_column' => 'integer'
    ];

    /**
     * Fetch founders where is_active is true and order them in ascending order.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActiveOrdered(Builder $query)
    {
        return $query->where('is_active', true)
                    ->orderBy('order_column', 'asc');
    }

    
}
