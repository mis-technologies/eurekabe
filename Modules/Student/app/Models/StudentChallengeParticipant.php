<?php

namespace Modules\Student\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

// use Modules\Student\Database\Factories\StudentChallengeParticipantFactory;

class StudentChallengeParticipant  extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_SUBMITTED = 'submitted';
    public const STATUS_DECLINED = 'declined';

    /**
     * Order participants for a challenge: highest score first, and on a tie
     * whoever submitted their exam first (student_exams.ended_at) ranks higher.
     */
    public function scopeRanked($query)
    {
        return $query
            ->leftJoin('student_exams', function ($join) {
                $join->on('student_exams.challenge_id', '=', 'student_challenge_participants.challenge_id')
                    ->on('student_exams.user_id', '=', 'student_challenge_participants.user_id');
            })
            ->select('student_challenge_participants.*')
            ->orderByDesc('student_challenge_participants.score')
            ->orderByRaw('student_exams.ended_at IS NULL')
            ->orderBy('student_exams.ended_at')
            ->orderBy('student_challenge_participants.id');
    }

    public $appends = [
        'is_winner',
    ];
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'challenge_id',
        'status',
        'score',
    ];

    public $casts = [
        'score' => 'float',
    ];

    public function getScoreAttribute($value)
    {
        return (float) $value;
    }

    public function setScoreAttribute($value)
    {
        $this->attributes['score'] = (float) $value;
    }

    public function challenge()
    {
        return $this->belongsTo(StudentChallenge::class, 'challenge_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // isWinner
    public function getIsWinnerAttribute()
    {
        return $this->user_id == $this->challenge->winner_id;
    }

}
