<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Common\Database\Factories\CompetitionExamFactory;

class CompetitionExam extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */ 
    protected $fillable = [
        'competition_id',
        'exam_id',
        'duration', // in minutes
        'total_questions' // total number of questions
    ];

    // protected static function newFactory(): CompetitionExamFactory
    // {
    //     // return CompetitionExamFactory::new();
    // }
}
