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
     * List all competitions, allow search and filter
     */
    public function index(Request $request)
    {
        $query = Competition::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $competitions = $query->paginate(20);

        return response()->json($competitions);
    }

    /**
     * Show competition details
     */
    public function show($id)
    {
        $competition = Competition::findOrFail($id);

        return response()->json($competition);
    }

    /**
     * Show competition leaderboard
     */
    public function leaderboard($id)
    {
        $competition = Competition::findOrFail($id);
        $leaderboard = $competition->participants()
            ->orderBy('score', 'desc')
            ->get(['user_id', 'score']);

        return response()->json($leaderboard);
    }

    /**
     * Show competition participants
     */
    public function participants($id)
    {
        $competition = Competition::findOrFail($id);
        $participants = $competition->participants()->get();

        return response()->json($participants);
    }

    /**
     * Join Competition
     */
    public function join(Request $request, $id)
    {
        $competition = Competition::findOrFail($id);

        $participant = CompetitionParticipant::create([
            'user_id' => Auth::id(),
            'competition_id' => $competition->id,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Joined competition successfully', 'participant' => $participant]);
    }

    /**
     * Leave Competition
     */
    public function leave($id)
    {
        $competition = Competition::findOrFail($id);

        $participant = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Check if participant has submitted
        if ($participant->status == 'submitted') {
            return response()->json(['message' => 'Cannot leave competition after submission'], 400);
        }

        $participant->delete();

        return response()->json(['message' => 'Left competition successfully']);
    }

    /**
     * Start an Exam in the Competition
     */
    public function startExam(Request $request, $competitionId, $examId)
    {
        $competition = Competition::findOrFail($competitionId);
        $user = Auth::user();

        // Check if the user is a participant in the competition
        $participant = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$participant || $participant->status !== 'approved') {
            return response()->json([
                'success' => false,
                'message' => 'You are not an approved participant of this competition',
            ], 403);
        }

        // Retrieve the associated exam for the competition
        $competitionExam = $competition->exams()->find($examId);
        if (!$competitionExam) {
            return response()->json([
                'success' => false,
                'message' => 'No exam is associated with this competition',
            ], 404);
        }

        // Check if student has already submitted the exam this competition
        $existingStudentExam = StudentExam::where('exam_id', $competitionExam->id)
            ->where('user_id', $user->id)
            ->where('competition_id', $competition->id)
            ->first();

        if ($existingStudentExam && $existingStudentExam->status === StudentExam::SUBMITTED) {
            return response()->json([
                'success' => false,
                'message' => 'You have already submitted this exam',
            ], 403);
        }

        // Fetch questions for the exam
        $questions = $competitionExam->questions()->inRandomOrder()->limit($competitionExam->total_questions)->get();

        // Create a new StudentExam record for the user
        $studentExam = StudentExam::create([
            'exam_id' => $competitionExam->id,
            'user_id' => $user->id,
            'competition_id' => $competition->id,
            'status' => StudentExam::STARTED,
            'started_at' => now(),
            'questions' => $questions->pluck('id'),
        ]);

        // Load questions with options for the response
        $studentExam['questions'] = $questions->load('options');

        return response()->json([
            'success' => true,
            'message' => 'Exam started successfully',
            'data' => $studentExam,
        ]);
    }


    /**
     * Submit competition exam
     */
    public function submitCompetitionExam(Request $request, Competition $competition)
    {
        $payload =   $request->validated();

        $submissions = $payload['submissions'];
        $studentExamId = $payload['student_exam_id'];
        $user = Auth::user();

        // Retrieve the student's exam for this competition
        $studentExam = StudentExam::where('id', $studentExamId, 'competition_id', $competition->id)->first();
        if (!$studentExam || $studentExam->status !== StudentExam::STARTED) {
            return response()->json([
                'success' => false,
                'message' => 'No student active exam found for this competition',
            ], 404);
        }
        $studentExam->submitExam($submissions);

        // Mark the exam as submitted
        $studentExam->ended_at = now();
        $studentExam->status = StudentExam::SUBMITTED;
        $studentExam->save();

        // Calculate the exam result
        $result = $studentExam->result();

        // Calculate points based on the result
        $pointsEarned = $result['total_correct'];
        if ($result['passed'] === 'Yes') {
            $pointsEarned += 10;
        }

        // Update or create leaderboard entry
        $leaderResult = StudentLeaderBoard::updateOrCreate([
            'user_id' => $studentExam->user_id,
            'competition_id' => $studentExam->competition_id,
        ], [
            'points' => $pointsEarned,
            'user_id' => $studentExam->user_id,
            'exam_id' => $studentExam->exam_id,
            'competition_id' => $competition->id,
        ]);

        // Update participant score
        $participant = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', $user->id)
            ->first();

        if ($participant) {
            $participant->score = $result['total_marks_earned'];
            $participant->status = 'submitted';
            $participant->save();

            // Determine the winner if all participants have submitted
            $allSubmitted = CompetitionParticipant::where('competition_id', $competition->id)
                ->where('status', '!=', 'submitted')
                ->count() === 0;

            if ($allSubmitted) {
                $winner = CompetitionParticipant::where('competition_id', $competition->id)
                    ->orderByDesc('score')
                    ->first();

                $competition->winner_id = $winner->user_id;
                $competition->status = 'completed';
                $competition->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Competition exam submitted successfully',
            'data' => [
                'competition' => $leaderResult,
                'result' => $result,
                'points_earned' => $pointsEarned,
                'review' => $studentExam->getExamReview(),
            ],
        ]);
    }

    /**
     * Show competition submission
     */
    public function submission($id)
    {
        $competition = Competition::findOrFail($id);

        $participant = CompetitionParticipant::where('competition_id', $competition->id)
            ->where('user_id', Auth::id())
            ->first();

        return response()->json($participant);
    }


    // get challenge ranking based of student leaderboard with challenge_id
    public function getCompetitionRanking(Request $request, Competition $competition)
    {
        $results = CompetitionParticipant::where('competition_id', $competition->id)
            ->with(['user' => function ($query) {
                $query->select('id', 'firstname', 'lastname', 'image');
            }])
            ->orderByDesc('score')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Competition ranking retrieved',
            'data' => $results,
        ]);
    }
}
