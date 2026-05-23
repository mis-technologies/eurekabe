<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Models\Competition;
use Modules\Common\Models\CompetitionParticipant;
use Modules\Student\Models\StudentExam;
use Modules\Student\Models\StudentLeaderBoard;

class StudentCompetitionController extends Controller
{
    /**
     * List competitions (search + type filter)
     */
    public function index(Request $request)
    {
        $query = Competition::with(['schools', 'exams'])
            ->where(function ($q) {
                $q->where('visibility', 'public')
                  ->orWhereHas('schools', function ($sq) {
                      $sq->whereHas('users', fn ($uq) => $uq->where('users.id', Auth::id()));
                  });
            });

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $competitions = $query->latest()->paginate(20);

        return response()->json(['status' => 'success', 'data' => $competitions]);
    }

    /**
     * Show competition details
     */
    public function show(Competition $competition)
    {
        $competition->load(['schools', 'exams', 'participants.user']);

        $myParticipant = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', Auth::id())
            ->first();

        return response()->json([
            'status' => 'success',
            'data' => $competition,
            'my_status' => $myParticipant?->status,
        ]);
    }

    /**
     * Join a competition
     */
    public function join(Competition $competition)
    {
        $existing = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existing) {
            return response()->json(['status' => 'error', 'message' => 'You have already joined this competition.'], 409);
        }

        if ($competition->status === 'completed') {
            return response()->json(['status' => 'error', 'message' => 'This competition has ended.'], 400);
        }

        $participant = CompetitionParticipant::create([
            'user_id'        => Auth::id(),
            'competition_id' => $competition->id,
            'status'         => 'pending',
        ]);

        return response()->json(['status' => 'success', 'message' => 'Joined successfully.', 'data' => $participant]);
    }

    /**
     * Leave a competition (only if not yet submitted)
     */
    public function leave(Competition $competition)
    {
        $participant = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($participant->status === 'submitted') {
            return response()->json(['status' => 'error', 'message' => 'Cannot leave after submitting.'], 400);
        }

        $participant->delete();

        return response()->json(['status' => 'success', 'message' => 'Left competition.']);
    }

    /**
     * Start an exam within a competition
     */
    public function startExam(Request $request, Competition $competition, $examId)
    {
        $participant = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$participant || $participant->status === 'rejected') {
            return response()->json(['status' => 'error', 'message' => 'You are not an approved participant.'], 403);
        }

        $competitionExam = $competition->exams()->find($examId);
        if (!$competitionExam) {
            return response()->json(['status' => 'error', 'message' => 'Exam not found in this competition.'], 404);
        }

        // Prevent re-start after submission
        $existing = StudentExam::where('exam_id', $competitionExam->id)
            ->where('user_id', Auth::id())
            ->where('competition_id', $competition->id)
            ->first();

        if ($existing && $existing->status === StudentExam::SUBMITTED) {
            return response()->json(['status' => 'error', 'message' => 'You have already submitted this exam.'], 409);
        }

        $totalQ = $competitionExam->pivot->total_questions ?? 20;
        $questions = $competitionExam->questions()->inRandomOrder()->limit($totalQ)->get();

        $studentExam = StudentExam::create([
            'exam_id'        => $competitionExam->id,
            'user_id'        => Auth::id(),
            'competition_id' => $competition->id,
            'status'         => StudentExam::STARTED,
            'started_at'     => now(),
            'questions'      => $questions->pluck('id'),
        ]);

        $studentExam['questions'] = $questions->load('options');

        return response()->json(['status' => 'success', 'data' => $studentExam]);
    }

    /**
     * Submit competition exam answers
     */
    public function submitCompetitionExam(Request $request, Competition $competition)
    {
        $request->validate([
            'student_exam_id' => 'required|integer',
            'submissions'     => 'required|array',
        ]);

        $user = Auth::user();

        $studentExam = StudentExam::where('id', $request->student_exam_id)
            ->where('competition_id', $competition->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$studentExam || $studentExam->status !== StudentExam::STARTED) {
            return response()->json(['status' => 'error', 'message' => 'No active exam found for this competition.'], 404);
        }

        $studentExam->submitExam($request->submissions);
        $studentExam->ended_at = now();
        $studentExam->status   = StudentExam::SUBMITTED;
        $studentExam->save();

        $result = $studentExam->result();

        $pointsEarned = $result['total_correct'];
        if (($result['passed'] ?? false) === 'Yes') {
            $pointsEarned += 10;
        }

        StudentLeaderBoard::updateOrCreate(
            ['user_id' => $user->id, 'competition_id' => $competition->id],
            ['points' => $pointsEarned, 'exam_id' => $studentExam->exam_id]
        );

        $participant = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', $user->id)
            ->first();

        if ($participant) {
            $participant->score        = $result['total_marks_earned'];
            $participant->status       = 'submitted';
            $participant->submitted_at = now();
            $participant->save();

            // Check if all approved participants have submitted → mark winner
            $pendingCount = CompetitionParticipant::where('competition_id', $competition->id)
                ->whereIn('status', ['pending', 'approved'])
                ->count();

            if ($pendingCount === 0) {
                $winner = CompetitionParticipant::where('competition_id', $competition->id)
                    ->orderByDesc('score')
                    ->first();

                $competition->winner_id = $winner->user_id;
                $competition->status    = 'completed';
                $competition->save();
            }
        }

        return response()->json([
            'status'        => 'success',
            'message'       => 'Exam submitted successfully.',
            'data'          => [
                'result'        => $result,
                'points_earned' => $pointsEarned,
                'review'        => $studentExam->getExamReview(),
            ],
        ]);
    }

    /**
     * My submission for this competition
     */
    public function submission(Competition $competition)
    {
        $participant = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', Auth::id())
            ->first();

        return response()->json(['status' => 'success', 'data' => $participant]);
    }

    /**
     * Competition leaderboard (ranked by score)
     */
    public function leaderboard(Competition $competition)
    {
        $results = CompetitionParticipant::where('competition_id', $competition->id)
            ->with(['user:id,firstname,lastname,image,username'])
            ->orderByDesc('score')
            ->get();

        return response()->json(['status' => 'success', 'data' => $results]);
    }

    /**
     * Participants list
     */
    public function participants(Competition $competition)
    {
        $participants = $competition->participants()->with('user:id,firstname,lastname,image,username')->get();

        return response()->json(['status' => 'success', 'data' => $participants]);
    }
}
