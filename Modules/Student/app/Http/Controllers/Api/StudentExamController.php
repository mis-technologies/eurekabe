<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Exam\Models\Exam;
use Modules\Exam\Models\Question;
use Modules\Student\Models\StudentExam;

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
    public function submit(Request $request, $id)
    {
        //
        return response()->json([]);
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
