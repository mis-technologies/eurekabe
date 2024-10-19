<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Exam\Database\Factories\ExamFeedbackFactory;

class ExamFeedback extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'exam_id',
        'rating',
        'feedback',
    ];

    // protected static function newFactory(): ExamFeedbackFactory
    // {
    //     // return ExamFeedbackFactory::new();
    // }
}
