<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialQuestion extends Model
{
    protected $fillable = [
        'material_id',
        'question',
        'question_type',
        'difficulty',
        'options',
        'correct_answer',
        'explanation',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
