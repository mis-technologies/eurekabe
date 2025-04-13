<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Exam\Database\Factories\CompetitionFactory;

class Competition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'school_id',
        'name',
        'visibility',
        'type',
        'description',
        'instruction',
        'start_date',
        'end_date'
    ];

    // protected static function newFactory(): CompetitionFactory
    // {
    //     // return CompetitionFactory::new();
    // }
}
