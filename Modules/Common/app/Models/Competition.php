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
        'price',
        'timezone',
        'window_start_hour',
        'window_end_hour',
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

    // Scopes
    public function scopePublicOnly($query)
    {
        return $query->where('visibility', 'public');
    }

    public function scopeVisibleTo($query, $user)
    {
        return $query->where(function ($q) use ($user) {
            $q->where('visibility', 'public')
              ->orWhereHas('schools', function ($sq) use ($user) {
                  $sq->whereHas('users', fn ($uq) => $uq->where('users.id', $user->id));
              });
        });
    }

    public function scopeWithinWindow($query)
    {
        return $query->where(function ($q) {
            foreach ($q->getModel()->all() as $competition) {
                if (!$this->isWithinWindow($competition)) {
                    $q->where('id', '!=', $competition->id);
                }
            }
        });
    }

    public function isWithinWindow(): bool
    {
        $now = now()->setTimezone($this->timezone);
        $currentHour = (int) $now->format('H');
        $startHour = $this->window_start_hour;
        $endHour = $this->window_end_hour;

        if ($startHour < $endHour) {
            return $currentHour >= $startHour && $currentHour < $endHour;
        }

        return $currentHour >= $startHour || $currentHour < $endHour;
    }

    public function getWindowStatusAttribute(): string
    {
        if ($this->isWithinWindow()) {
            return 'open';
        }

        $now = now()->setTimezone($this->timezone);
        $currentHour = (int) $now->format('H');
        $startHour = $this->window_start_hour;

        if ($startHour <= $currentHour) {
            return 'closed';
        }

        return 'upcoming';
    }

}
