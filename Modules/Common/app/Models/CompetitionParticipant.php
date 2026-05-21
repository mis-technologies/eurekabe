<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Common\Database\Factories\CompetitionParticipantFactory;

class CompetitionParticipant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = [
        'user_id',
        'competition_id',
        'status', // pending, approved, rejected
        'isPaid',
        'payment_id'
    ];

    // protected static function newFactory(): CompetitionParticipantFactory
    // {
    //     // return CompetitionParticipantFactory::new();
    // }
}
