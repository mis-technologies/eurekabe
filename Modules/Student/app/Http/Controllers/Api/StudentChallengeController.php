<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Student\Events\ChallengeAcceptedDeclined;
use Modules\Student\Events\ChallengeCreated;
use Modules\Student\Events\ChallengeSubmitted;
use Modules\Student\Http\Requests\SubmitStudentExamRequest;
use Modules\Student\Models\StudentChallenge;
use Modules\Student\Models\StudentChallengeParticipant;
use Modules\Student\Models\StudentExam;
use Modules\Student\Models\StudentLeaderBoard;

class StudentChallengeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $challenges = StudentChallenge::whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->latest()
        ->with(['exam', 'participants', 'winner'])
        ->get();

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
            'data' => $challenge->load('participants', 'exam', 'user'),
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
            'user_id' => $user->id,
            'exam_id' => $examId,
            'status' => StudentChallenge::STATUS_PENDING,
        ]);

        // Create an array with all participants including the user with status
        $participantsWithStatus = collect($participantIds)
            ->mapWithKeys(function ($id) {
                return [$id => ['status' => 'pending']];
            })
            ->put($user->id, ['status' => 'accepted'])
            ->all();

        $challenge->participants()->sync($participantsWithStatus);

        event(new ChallengeCreated($challenge));

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

        // if ($participant->status != 'pending') {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'You can no longer accept this challenge',
        //     ], 400);
        // }

        $challenge->participants()->updateExistingPivot($participant->id, [
            'status' => 'accepted'
        ]);

        $participant = $challenge->participants()->where('user_id', $user->id)->first();
        event(new ChallengeAcceptedDeclined($challenge, 'accepted', $participant->firstname));

        return response()->json([
            'success' => true,
            'message' => 'Challenge accepted',
            'data' => $participant,
        ]);
    }

    public function rejectChallenge(Request $request, StudentChallenge $challenge)
    {
        $user = Auth::user();
        $participant = $challenge->participants()->where('user_id', $user->id)->first();

        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'You are not a participant of this challenge',
            ], 403);
        }

        if ($participant->status !== 'pending' || $participant->status !== 'accepted') {
            return response()->json([
                'success' => false,
                'message' => 'You can no longer decline this challenge',
            ], 400);
        }

        event(new ChallengeAcceptedDeclined($challenge, 'declined', $participant->firstname));
        $challenge->participants()->detach($participant->id);

        // delete the challenge if the user is the only participant
        if ($challenge->participants()->count() === 1) {
            $challenge->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Challenge rejected',
        ]);
    }

    public function startChallenge(Request $request, StudentChallenge $challenge)
    {
        $user = Auth::user();
        $participant = $challenge->participants()->where('user_id', $user->id)->first();

        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'You are not a participant of this challenge',
            ], 400);
        }

        if ($participant->status == 'submitted') {
            return response()->json([
                'success' => false,
                'message' => 'You have already submitted the challenge',
            ], 400);
        }


        if (!$participant || $participant->status !== 'accepted') {
            return response()->json([
                'success' => false,
                'message' => 'You have not accepted yet',
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

    public function submitChallenge(SubmitStudentExamRequest $request, StudentChallenge $challenge)
    {

        $submissions = $request->validated();

        $user = Auth::user();
        $participant = $challenge->participants()->where('user_id', $user->id)->first();
        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'You are not a participant of this challenge',
            ], 400);
        }

        if ($participant->status == 'submitted') {
            return response()->json([
                'success' => false,
                'message' => 'You have already submitted the challenge',
            ], 400);
        }

        if ($participant->status !== 'accepted') {
            return response()->json([
                'success' => false,
                'message' => 'You have not accepted the challenge yet',
            ], 400);
        }


        $studentExam = StudentExam::where('challenge_id', $challenge->id)->where('user_id', $user->id )->first();
        $studentExam->submitExam($submissions);

        $studentExam->ended_at = now();
        $studentExam->status = StudentExam::SUBMITTED;
        $studentExam->save();
        $result = $studentExam->result();

        // Calculate points based on the result
        $pointsEarned = $result['total_marks_earned'];
        $leaderResult = StudentLeaderBoard::updateOrCreate([
            'user_id' => $studentExam->user_id,
            'challenge_id' => $studentExam->challenge_id,
        ], [
            'points' => $pointsEarned,
            'user_id' => $studentExam->user_id,
            'exam_id' => $studentExam->exam_id,
            'challenge_id' => $challenge->id,
        ]);

       

        if ($challenge) {
            $participant = StudentChallengeParticipant::where('challenge_id', $challenge->id)
                ->where('user_id', $studentExam->user_id)
                ->first();

            if ($participant) {
                $participant->score = $result['total_marks_earned'];
                $participant->status = 'submitted';
                $participant->save();

                // Determine the winner if all participants have completed the challenge
                $allSubmitted = $challenge->participants()
                    ->wherePivot('status', '=', 'submitted') // Changed from != to =
                    ->count() === $challenge->participants()->count(); // Compare with total participants

                if ($allSubmitted) {
                    $winner = $challenge->participants()
                        ->orderByDesc('score')
                        ->first();

                    if ($winner) {
                        $challenge->winner_id = $winner->id;
                        $challenge->status = StudentChallenge::STATUS_COMPLETED;
                        $challenge->save();
                    }
                }else{
                    $challenge->status = StudentChallenge::STATUS_ONGOING;
                    $challenge->save();
                }

                event(new ChallengeSubmitted($challenge, $participant->firstname, ));

            }
        }
       

        return response()->json([
            'success' => true,
            'message' => 'Challenge submitted successfully',
            'data' => [
                'challenge' => $leaderResult,
                'result' => $result,
                'points_earned' => $pointsEarned,
                'review' => $studentExam->getExamReview(),
            ],
        ]);
    }

    // get challenge ranking based of student leaderboard with challenge_id
    public function getChallengeRanking(Request $request, StudentChallenge $challenge)
    {

        $results = StudentChallengeParticipant::where('challenge_id', $challenge->id)
            ->with(['user' => function ($query) {
                $query->select('id', 'firstname', 'lastname', 'image');
            }])
            ->orderByDesc('score')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Challenge ranking retrieved',
            'data' => $results,
        ]);
    }
}
