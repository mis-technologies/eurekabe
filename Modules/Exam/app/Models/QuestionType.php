<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Exam\Database\Factories\QuestionTypeFactory;

class QuestionType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
    ];

    protected static function newFactory()
    {
        //return QuestionTypeFactory::new();
    }

    public function question()
    {
        return $this->hasMany(Question::class, 'question_type_id');
    }
}
