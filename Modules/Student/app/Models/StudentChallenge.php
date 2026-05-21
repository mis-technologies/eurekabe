<?php

namespace Modules\Student\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;
use Modules\Common\Models\Exam;

class StudentChallenge extends Model
{
    protected $fillable = [
        'user_id',
        'exam_id',
        'status',
        'winner_id',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_ONGOING = 'ongoing';

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function participants()
    {
        
        return $this->belongsToMany(User::class, 'student_challenge_participants', 'challenge_id', 'user_id')
        ->select('user_id as id', 'firstname', 'username', 'lastname', 'image', 'email', 'one_signal_id')
        ->withPivot('student_challenge_participants.status as status')
        ->withTimestamps()
        ->addSelect([
            DB::raw('CAST(student_challenge_participants.score AS FLOAT) as score')
        ]);


    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }
    

    //user 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'firstname', 'username', 'lastname', 'image');
    }
}


