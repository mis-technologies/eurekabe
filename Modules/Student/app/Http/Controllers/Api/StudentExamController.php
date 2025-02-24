<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Exam\Models\Exam;
use Modules\Exam\Models\ExamFeedback;
use Modules\Exam\Models\Question;
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
    public function submit(Request $request, StudentExam $studentExam)
    {
        // Get the submissions from the request
        $submissions = $request->json()->all(); // Assuming the payload is sent as JSON

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
                        // For essay or written-type questions, mark and correctness may be handled manually later
                        $mark = 0; // By default 0 for written answers, may be graded later

                        // Create the StudentExamResult for this question
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

        $studentExam->ended_at = now();
        $studentExam->status = StudentExam::SUBMITTED;
        $studentExam->save();
        $result = $studentExam->result();

        // Calculate points based on the result
        $pointsEarned = $result['total_correct']; // Example: 1 point per correct answer
        if ($result['passed'] === 'Yes') {
            $pointsEarned += 10; // Example: Add bonus points for passing
        }
        StudentLeaderBoard::create([
            'user_id' => $studentExam->user_id,
            'exam_id' => $studentExam->exam_id,
            'points' => $pointsEarned,
        ]);

        //TODO: get student rank base on leaderboard over all students that have taken the exam

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
