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
        'scheduled_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_ONGOING = 'ongoing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'student_challenge_participants', 'challenge_id', 'user_id')
            ->select('user_id as id', 'firstname', 'username', 'lastname', 'image', 'email', 'one_signal_id')
            ->withPivot('status', 'score')   // plain column names — withPivot does not support aliases or table prefixes
            ->withTimestamps();
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


