<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Models\School;
use Modules\Common\Models\File;

// use Modules\Common\Database\Factories\CompetitionFactory;

class Competition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'school_id',
        'winner_id',
        'name',
        'visibility',
        'type',
        'description',
        'instruction',
        'status',
        'start_date',
        'end_date',
    ];

    public $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public $appends = ['image'];

    // schools
    public function schools()
    {
        return $this->belongsToMany(School::class, 'competition_schools', 'competition_id', 'school_id');
    }

    // exams
    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'competition_exams', 'competition_id', 'exam_id')
        ->withPivot('duration', 'total_questions');
    }

    // participants
    public function participants()
    {
        return $this->hasMany(CompetitionParticipant::class, 'competition_id', 'id');
    }

    // image
    public function getImageAttribute()
    {
        $file = File::where('entity', get_class($this))
            ->where('entity_id', $this->id)
            ->where('identifier', 'image')
            ->first();

        return $file ? $file->url : null;
    }

}
