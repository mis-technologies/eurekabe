<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Models\Competition;
use Modules\Common\Models\CompetitionParticipant;
use Modules\Common\Notifications\Notification as EurekaNotification;
use Modules\Student\Models\StudentExam;
use Modules\Student\Models\StudentLeaderBoard;

class StudentCompetitionController extends Controller
{
    /**
     * List competitions (search + type filter)
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Competition::with(['schools', 'exams'])
            ->visibleTo($user);

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

        return response()->json([
            'status' => 'success',
            'data' => $competitions->map(fn ($c) => array_merge(
                $c->toArray(),
                [
                    'window_status' => $c->window_status,
                    'is_within_window' => $c->isWithinWindow(),
                    'price_display' => $c->price > 0 ? number_format($c->price, 2) : 'Free',
                ]
            )),
        ]);
    }

    /**
     * Show competition details
     */
    public function show(Competition $competition)
    {
        $user = Auth::user();
        $competition->load(['schools', 'exams', 'participants.user']);

        $myParticipant = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', $user->id)
            ->first();

        return response()->json([
            'status' => 'success',
            'data' => array_merge(
                $competition->toArray(),
                [
                    'window_status' => $competition->window_status,
                    'is_within_window' => $competition->isWithinWindow(),
                    'price_display' => $competition->price > 0 ? number_format($competition->price, 2) : 'Free',
                ]
            ),
            'my_status' => $myParticipant?->status,
            'is_paid' => $myParticipant?->isPaid ?? false,
            'can_join' => $myParticipant === null,
        ]);
    }

    /**
     * Join competition (free) or initiate payment (paid)
     */
    public function join(Request $request, Competition $competition)
    {
        $user = Auth::user();
        $existing = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existing) {
            return response()->json(['status' => 'error', 'message' => 'You have already joined this competition.'], 409);
        }

        if ($competition->status === 'completed') {
            return response()->json(['status' => 'error', 'message' => 'This competition has ended.'], 400);
        }

        // Free competition — join directly
        if ($competition->price <= 0) {
            $participant = CompetitionParticipant::create([
                'user_id'        => $user->id,
                'competition_id' => $competition->id,
                'status'         => 'pending',
                'isPaid'         => true,
                'paid_at'        => now(),
                'payment_method' => 'free',
            ]);

            $user->notify(new EurekaNotification(null, [
                'title'     => 'Competition Joined',
                'text'      => "You've joined \"{$competition->name}\". Good luck!",
                'entity'    => get_class($competition),
                'entity_id' => $competition->id,
                'meta'      => ['competition_id' => $competition->id],
            ], ['database', 'push']));

            return response()->json(['status' => 'success', 'message' => 'Joined successfully.', 'data' => $participant]);
        }

