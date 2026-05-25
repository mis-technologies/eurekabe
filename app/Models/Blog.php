<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Blog extends Model
{
    protected $table    = 'blogs';
    protected $fillable = ['title', 'content', 'image', 'slug', 'category_id', 'school_id', 'status'];
    protected $appends  = ['excerpt', 'read_time'];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function school(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\Modules\Common\Models\School::class, 'school_id');
    }

    /** First 160 characters of content, stripped of HTML. */
    public function getExcerptAttribute(): string
    {
        $plain = strip_tags($this->content ?? '');
        return mb_strlen($plain) > 160
            ? mb_substr($plain, 0, 160) . '…'
            : $plain;
    }

    /** Estimated reading time in minutes (average 200 wpm). */
    public function getReadTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->content ?? ''));
        return (int) max(1, ceil($words / 200));
    }
}
