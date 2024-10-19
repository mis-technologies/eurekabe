<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Student\Database\Factories\StudentFavoriteExamFactory;

class StudentFavoriteExam extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['user_id', 'exam_id'];

    // protected static function newFactory(): StudentFavoriteExamFactory
    // {
    //     // return StudentFavoriteExamFactory::new();
    // }
}
