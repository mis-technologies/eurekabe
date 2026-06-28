<?php

namespace Modules\Common\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Student\Models\StudentExam;
use Modules\Student\Models\StudentLeaderBoard;

class ExploreStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Initialize query builder for School
        $query = User::query();

        $query->where('role', 'student');
       
        // Searching (e.g., search by name or description)
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%");
            });
        }

        // Sorting
        if ($request->has('sort_by') && in_array($request->get('sort_by'), ['name', 'created_at'])) {
            $sortOrder = $request->get('sort_order', 'asc'); // default to ascending order
            $query->orderBy($request->get('sort_by'), $sortOrder);
        }

        // Restrict students to only those from schools the user is affiliated with or following
        $user = auth('sanctum')->user();
        if ($user) {
            $allowedSchoolIds = $user->schools()->pluck('schools.id')->toArray();
            if ($user->school_id) {
                $allowedSchoolIds[] = $user->school_id;
            }
            if (!empty($allowedSchoolIds)) {
                $query->whereIn('school_id', $allowedSchoolIds);
            } else {
                $query->whereRaw('1 = 0'); // No affiliated schools, return empty
            }
        } else {
            $query->whereRaw('1 = 0'); // Guests cannot see students
        }

        // Filter by specific requested schools
        if ($request->has('school')) {
            $schoolParam = $request->get('school');
            $schoolList = is_array($schoolParam) ? $schoolParam : explode(',', $schoolParam);
            $schoolIds = \Modules\Common\Models\School::whereIn('acronym', $schoolList)->orWhereIn('id', $schoolList)->pluck('id')->toArray();
            if (!empty($schoolIds)) {
                $query->whereIn('school_id', $schoolIds);
            }
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $students = $query->with('school')->paginate($perPage);

        // Return API response
        return response()->json([
            'success' => true,
            'data' => $students,
        ], 200);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $student = User::where('id', $id)->where('role', 'student')->with('school')->first();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.',
            ], 404);
        }

        // ── Exam stats ────────────────────────────────────────────────────────
        $completedExams = StudentExam::where('user_id', $id)
            ->whereIn('status', ['submitted', 'result_released'])
            ->get();

        $examsTaken  = $completedExams->count();
        $passedCount = $completedExams->filter(fn($e) =>
            $e->total_possible_marks > 0 && $e->pass_percentage > 0
                ? ($e->total_marks_earned / $e->total_possible_marks * 100) >= $e->pass_percentage
                : (bool) $e->passed
        )->count();
        $passRate    = $examsTaken > 0 ? round(($passedCount / $examsTaken) * 100) : 0;
        $avgScore    = $examsTaken > 0
            ? round($completedExams->avg(fn($e) => $e->total_possible_marks > 0
                ? ($e->total_marks_earned / $e->total_possible_marks) * 100
                : 0), 1)
            : 0;

        // ── Leaderboard points ────────────────────────────────────────────────
        $totalPoints = (int) StudentLeaderBoard::where('user_id', $id)->sum('points');

        // ── Recent exams (last 6) ─────────────────────────────────────────────
        $recentExams = StudentExam::where('user_id', $id)
            ->whereIn('status', ['submitted', 'result_released'])
            ->with('exam.subject')
            ->orderBy('ended_at', 'desc')
            ->limit(6)
            ->get()
            ->map(fn($se) => [
                'student_exam_id'    => $se->id,
                'exam_title'         => $se->exam?->title,
                'subject'            => $se->exam?->subject?->name,
                'total_correct'      => (int) $se->total_correct,
                'total_questions'    => (int) $se->total_questions,
                'total_marks_earned' => (float) $se->total_marks_earned,
                'total_possible_marks' => (float) $se->total_possible_marks,
                'passed'             => $se->total_possible_marks > 0 && $se->pass_percentage > 0
                    ? ($se->total_marks_earned / $se->total_possible_marks * 100) >= $se->pass_percentage
                    : (bool) $se->passed,
                'ended_at'           => $se->ended_at?->toISOString(),
            ]);

        return response()->json([
            'success' => true,
            'data' => [
                'id'        => $student->id,
                'name'      => $student->name,
                'firstname' => $student->firstname,
                'lastname'  => $student->lastname,
                'username'  => $student->username,
                'image'     => $student->image,
                'about'     => $student->about,
                'interest'  => $student->interest ?? [],
                'level'     => $student->level,
                'gender'    => $student->gender,
                'school'    => $student->school ? [
                    'id'      => $student->school->id,
                    'name'    => $student->school->name,
                    'acronym' => $student->school->acronym,
                ] : null,
                'stats' => [
                    'exams_taken'  => $examsTaken,
                    'passed'       => $passedCount,
                    'pass_rate'    => $passRate,
                    'total_points' => $totalPoints,
                    'avg_score'    => $avgScore,
                ],
                'recent_exams' => $recentExams,
            ],
        ]);
    }
}
