<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Exam\Models\Exam;
use Modules\Exam\Models\Question;
use Modules\Student\Database\Factories\StudentExamFactory;

class StudentExam extends Model
{
    use HasFactory;

    public const STARTED = 'started';
    public const SUBMITTED = 'submitted';
    public const AWAITING_RESULT = 'awaiting_result';
    public const RESULT_RELEASED = 'result_released';


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'exam_id',
        'user_id',
        'payment_required',
        'questions',
        'is_paid',
        'attempts',
        'status',
        'started_at',
        'ended_at'
    ];

    protected $casts = [
        'questions' => 'array'
    ];


    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }



    protected static function newFactory()
    {
        //return StudentExamFactory::new();
    }
}
