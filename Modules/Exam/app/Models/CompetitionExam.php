<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Exam\Database\Factories\CompetitionExamFactory;

class CompetitionExam extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): CompetitionExamFactory
    // {
    //     // return CompetitionExamFactory::new();
    // }
}
