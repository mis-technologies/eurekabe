<?php

namespace Modules\Common\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'original_filename',
        'path',
        'extracted_text',
        'word_count',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function summaries()
    {
        return $this->hasMany(MaterialSummary::class);
    }

    public function resources()
    {
        return $this->hasMany(MaterialResource::class);
    }

    public function questions()
    {
        return $this->hasMany(MaterialQuestion::class);
    }

    public function isReady(): bool
    {
        return $this->status === 'ready';
    }
}
