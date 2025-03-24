<?php

namespace Modules\Exam\Models;

use Modules\File\Models\File;
use Modules\Common\Models\School;
use Modules\Common\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Modules\Student\Models\StudentExam;
use Modules\Student\Models\StudentExamResult;

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

    public $appends  = ['rating', 'feedback_count', 'questions_count', 'created_by', 'last_updated_at', 'tag'];

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
        $examCoverImage = File::where('entity', $entity )->where('entity_id', $this->id)->where('identifier', 'image')->first();
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

    public function getTagAttribute()
    {
        $attempts = StudentExam::where('exam_id', $this->id)->count();

        if ($attempts > 100) {
            return 'Most Engaged';
        }
        if ($attempts > 50) {
            return 'Popular';
        }
        if ($attempts > 10) {
            return 'Trending';
        }
        
        if ($attempts > 5) {
            return 'Upcoming';
        }

        return 'New';
    }

    // get exam totalmark from questions
    // public function getTotalmarkAttribute()
    // {
    //     $questions = Question::where('exam_id', $this->id)->get();
    //     $totalmark = 0;
    //     foreach ($questions as $question) {
    //         $totalmark += $question->marks;
    //     }
    //     return $totalmark;
    // }

    public function examResults (){
        return $this->hasMany(StudentExamResult::class, 'exam_id');
    }
    public function recentExamResults (){
        return $this->hasMany(StudentExamResult::class, 'exam_id')->orderBy('created_at', 'desc')->limit(10);
    }
}
