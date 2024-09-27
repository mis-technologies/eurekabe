<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Models\School;

class Exam extends Model
{
    protected $guarded = [];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_id');
    }

    // public function results()
    // {
    //     return $this->hasMany(Result::class, 'exam_id');
    // }

   
    public function passark()
    {
        return ($this->totalmark * $this->pass_percentage) / 100;
    }

   
    // public function upcomming($examid)
    // {
    //     return $this->where('id', $examid)->where('status', 1)->where('start_date', '>', \Carbon\Carbon::now()->toDateString())->first();
    // }
}
