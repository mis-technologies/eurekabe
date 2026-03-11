<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Admin\Database\Factories\FounderFactory;

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

    // Scope for ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_column');
    }

    // Scope for active founders
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Helper method to get image URL
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
}
