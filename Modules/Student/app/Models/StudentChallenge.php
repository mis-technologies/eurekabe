<?php

namespace Modules\Student\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Exam\Models\Exam;

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

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'student_challenge_participants', 'challenge_id', 'user_id')
                    ->select('firstname', 'username', 'lastname', 'image', 'email')
                    ->withPivot('status', 'score')
                    ->withTimestamps();
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }
}