<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Models\School;
use Modules\File\Models\File;

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
        'image',
        'status', 
        'created_by', 
        'updated_by',
        'value',
    ];

    
    protected $guarded = [];

    public $appends  = ['rating', 'feedback_count', 'questions_count', 'created_by', 'last_updated_at'];

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

   
    public function getImageAttribute()
    {
       $entity =  get_class($this);
        $examCoverImage = File::where('entity', $entity )->where('entity_id', $this->id)->where('identifier', 'cover_image')->first();
        if (!$examCoverImage ) {
            return asset('assets/images/noimage.jpg');
        }
        return $examCoverImage->url;
    }

    public function getRatingAttribute()
    {
        $ratings = ExamFeedback::where('exam_id', $this->id)->average('rating');
        return $ratings;
    }

    public function getFeedbackCountAttribute()
    {
        $ratings = ExamFeedback::where('exam_id', $this->id)->count();
        return $ratings;
    }

    public function getQuestionsCountAttribute()
    {
        $questions = Question::where('exam_id', $this->id)->count();
        return $questions;
    }

    public function getCreatedByAttribute()
    {
        $user = School::where('id', $this->school_id)->first();
        return $user->name ?? 'Anonymous'; 
    }

    public function getLastUpdatedAtAttribute()
    {
        return $this->created_at->format('d M Y');
    }
}
