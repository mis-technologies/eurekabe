<?php

namespace Modules\Student\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Models\Exam;

// use Modules\Student\Database\Factories\StudentLeaderBoardFactory;

class StudentLeaderBoard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'exam_id',
        'challenge_id',
        'points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function challenge()
    {
        return $this->belongsTo(StudentChallenge::class,   'challenge_id');
    }

    // protected static function newFactory(): StudentLeaderBoardFactory
    // {
    //     // return StudentLeaderBoardFactory::new();
    // }
}
