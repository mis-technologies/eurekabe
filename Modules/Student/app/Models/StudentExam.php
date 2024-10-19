<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Exam\Models\Exam;
use Modules\Exam\Models\Question;
use Modules\Student\Models\StudentExamResult;
use Modules\Student\Database\Factories\StudentExamFactory;

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
        'payment_required',
        'questions',
        'is_paid',
        'attempts',
        'status',
        'started_at',
        'ended_at'
    ];

    protected $casts = [
        'questions' => 'array'
    ];

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

        // Initialize counters for correct answers, total marks, and negative marking
        $totalMarks = 0;
        $totalCorrect = 0;
        $negativeMarks = 0;

        // Iterate over student submissions and calculate marks
        foreach ($submissions as $submission) {
            // If negative marking is enabled and the answer is incorrect, reduce marks
            if (!$submission->is_correct && $exam->negative_marking && $exam->reduce_mark) {
                $negativeMarks += $exam->reduce_mark;  // Deduct negative marks per incorrect answer
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
        $finalScore = max(0, $totalMarks - $negativeMarks);  // Ensure score doesn't go below zero

        // Calculate percentage of correct answers
        $correctPercentage = ($totalQuestions > 0) ? ($finalScore / $totalPossibleMarks) * 100 : 0;

        // Check if the student passed
        $isPassed = $correctPercentage >= $exam->pass_percentage;

        // Return a detailed summary of the result
        return [
            'total_questions'     => $totalQuestions,
            'total_correct'       => $totalCorrect,
            'total_marks_earned'  => $finalScore,
            'total_possible_marks'=> $totalPossibleMarks,
            'correct_percentage'  => $correctPercentage,
            'passed'              => $isPassed ? 'Yes' : 'No',
            'pass_percentage'     => $exam->pass_percentage,
            'negative_marks'      => $negativeMarks,
            'student_exam'        => $this->all(),
            'exam_details'       => $exam,
        ];
    }

    protected static function newFactory()
    {
        // return StudentExamFactory::new();
    }
}
