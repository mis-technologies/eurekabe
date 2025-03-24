<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Student\Models\StudentChallenge;
use Modules\Student\Models\StudentExam;
use Modules\Student\Models\StudentLeaderBoard;

class StudentChallengeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $challenges = StudentChallenge::whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['exam', 'participants', 'winner'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Challenges retrieved',
            'data' => $challenges,
        ]);
    }

    // show
    public function show(Request $request, StudentChallenge $challenge)
    {        
        return response()->json([
            'success' => true,
            'message' => 'Challenges retrieved',
            'data' => $challenge,
        ]);
    }

    public function createChallenge(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'participant_ids' => 'required|array',
            'participant_ids.*' => 'required|exists:users,id',
        ]);

        $user = Auth::user();
        $examId = $request->input('exam_id');
        $participantIds = $request->input('participant_ids');

        $challenge = StudentChallenge::create([
            'exam_id' => $examId,
            'status' => StudentChallenge::STATUS_PENDING,
        ]);


        $challenge->participants()->attach($user->id, ['status' => 'accepted']);
        $challenge->participants()->sync($participantIds);

        return response()->json([
            'success' => true,
            'message' => 'Challenge created',
            'data' => $challenge,
        ]);
    }

    public function acceptChallenge(Request $request, StudentChallenge $challenge)
    {
        $user = Auth::user();
        $participant = $challenge->participants()->where('user_id', $user->id)->first();

        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'You are not a participant of this challenge',
            ], 403);
        }

        // $challenge->participants()->sync($participant->id, ['status' => 'accepted']);
        $participant = $challenge->participants()->where('user_id', $user->id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Challenge accepted',
            'data' => $participant,
        ]);
    }

    public function startChallenge(Request $request, StudentChallenge $challenge)
    {
        $user = Auth::user();
        $participant = $challenge->participants()->where('user_id', $user->id)->first();

        if (!$participant || $participant->pivot->status !== 'accepted') {
            return response()->json([
                'success' => false,
                'message' => 'Challenge not accepted yet',
            ], 400);
        }

        $exam = $challenge->exam;
        $questions = $exam->questions()->inRandomOrder()->limit(20)->get();

        $payload = [
            'exam_id' => $exam->id,
            'user_id' => $user->id,
            'payment_required' => false,
            'is_paid' => false,
            'attempts' => 1,
            'status' => StudentExam::STARTED,
            'started_at' => now(),
            'questions' => $questions->pluck('id'),
            'challenge_id' => $challenge->id,
        ];

        $studentExam = StudentExam::create($payload);
        $studentExam['questions'] = $questions->load('options');

        return response()->json([
            'success' => true,
            'message' => 'Challenge started',
            'data' => $studentExam,
        ]);
    }

    public function submitChallenge(Request $request, StudentChallenge $challenge)
    {
        $studentExam = StudentExam::where('exam_id', $challenge->exam_id)
            // ->where('status', StudentExam::STARTED)
            ->first();

        $studentExam->ended_at = now();
        $studentExam->status = StudentExam::SUBMITTED;
        $studentExam->save();
        $result = $studentExam->result();

        // Calculate points based on the result
        $pointsEarned = $result['total_correct'];
        if ($result['passed'] === 'Yes') {
            $pointsEarned += 10;
        }
        StudentLeaderBoard::updateOrCreate([
            'user_id' => $studentExam->user_id,
            'exam_id' => $studentExam->exam_id,
            'challenge_id' => $studentExam->challenge_id,
        ], [
            'points' => $pointsEarned,
        ]);

        // Update participant score
        $challenge = StudentChallenge::where('exam_id', $studentExam->exam_id)
            ->whereHas('participants', function ($query) use ($studentExam) {
                $query->where('user_id', $studentExam->user_id);
            })
            ->first();

        if ($challenge) {
            $participant = $challenge->participants()->where('user_id', $studentExam->user_id)->first();
            $participant->pivot->score = $result['total_marks_earned'];
            $participant->pivot->save();

            // Determine the winner if all participants have completed the challenge
            $allSubmitted = $challenge->participants()->wherePivot('status', '!=', 'submitted')->count() === 0;

            if ($allSubmitted) {
                $winner = $challenge->participants()->orderByDesc('pivot_score')->first();
                $challenge->winner_id = $winner->id;
                $challenge->status = StudentChallenge::STATUS_COMPLETED;
                $challenge->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Challenge submitted successfully',
            'data' => [
                'result' => $result,
                'points_earned' => $pointsEarned,
                'review' => $studentExam->getExamReview(),
            ],
        ]);
    }


    // get challenge ranking based of student leaderboard with challenge_id
    public function getChallengeRanking(Request $request, StudentChallenge $challenge)
    {
        $leaderboard = StudentLeaderBoard::with('user')->where('challenge_id', $challenge->id)
            ->orderByDesc('points')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Challenge ranking retrieved',
            'data' => $leaderboard,
        ]);
    }
}