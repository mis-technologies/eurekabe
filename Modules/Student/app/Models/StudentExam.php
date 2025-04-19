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

        'total_marks_earned', // very important to enable sorting and filtering
        'total_correct',
        'pass_percentage',
        'total_questions',
        'total_possible_marks',
        'passed',
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

        // I need to calculate totalmark from the list of questions that was sampled for the exam, student_exam has array of question ids
        $studentExamQuestions = $this->questions;
        $totalPossibleMarks = Question::whereIn('id', $studentExamQuestions)->sum('marks');
        // $totalPossibleMarks = $exam->totalmark;
        $finalScore = max(0, $totalMarks - $negativeMarks); // Ensure score doesn't go below zero

        // Calculate percentage of correct answers
        // Safe version
        $correctPercentage = ($totalPossibleMarks > 0) ? ($finalScore / $totalPossibleMarks) * 100 : 0;

        // Check if the student passed
        $isPassed = $correctPercentage >= $exam->pass_percentage;

        // Return a detailed summary of the result
        // $time_taken = $this->started_at ? (double)($this->started_at->diffInMinutes($this->ended_at) ) : 2.00;
        $time_taken = $this->started_at ? round((double) ($this->started_at->diffInMinutes($this->ended_at)), 2) : 2.00;

        // Store in the database
        if ($this->total_marks_earned !== $finalScore) {
            $this->update(['total_marks_earned' => $finalScore]);
        }
        if ($this->total_correct !== $totalCorrect) {
            $this->update(['total_correct' => $totalCorrect]);
        }
        if ($this->total_questions !== $totalQuestions) {
            $this->update(['total_questions' => $totalQuestions]);
        }
        if ($this->total_possible_marks !== $totalPossibleMarks) {
            $this->update(['total_possible_marks' => $totalPossibleMarks]);
        }
        if ($this->pass_percentage !== $exam->pass_percentage) {
            $this->update(['pass_percentage' => $exam->pass_percentage]);
        }
        if ($this->passed !== $exam->passed) {
            $this->update(['passed' => $isPassed ]);
        }

        return [
            'exam_type' => $examType == 1 ? 'mcq' : 'essay',
            'total_questions' => $totalQuestions,
            'total_correct' => round($totalCorrect),
            'total_marks_earned' => round($finalScore, 2),
            'total_possible_marks' => round($totalPossibleMarks, 2),
            'correct_percentage' => round($correctPercentage, 2),
            'passed' => $isPassed ? 'Yes' : 'No',
            'pass_percentage' => $exam->pass_percentage,
            'negative_marks' => $negativeMarks,
            'student_exam' => $this,
            'exam_details' => $exam,
            'time_taken' => $time_taken,
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

                $questionReview['options'] = $question->options->map(function ($option) use ($studentAnswer) {
                    return [
                        'id' => $option->id,
                        'text' => $option->option,
                        'is_correct' => $option->is_correct,
                        'student_selected' => (int) $studentAnswer == $option->id,

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


    public function submitExam($submissions)
    {
        $studentExam = $this;
        $questionIds = $studentExam->questions;

        // Loop through the submissions and process each question
        foreach ($submissions as $submission) {
            $questionId = $submission['question'];
            $userAnswer = $submission['answer'];
            // Check if the question is part of the served questions
            if (in_array($questionId, $questionIds)) {
                // Find the question and load its options if it's a multiple-choice question
                if ($question = Question::find($questionId)->load('options')) {
                    $options = $question['options'];

                    // Determine the answer type (assume multiple choice if options exist, otherwise essay)
                    $answerType = $options->isNotEmpty() ? 1 : 2;
                    $examType = $studentExam->exam->question_type;

                    // Initialize variables for correctness and marks
                    $isCorrect = false;
                    $mark = 0;

                    if ($examType === 1) {
                        // For multiple-choice, check if the submitted answer matches a correct option
                        $isCorrect = $options->where('is_correct', true)->pluck('id')->contains($userAnswer);
                        $mark = $isCorrect ? ($question->marks ?? 1) : 0;

                        // Create the StudentExamResult for this question
                        $correct_option = $options->where('is_correct', true)->first();
                        $correct_answer = $correct_option ? $correct_option['option'] : null;
                        StudentExamResult::updateOrCreate([
                            'student_exam_id' => $studentExam->id,
                            'question_id' => $question->id,
                        ], [
                            'student_exam_id' => $studentExam->id,
                            'exam_id' => $studentExam->exam_id,
                            'user_id' => $studentExam->user_id,
                            'question_id' => $question->id,
                            'answer' => $userAnswer,
                            'correct_answer' => $correct_answer, // Store correct answer for multiple-choice questions
                            'mark' => $mark, // Store calculated mark
                            'is_correct' => $isCorrect, // Store correctness for multiple-choice questions
                        ]);

                    } else {
                        // For  or written-type questions, mark and correctness may be handled manually later
                        $mark = 0; // By default 0 for written answers, may be graded later
                        StudentExamResult::updateOrCreate([
                            'student_exam_id' => $studentExam->id,
                            'question_id' => $question->id,
                        ], [
                            'student_exam_id' => $studentExam->id,
                            'exam_id' => $studentExam->exam_id,
                            'user_id' => $studentExam->user_id,
                            'question_id' => $question->id,
                            'answer' => $userAnswer,
                            'correct_answer' => "N/A", // No correct answer for written questions
                            'mark' => $mark, // Store calculated mark
                            'is_correct' => $isCorrect, // Store correctness for multiple-choice questions
                        ]);

                    }

                }
            }
        }
    }

}
