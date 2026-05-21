<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Models\Exam;
use Modules\Common\Models\ExamFeedback;
use Modules\Common\Models\Question;
use Modules\Student\Http\Requests\SubmitStudentExamRequest;
use Modules\Student\Models\StudentExam;
use Modules\Student\Models\StudentExamResult;
use Modules\Student\Models\StudentFavoriteExam;
use Modules\Student\Models\StudentLeaderBoard;

class StudentExamController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $exams = StudentExam::whereUserId($user->id)->get()->load('exam');
        return response()->json([
            'success' => true,
            'message' => 'Student exams retrieved',
            'data' => $exams,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function start(Request $request, Exam $exam)
    {
        $user = Auth::user();
        $questions = Question::whereExamId($exam->id)->inRandomOrder()->limit(20)->get();
        $payload = [
            'exam_id' => $exam->id,
            'user_id' => $user->id,
            'payment_required' => false,
            'is_paid' => false,
            'attempts' => 1,
            'status' => StudentExam::STARTED,
            'started_at' => now(),
            'ended_at' => null,
            'ended_at' => null,
            'questions' => $questions->pluck('id'),
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
            ],
        ]);
    }

    /**
     * Show the specified resource.
     */
    public function show(Request $request, $id)
    {
        $user = Auth::user();
        if (!$exam = StudentExam::whereUserId($user->id)->where('id', $id)->first()) {
            return response()->json([
                'success' => false,
                'message' => 'Student exam not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Student exam retrieved',
            'data' => $exam,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function submit(SubmitStudentExamRequest $request, StudentExam $studentExam)
    {
        // Get the submissions from the request
        $submissions =  $request->validated();    
        $studentExam->submitExam($submissions);

        $studentExam->ended_at = now();
        $studentExam->status = StudentExam::SUBMITTED;
        $studentExam->save();
        $result = $studentExam->result();

        // Calculate points based on the result
        $pointsEarned = $result['total_correct']; // Example: 1 point per correct answer
        if ($result['passed'] === 'Yes') {
            $pointsEarned += 10; // Example: Add bonus points for passing
        }

        StudentLeaderBoard::updateOrCreate([
            'user_id' => $studentExam->user_id,
            'exam_id' => $studentExam->exam_id,
        ],[
            'user_id' => $studentExam->user_id,
            'exam_id' => $studentExam->exam_id,
            'points' => $pointsEarned,
        ]);


        // Get student rank based on leaderboard over all students that have taken the exam
        $totalStudents = StudentLeaderBoard::whereExamId($studentExam->exam_id)->count();
        $rank = StudentLeaderBoard::whereExamId($studentExam->exam_id)
            ->where('points', '>', $pointsEarned)
            ->count() + 1;

        // Return a JSON response indicating success
        return response()->json([
            'success' => true,
            'message' => 'Exam submitted successfully',
            'data' => [
                'result' => $result,
                'points_earned' => $pointsEarned,
                'rank' => [
                    'my_rank' => $rank,
                    'total_students' => $totalStudents,
                ],
                'review' => $studentExam->getExamReview(),
            ],
        ]);
    }

    /**
     * Get result of exam.
     */
    public function getExamResult(Request $request, $id)
    {
        $user = Auth::user();
        if (!$exam = StudentExam::whereUserId($user->id)->where('id', $id)->first()) {
            return response()->json([
                'success' => false,
                'message' => 'Student exam not found',
            ], 404);
        }
        $result = $exam->result();
        $result['review'] = $exam->getExamReview();
        return response()->json([
            'success' => true,
            'message' => 'Student exam result retrieved',
            'data' => $result,
        ]);
    }

    /**
     * Add exam to favorite
     */
    public function addExamToFavorite(Request $request)
    {
        $user = Auth::user();
        if (!$exam = Exam::find($request->exam_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Exam not found',
            ], 404);
        }

        $favorite = StudentFavoriteExam::create([
            'user_id' => $user->id,
            'exam_id' => $exam->id,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Exam added to favorite successfully',
            'data' => $favorite,
        ]);

    }

    // getFavoriteExams
    public function getFavoriteExams()
    {
        $user = Auth::user();
        $favoriteExamIds = StudentFavoriteExam::whereUserId($user->id)->pluck('exam_id');
        // return exams and paginate it
        $exams = Exam::whereIn('id', $favoriteExamIds)->paginate(20);
        return response()->json([
            'success' => true,
            'message' => 'Favorite exams retrieved',
            'data' => $exams,
        ]);
    }

    /**
     * Add exam to favorite
     */
    public function addExamFeedback(Request $request, $id)
    {
        $request->validate([
            'rating' => ['required', 'integer', 'max:5', 'min:1'],
        ]);

        $user = Auth::user();
        if (!$studentExam = StudentExam::whereUserId($user->id)->where('id', $id)->first()) {
            return response()->json([
                'success' => false,
                'message' => 'Student exam not found',
            ], 404);
        }

        $feedback = ExamFeedback::updateOrCreate([
            'user_id' => $user->id,
            'exam_id' => $studentExam->exam_id,
        ], [
            'user_id' => $user->id,
            'exam_id' => $studentExam->exam_id,
            'rating' => $request->rating,
            'feedback' => $request->feedback,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Exam feedback added successfully',
            'data' => $feedback,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json([]);
    }
}
