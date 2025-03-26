<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Exam\Models\Exam;
use Modules\Exam\Models\Question;
use Modules\Student\Models\StudentExamResult;

class StudentExam extends Model
{
    use HasFactory;

    public const STARTED = 'started';
    public const SUBMITTED = 'submitted';
    public const AWAITING_RESULT = 'awaiting_result';
    public const RESULT_RELEASED = 'result_released';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'exam_id',
        'user_id',
        'challenge_id', // if exam is a challenge
        'payment_required',
        'questions',
        'is_paid',
        'attempts',
        'status',
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'questions' => 'array',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    protected $appends = ['duration'];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    /**
     * Calculate and summarize the student's exam result, including pass/fail status.
     */
    public function result()
    {
        // Fetch all student submissions for this exam
        $submissions = StudentExamResult::where('student_exam_id', $this->id)->get();

        // Fetch the exam details
        $exam = Exam::find($this->exam_id);
        $examType = $exam->question_type;

        // Initialize counters for correct answers, total marks, and negative marking
        $totalMarks = 0;
        $totalCorrect = 0;
        $negativeMarks = 0;

        // Iterate over student submissions and calculate marks
        foreach ($submissions as $submission) {
            // If negative marking is enabled and the answer is incorrect, reduce marks
            if (!$submission->is_correct && $exam->negative_marking && $exam->reduce_mark) {
                $negativeMarks += $exam->reduce_mark; // Deduct negative marks per incorrect answer
            }

            // Increment total marks with the mark given to each question
            $totalMarks += $submission->mark;

            // Count correct answers
            if ($submission->is_correct) {
                $totalCorrect++;
            }
        }

        // Calculate total possible marks and final score after accounting for negative marking
        $totalQuestions = count($this->questions);
        $totalPossibleMarks = $exam->totalmark;
        $finalScore = max(0, $totalMarks - $negativeMarks); // Ensure score doesn't go below zero

        // Calculate percentage of correct answers
        // Safe version
        $correctPercentage = ($totalPossibleMarks > 0) ? ($finalScore / $totalPossibleMarks) * 100 : 0;


        // Check if the student passed
        $isPassed = $correctPercentage >= $exam->pass_percentage;

        // Return a detailed summary of the result
        // $time_taken = $this->started_at ? (double)($this->started_at->diffInMinutes($this->ended_at) ) : 2.00;
        $time_taken = $this->started_at ? round((double)($this->started_at->diffInMinutes($this->ended_at)), 2) : 2.00;

        return [
            'exam_type' => $examType == 1 ? 'mcq' : 'essay',
            'total_questions' => $totalQuestions,
            'total_correct' => $totalCorrect,
            'total_marks_earned' => $finalScore,
            'total_possible_marks' => $totalPossibleMarks,
            'correct_percentage' => $correctPercentage,
            'passed' => $isPassed ? 'Yes' : 'No',
            'pass_percentage' => $exam->pass_percentage,
            'negative_marks' => $negativeMarks,
            'student_exam' => $this,
            'exam_details' => $exam,
            'time_taken' => $time_taken
        ];
    }

    public function getExamReview()
    {
        // Fetch all submissions for this exam
        $submissions = StudentExamResult::where('student_exam_id', $this->id)
            // ->with(['question.options']) // Eager load questions and their options
            ->get()
            ->keyBy('question_id'); // Index by question_id for easier lookup

        // Fetch all questions that were served to the student
        $questions = Question::whereIn('id', $this->questions)
            ->with('options')
            ->get();

        // dd($questions);
        $reviewData = [];

        foreach ($questions as $question) {
            $submission = $submissions->get($question->id);

            // dd($submission);

            $questionReview = [
                'question_id' => $question->id,
                'question_text' => $question->question,
                'question_type' => $question->options->isNotEmpty() ? 'multiple_choice' : 'essay',
                'marks' => $question->marks ?? 1,
                'is_attempted' => !is_null($submission),
                'is_correct' => $submission ? $submission->is_correct : null,
                'marks_obtained' => $submission ? $submission->mark : 0,
            ];

            // Handle multiple choice questions
            if ($question->options->isNotEmpty()) {
                $studentAnswer = $submission ? $submission->answer : null;

                $questionReview['options'] = $question->options->map(function ($option) use ($studentAnswer)  {
                    return [
                        'id' => $option->id,
                        'text' => $option->option,
                        'is_correct' => $option->is_correct,
                        'student_selected' => (int)$studentAnswer == $option->id

                    ];
                });


               
            }
            // Handle essay questions
            else {
                $questionReview['student_answer'] = $submission ? $submission->answer : null;
                $questionReview['grading_status'] = $submission ?
                ($submission->is_correct === null ? 'pending' : 'graded') : 'not_attempted';
            }

            $reviewData[] = $questionReview;
        }

        return $reviewData;

    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }



    public function getDurationAttribute()
    {
        if (!$this->started_at || !$this->ended_at) {
            return null;
        }

        $startTime = Carbon::parse($this->started_at);
        $endTime = Carbon::parse($this->ended_at);
        
        // Calculate duration in seconds
        $durationInSeconds = $endTime->diffInSeconds($startTime);
        
        // Format duration into hours:minutes:seconds
        $hours = floor($durationInSeconds / 3600);
        $minutes = floor(($durationInSeconds % 3600) / 60);
        $seconds = $durationInSeconds % 60;
        
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }


    protected static function newFactory()
    {
        // return StudentExamFactory::new();
    }


}
