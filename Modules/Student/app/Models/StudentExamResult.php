<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Student\Database\Factories\StudentExamResultFactory;

class StudentExamResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'student_exam_id',
        'exam_id',
        'user_id',
        'question_id',
        'answer',
        'answer_type',
        'mark',
        'is_correct',
    ];

    protected static function newFactory()
    {
        //return StudentExamResultFactory::new();
    }
}
