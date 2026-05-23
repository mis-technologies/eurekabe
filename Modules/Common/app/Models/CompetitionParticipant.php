<?php

namespace Modules\Common\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompetitionParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'competition_id',
        'status', // pending, approved, rejected, submitted
        'isPaid',
        'payment_id',
        'score',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'isPaid' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
