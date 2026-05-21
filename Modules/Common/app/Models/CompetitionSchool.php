<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Common\Database\Factories\CompetitionSchoolFactory;

class CompetitionSchool extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = [
        'competition_id',
        'school_id'
    ];

    // protected static function newFactory(): CompetitionSchoolFactory
    // {
    //     // return CompetitionSchoolFactory::new();
    // }
}