        // Paid competition — redirect to payment
        return $this->initiatePayment($request, $competition);
    }

    /**
     * Initiate payment for a paid competition
     */
    public function initiatePayment(Request $request, Competition $competition)
    {
        $user = Auth::user();

        $existing = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existing) {
            return response()->json(['status' => 'error', 'message' => 'You have already joined this competition.'], 409);
        }

        try {
            $paystackService = app(\Modules\Common\Services\PaystackService::class);

            $result = $paystackService->initializeCompetitionTransaction(
                $user,
                $competition,
                $competition->price,
                $user->email
            );

            return response()->json([
                'status' => 'success',
                'data' => [
                    'authorization_url' => $result['authorization_url'],
                    'reference' => $result['reference'],
                    'competition_id' => $competition->id,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    /**
     * Confirm payment and create participant (webhook or callback)
     */
    public function confirmPayment(Request $request)
    {
        $reference = $request->input('reference');

        if (!$reference) {
            return response()->json(['status' => 'error', 'message' => 'Reference required.'], 400);
        }

        try {
            $paystackService = app(\Modules\Common\Services\PaystackService::class);
            $verification = $paystackService->verify($reference);

            if ($verification['status'] !== 'success') {
                return response()->json(['status' => 'error', 'message' => 'Payment was not successful.'], 400);
            }

            $metadata = $verification['metadata'] ?? [];
            $competitionId = $metadata['competition_id'] ?? null;
            $userId = $metadata['user_id'] ?? null;

            if (!$competitionId || !$userId) {
                return response()->json(['status' => 'error', 'message' => 'Invalid payment metadata.'], 400);
            }

            $competition = Competition::find($competitionId);
            $user = User::find($userId);

            if (!$competition || !$user) {
                return response()->json(['status' => 'error', 'message' => 'Competition or user not found.'], 404);
            }

            $participant = CompetitionParticipant::firstOrCreate(
                ['user_id' => $userId, 'competition_id' => $competitionId],
                [
                    'status' => 'pending',
                    'isPaid' => true,
                    'paid_at' => now(),
                    'payment_method' => 'paystack',
                    'paystack_reference' => $reference,
                ]
            );

            if (!$participant->wasRecentlyCreated) {
                $participant->update([
                    'isPaid' => true,
                    'paid_at' => now(),
                    'payment_method' => 'paystack',
                    'paystack_reference' => $reference,
                ]);
            }

            $user->notify(new EurekaNotification(null, [
                'title'     => 'Payment Confirmed',
                'text'      => "Your payment for \"{$competition->name}\" has been confirmed. Ready to compete!",
                'entity'    => get_class($competition),
                'entity_id' => $competition->id,
                'meta'      => ['competition_id' => $competition->id],
            ], ['database', 'push']));

            return response()->json([
                'status' => 'success',
                'message' => 'Payment confirmed and joined competition.',
                'data' => $participant,
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
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
        $user = Auth::user();

        // Enforce timing window
        if (!$competition->isWithinWindow()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Competition window is not open. ' . ucfirst($competition->window_status) . '.',
                'window_status' => $competition->window_status,
            ], 403);
        }

        $participant = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$participant || $participant->status === 'rejected') {
            return response()->json(['status' => 'error', 'message' => 'You are not an approved participant.'], 403);
        }

        if (!$participant->isPaid) {
            return response()->json(['status' => 'error', 'message' => 'Payment required to start this competition.'], 403);
        }

        $competitionExam = $competition->exams()->find($examId);
        if (!$competitionExam) {
            return response()->json(['status' => 'error', 'message' => 'Exam not found in this competition.'], 404);
        }

        // Prevent re-start after submission
        $existing = StudentExam::where('exam_id', $competitionExam->id)
            ->where('user_id', $user->id)
            ->where('competition_id', $competition->id)
            ->first();

        if ($existing && $existing->status === StudentExam::SUBMITTED) {
            return response()->json(['status' => 'error', 'message' => 'You have already submitted this exam.'], 409);
        }

        $totalQ = $competitionExam->pivot->total_questions ?? 20;
        $questions = $competitionExam->questions()->inRandomOrder()->limit($totalQ)->get();

        $studentExam = StudentExam::create([
            'exam_id'        => $competitionExam->id,
            'user_id'        => $user->id,
            'competition_id' => $competition->id,
            'status'         => StudentExam::STARTED,
            'started_at'     => now(),
            'questions'      => $questions->pluck('id'),
        ]);

        $participant->update(['started_at' => now()]);
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

        // Enforce timing window — no submissions after window closes
        if (!$competition->isWithinWindow()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Competition window has closed. Submissions are no longer accepted.',
                'window_status' => $competition->window_status,
            ], 403);
        }

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

                // Notify all participants that the competition is complete
                $winnerUser   = User::find($winner->user_id);
                $winnerName   = $winnerUser ? ($winnerUser->firstname ?? 'A participant') : 'A participant';
                $allParticipants = User::whereIn('id',
                    CompetitionParticipant::where('competition_id', $competition->id)->pluck('user_id')
                )->get();

                foreach ($allParticipants as $participant) {
                    $isWinner = $participant->id === $winner->user_id;
                    $text = $isWinner
                        ? "Congratulations! You won \"{$competition->title}\"!"
                        : "{$winnerName} has won \"{$competition->title}\". Check the results!";

                    $participant->notify(new EurekaNotification(null, [
                        'title'     => 'Competition Complete!',
                        'text'      => $text,
                        'entity'    => get_class($competition),
                        'entity_id' => $competition->id,
                        'meta'      => ['competition_id' => $competition->id, 'winner_id' => $winner->user_id],
                    ], ['database', 'push']));
                }
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
