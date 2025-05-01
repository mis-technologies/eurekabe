<?php

namespace Modules\Student\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Student\Database\Factories\StudentChallengeParticipantFactory;

class StudentChallengeParticipant extends Model
{
    use HasFactory;


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
        'score' => 'decimal:2',
    ];

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
