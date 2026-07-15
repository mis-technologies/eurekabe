<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Models\Question;
use Modules\Student\Database\Factories\StudentExamResultFactory;
use Modules\Student\Models\StudentExam;

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

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function studentExam()
    {
        return $this->belongsTo(StudentExam::class, 'student_exam_id');
    }

    protected static function newFactory()
    {
        //return StudentExamResultFactory::new();
    }
}
