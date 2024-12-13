<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Models\School;

class Exam extends Model
{

    protected $fillable = [
        'school_id', 
        'title',
        'duration',
        'subject_id', 
        'exam_name',
        'exam_fee', 
        'instruction',
        'totalmark',
        'pass_percentage',
        'start_date',
        'end_date', 
        'status', 
        'created_by', 
        'updated_by',
        'value',
    ];

    
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

   

   
    public function passark()
    {
        return ($this->totalmark * $this->pass_percentage) / 100;
    }

   
    // public function upcomming($examid)
    // {
    //     return $this->where('id', $examid)->where('status', 1)->where('start_date', '>', \Carbon\Carbon::now()->toDateString())->first();
    // }
}
