<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Exam\Models\Exam;
use Modules\Exam\Models\Question;
use Modules\Student\Models\StudentExam;
use Modules\Student\Models\StudentExamResult;

class StudentExamController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $exams = StudentExam::whereUserId($user->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Student exams retrieved',
            'data' => $exams
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function start(Request $request,  Exam $exam)
    {
        $user = auth()->user();

        $questions = Question::whereExamId($exam->id)->inRandomOrder()->limit(20)->get();
        $payload = [
            'exam_id' => $exam->id,
            'user_id' => $user->id,
            'payment_required' => false,
            'is_paid' => false,
            'attempts' => 1,
            'status' =>  StudentExam::STARTED,
            'started_at' => now(),
            'ended_at' => null, 
            'ended_at' => null, 
            'questions' => $questions->pluck('id')
            // 'questions' => $questions->load('options'), // array of sample questions // do not save it again - the data duplication will be too much, but
            // I intend to store the question and answer on exam submissions
        ];


        $studentExam = StudentExam::create($payload);
        $studentExam['questions'] = $questions->load('options');
        return response()->json([
            'success' => true,
            'message' => 'Student exam started',
            'data' => [
                 $studentExam->load('exam'),
            ]
        ]);
    }

    /**
     * Show the specified resource.
     */
    public function show(Request $request, $id)
    {
        $user = auth()->user();
        if(!$exam = StudentExam::whereUserId($user->id)->where('id', $id)->first()){
            return response()->json([
                'success' => false,
                'message' => 'Student exam not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Student exam retrieved',
            'data' => $exam
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function submit(Request $request, StudentExam $studentExam)
    {
        // Get the submissions from the request
        $submissions = $request->json()->all();  // Assuming the payload is sent as JSON
    
        // Get the questions that were served to the student
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
    
                    // Initialize variables for correctness and marks
                    $isCorrect = false;
                    $mark = 0;
    
                    // if ($answerType === 1) {
                    //     // For multiple-choice, check if the submitted answer matches a correct option
                    //     $isCorrect = $options->where('is_correct', true)->pluck('id')->contains($userAnswer);
                    //     $mark = $isCorrect ? 1 : 0;  // Assign mark based on correctness
                    // } else {
                    //     // For essay or written-type questions, mark and correctness may be handled manually later
                    //     $mark = 0; // By default 0 for written answers, may be graded later
                    // }
    
                    // Create the StudentExamResult for this question
                    StudentExamResult::create([
                        'student_exam_id' => $studentExam->id,
                        'exam_id' => $studentExam->exam_id,
                        'user_id' => $studentExam->user_id,
                        'question' => $question->question,
                        'answer' => $userAnswer, 
                        'correct_answer' => $options->where('is_correct', true)->first()['option'], 
                        'mark' => $mark,  // Store calculated mark
                        'is_correct' => $isCorrect,  // Store correctness for multiple-choice questions
                    ]);
                }
            }
        }
    
        // Return a JSON response indicating success
        return response()->json(['message' => 'Exam submitted successfully']);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        return response()->json([]);
    }
}
