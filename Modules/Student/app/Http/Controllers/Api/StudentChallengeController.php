<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        ->with(['exam', 'participants', 'winner', 'user'])
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Challenges retrieved',
            'data' => $challenges,
        ]);
    }

    public function show(Request $request, StudentChallenge $challenge)
    {
        return response()->json([
            'success' => true,
            'message' => 'Challenge retrieved',
            'data' => $challenge->load('participants', 'exam', 'user'),
        ]);
    }

    public function createChallenge(Request $request)
    {
        $request->validate([
            'exam_id'          => 'required|exists:exams,id',
            'participant_ids'  => 'required|array|min:1',
            'participant_ids.*' => 'required|exists:users,id',
            'scheduled_at'     => 'nullable|date|after:now',
        ]);

        $user = Auth::user();
        $participantIds = collect($request->input('participant_ids'))
            ->reject(fn($id) => $id == $user->id) // creator cannot invite themselves
            ->unique()
            ->values();

        if ($participantIds->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'You must invite at least one other student',
            ], 422);
        }

        $challenge = StudentChallenge::create([
            'user_id'      => $user->id,
            'exam_id'      => $request->input('exam_id'),
            'status'       => StudentChallenge::STATUS_PENDING,
            'scheduled_at' => $request->input('scheduled_at'),
        ]);

        // Creator is auto-accepted; invitees start as pending
        $participantsWithStatus = $participantIds
            ->mapWithKeys(fn($id) => [$id => ['status' => StudentChallengeParticipant::STATUS_PENDING]])
            ->put($user->id, ['status' => StudentChallengeParticipant::STATUS_ACCEPTED])
            ->all();

        $challenge->participants()->sync($participantsWithStatus);

        event(new ChallengeCreated($challenge));

        return response()->json([
            'success' => true,
            'message' => 'Challenge created',
            'data' => $challenge->load('participants', 'exam'),
        ]);
    }

    public function updateChallenge(Request $request, StudentChallenge $challenge)
    {
        $user = Auth::user();

        if ($challenge->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Only the challenge creator can edit this challenge',
            ], 403);
        }

        // Guard: no edits once someone has submitted
        $hasSubmissions = StudentChallengeParticipant::where('challenge_id', $challenge->id)
            ->where('status', StudentChallengeParticipant::STATUS_SUBMITTED)
            ->exists();

        if ($hasSubmissions) {
            return response()->json([
                'success' => false,
                'message' => 'Challenge cannot be edited after a participant has submitted',
            ], 422);
        }

        $request->validate([
            'exam_id'      => 'sometimes|exists:exams,id',
            'scheduled_at' => 'nullable|date|after:now',
        ]);

        $challenge->fill($request->only('exam_id', 'scheduled_at'));
        $challenge->save();

        return response()->json([
            'success' => true,
            'message' => 'Challenge updated',
            'data'    => $challenge->load('participants', 'exam', 'user', 'winner'),
        ]);
    }

    public function addParticipants(Request $request, StudentChallenge $challenge)
    {
        $user = Auth::user();

        if ($challenge->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Only the challenge creator can add participants',
            ], 403);
        }

        $hasSubmissions = StudentChallengeParticipant::where('challenge_id', $challenge->id)
            ->where('status', StudentChallengeParticipant::STATUS_SUBMITTED)
            ->exists();

        if ($hasSubmissions) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot add participants after someone has already submitted',
            ], 422);
        }

        $request->validate([
            'participant_ids'   => 'required|array|min:1',
            'participant_ids.*' => 'required|exists:users,id',
        ]);

        $existingIds = StudentChallengeParticipant::where('challenge_id', $challenge->id)
            ->pluck('user_id')
            ->toArray();

        $newIds = collect($request->input('participant_ids'))
            ->reject(fn($id) => $id == $user->id || in_array($id, $existingIds))
            ->unique()
            ->values();

        if ($newIds->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'All provided users are already participants',
            ], 422);
        }

        $newParticipants = $newIds->mapWithKeys(fn($id) => [
            $id => ['status' => StudentChallengeParticipant::STATUS_PENDING],
        ])->all();

        $challenge->participants()->syncWithoutDetaching($newParticipants);

        // Notify the newly added participants
        $challenge->load('participants');
        event(new ChallengeCreated($challenge));

        return response()->json([
            'success' => true,
            'message' => 'Participants added',
            'data'    => $challenge->load('participants', 'exam', 'user', 'winner'),
        ]);
    }

    public function acceptChallenge(Request $request, StudentChallenge $challenge)
    {
        $user   = Auth::user();
        $record = StudentChallengeParticipant::where('challenge_id', $challenge->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'You are not a participant of this challenge',
            ], 403);
        }

        if ($record->status !== StudentChallengeParticipant::STATUS_PENDING) {
            return response()->json([
                'success' => false,
                'message' => 'You can no longer accept this challenge',
            ], 400);
        }

        $record->update(['status' => StudentChallengeParticipant::STATUS_ACCEPTED]);

        event(new ChallengeAcceptedDeclined($challenge, 'accepted', $user->firstname));

        return response()->json([
            'success' => true,
            'message' => 'Challenge accepted',
        ]);
    }

    public function rejectChallenge(Request $request, StudentChallenge $challenge)
    {
        $user   = Auth::user();
        $record = StudentChallengeParticipant::where('challenge_id', $challenge->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'You are not a participant of this challenge',
            ], 403);
        }

        if ($record->status !== StudentChallengeParticipant::STATUS_PENDING
            && $record->status !== StudentChallengeParticipant::STATUS_ACCEPTED) {
            return response()->json([
                'success' => false,
                'message' => 'You can no longer decline this challenge',
            ], 400);
        }

        // Mark as declined so the allSubmitted count stays correct
        $record->update(['status' => StudentChallengeParticipant::STATUS_DECLINED]);

        event(new ChallengeAcceptedDeclined($challenge, 'declined', $user->firstname));

        return response()->json([
            'success' => true,
            'message' => 'Challenge declined',
        ]);
    }

    /**
     * Challenge creator removes a pending invitee before they accept.
     */
    public function removeParticipant(Request $request, StudentChallenge $challenge, User $user)
    {
        $authUser = Auth::user();

        if ($challenge->user_id !== $authUser->id) {
            return response()->json([
                'success' => false,
                'message' => 'Only the challenge creator can remove participants',
            ], 403);
        }

        if ($user->id === $authUser->id) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot remove yourself from a challenge you created',
            ], 422);
        }

        $participantRecord = StudentChallengeParticipant::where('challenge_id', $challenge->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$participantRecord) {
            return response()->json([
                'success' => false,
                'message' => 'This user is not a participant of this challenge',
            ], 404);
        }

        if ($participantRecord->status !== StudentChallengeParticipant::STATUS_PENDING) {
            return response()->json([
                'success' => false,
                'message' => 'You can only remove participants who have not yet responded',
            ], 400);
        }

        $challenge->participants()->detach($user->id);

        return response()->json([
            'success' => true,
            'message' => 'Participant removed',
        ]);
    }

    public function startChallenge(Request $request, StudentChallenge $challenge)
    {
        $user   = Auth::user();
        $record = StudentChallengeParticipant::where('challenge_id', $challenge->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'You are not a participant of this challenge',
            ], 403);
        }

        if ($record->status === StudentChallengeParticipant::STATUS_SUBMITTED) {
            return response()->json([
                'success' => false,
                'message' => 'You have already submitted this challenge',
            ], 400);
        }

        if ($record->status !== StudentChallengeParticipant::STATUS_ACCEPTED) {
            return response()->json([
                'success' => false,
                'message' => 'You must accept the challenge before starting',
            ], 400);
        }

        // Prevent starting again if an exam session already exists
        $existing = StudentExam::where('challenge_id', $challenge->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existing) {
            $existing->load('questions.options'); // reload with options if needed
            return response()->json([
                'success' => true,
                'message' => 'Challenge already started',
                'data' => $existing,
            ]);
        }

        $exam = $challenge->exam;
        $questions = $exam->questions()->inRandomOrder()->limit(20)->get();

        $studentExam = StudentExam::create([
            'exam_id'          => $exam->id,
            'user_id'          => $user->id,
            'payment_required' => false,
            'is_paid'          => false,
            'attempts'         => 1,
            'status'           => StudentExam::STARTED,
            'started_at'       => now(),
            'questions'        => $questions->pluck('id'),
            'challenge_id'     => $challenge->id,
        ]);

        $studentExam['questions'] = $questions->load('options');

        return response()->json([
            'success' => true,
            'message' => 'Challenge started',
            'data' => $studentExam,
        ]);
    }

    public function submitChallenge(SubmitStudentExamRequest $request, StudentChallenge $challenge)
    {
        $submissions = $request->validated()['submissions'];

        $user   = Auth::user();
        $record = StudentChallengeParticipant::where('challenge_id', $challenge->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'You are not a participant of this challenge',
            ], 403);
        }

        if ($record->status === StudentChallengeParticipant::STATUS_SUBMITTED) {
            return response()->json([
                'success' => false,
                'message' => 'You have already submitted this challenge',
            ], 400);
        }

        if ($record->status !== StudentChallengeParticipant::STATUS_ACCEPTED) {
            return response()->json([
                'success' => false,
                'message' => 'You must accept the challenge before submitting',
            ], 400);
        }

        $studentExam = StudentExam::where('challenge_id', $challenge->id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $studentExam->submitExam($submissions);
        $studentExam->ended_at = now();
        $studentExam->status = StudentExam::SUBMITTED;
        $studentExam->save();

        $result = $studentExam->result();
        $pointsEarned = $result['total_marks_earned'];

        $leaderResult = StudentLeaderBoard::updateOrCreate(
            ['user_id' => $user->id, 'challenge_id' => $challenge->id],
            ['points' => $pointsEarned, 'exam_id' => $studentExam->exam_id]
        );

        // Record score and mark as submitted — use a transaction with lock to
        // safely determine the winner when multiple participants finish at once
        DB::transaction(function () use ($challenge, $user, $pointsEarned) {
            StudentChallengeParticipant::where('challenge_id', $challenge->id)
                ->where('user_id', $user->id)
                ->lockForUpdate()
                ->update([
                    'score'  => $pointsEarned,
                    'status' => StudentChallengeParticipant::STATUS_SUBMITTED,
                ]);

            // All submitted when no active (pending/accepted) participants remain
            $stillActive = StudentChallengeParticipant::where('challenge_id', $challenge->id)
                ->whereIn('status', [
                    StudentChallengeParticipant::STATUS_PENDING,
                    StudentChallengeParticipant::STATUS_ACCEPTED,
                ])
                ->lockForUpdate()
                ->count();

            if ($stillActive === 0) {
                $winner = StudentChallengeParticipant::where('challenge_id', $challenge->id)
                    ->where('status', StudentChallengeParticipant::STATUS_SUBMITTED)
                    ->orderByDesc('score')
                    ->first();

                $challenge->winner_id = $winner?->user_id;
                $challenge->status = StudentChallenge::STATUS_COMPLETED;
            } else {
                $challenge->status = StudentChallenge::STATUS_ONGOING;
            }

            $challenge->save();
        });

        // Refresh participant for the event
        $participantRecord = StudentChallengeParticipant::where('challenge_id', $challenge->id)
            ->where('user_id', $user->id)
            ->first();

        event(new ChallengeSubmitted($challenge->fresh(), $participantRecord->user->firstname ?? $user->firstname));

        return response()->json([
            'success' => true,
            'message' => 'Challenge submitted successfully',
            'data' => [
                'challenge' => $leaderResult,
                'result'    => $result,
                'points_earned' => $pointsEarned,
                'review'    => $studentExam->getExamReview(),
            ],
        ]);
    }

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
            'data' => [
                'challenge'    => $challenge->load('winner'),
                'participants' => $results,
            ],
        ]);
    }
}
