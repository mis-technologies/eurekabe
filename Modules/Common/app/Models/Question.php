<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Database\Factories\QuestionFactory;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

    public $with = ['options'];


    protected $fillable = [
        'id',
        'exam_id',
        'question',
        'marks',
        'question_type_id',
        'status',
        'written_ans'
    ];

    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_id');
    }


    protected static function newFactory()
    {
        //return QuestionFactory::new();
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }


    public function questionType()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }
}
