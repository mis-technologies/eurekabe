<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'status',
        'categories_id',
       
    ];

    // protected static function newFactory(): ExamFeedbackFactory
    // {
    //     // return ExamFeedbackFactory::new();
    // }
}
