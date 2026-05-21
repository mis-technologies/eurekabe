<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Database\Factories\QuestionOptionFactory;

class QuestionOption extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'question_id',
        'option',
        'remark',
        'is_correct',
    ];

    protected static function newFactory()
    {
        //return QuestionOptionFactory::new();
    }
}
