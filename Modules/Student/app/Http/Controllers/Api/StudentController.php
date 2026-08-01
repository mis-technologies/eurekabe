<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Common\Models\School;
use Modules\Common\Facades\FileFacade;
use Modules\Common\Models\File;
use Modules\Student\Models\Student;
use Modules\Student\Models\StudentExam;
use Modules\Student\Models\StudentLeaderBoard;

class StudentController extends Controller
{

    public function createAccount(Request $request)
    {
        try {

            $user = User::find(Auth::user()->id);
            $payload = $request->validate([
                'school_id' => 'required'
            ]);

            $payload['role'] = 'student';
            $user->update($payload);

            return response()->json([
                'success' => true,
                'message' => 'Account created successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getAccount(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id)->load('school');

            // ── Completed exams ───────────────────────────────────────────────
            $completedExams = StudentExam::where('user_id', $user->id)
                ->whereIn('status', ['submitted', 'result_released'])
                ->get();

            $examsTaken       = $completedExams->count();
            $totalQAnswered   = (int) $completedExams->sum('total_questions');
            $passedCount      = $completedExams->filter(fn($e) => (bool) $e->passed)->count();
            $passRate         = $examsTaken > 0 ? round(($passedCount / $examsTaken) * 100) : 0;
            $avgScore         = $examsTaken > 0
                ? round($completedExams->avg(fn($e) => $e->total_possible_marks > 0
                    ? ($e->total_marks_earned / $e->total_possible_marks) * 100
                    : 0), 1)
                : 0;

            // ── Eco points ────────────────────────────────────────────────────
            $ecoPoints = (int) StudentLeaderBoard::where('user_id', $user->id)->sum('points');

            // ── School rank (by total points among same-school students) ──────
            $schoolRank = null;
            if ($user->school_id) {
                $schoolStudentIds = User::where('school_id', $user->school_id)
                    ->where('role', 'student')
                    ->pluck('id');
                $schoolRank = StudentLeaderBoard::whereIn('user_id', $schoolStudentIds)
                    ->selectRaw('user_id, SUM(points) as total')
                    ->groupBy('user_id')
                    ->having('total', '>', $ecoPoints)
                    ->count() + 1;
            }

            // ── Streak (consecutive exam days, most recent first) ─────────────
            $examDays = StudentExam::where('user_id', $user->id)
                ->whereIn('status', ['submitted', 'result_released'])
                ->whereNotNull('ended_at')
                ->orderBy('ended_at', 'desc')
                ->pluck('ended_at')
                ->map(fn($d) => $d->format('Y-m-d'))
                ->unique()
                ->values();

            $streak = 0;
            if ($examDays->isNotEmpty()) {
                $today     = now()->format('Y-m-d');
                $yesterday = now()->subDay()->format('Y-m-d');
                $first     = $examDays->first();

                if ($first === $today || $first === $yesterday) {
                    $streak  = 1;
                    $cursor  = $first === $today ? now() : now()->subDay();
                    foreach ($examDays->slice(1) as $day) {
                        $cursor = $cursor->subDay();
                        if ($day === $cursor->format('Y-m-d')) {
                            $streak++;
                        } else {
                            break;
                        }
                    }
                }
            }

            // ── Achievements ──────────────────────────────────────────────────
            $achievements = [];

            if ($examsTaken >= 1)
                $achievements[] = ['key' => 'first_exam',  'title' => 'First step',    'desc' => 'Took your first exam',         'icon' => 'star'];
            if ($totalQAnswered >= 100)
                $achievements[] = ['key' => 'century',     'title' => '100 club',       'desc' => '100+ questions answered',      'icon' => 'flash'];
            if ($totalQAnswered >= 1000)
                $achievements[] = ['key' => 'thousand',    'title' => '1k club',        'desc' => '1000+ questions answered',     'icon' => 'trophy'];
            if ($streak >= 3)
                $achievements[] = ['key' => 'streak_3',    'title' => 'On a roll',      'desc' => '3-day streak',                 'icon' => 'flame'];
            if ($streak >= 10)
                $achievements[] = ['key' => 'streak_king', 'title' => 'Streak king',    'desc' => "{$streak}-day streak",         'icon' => 'flame'];
            if ($schoolRank === 1)
                $achievements[] = ['key' => 'top_class',   'title' => 'Top of class',   'desc' => 'School rank #1',               'icon' => 'ribbon'];
            if ($avgScore >= 90 && $examsTaken >= 3)
                $achievements[] = ['key' => 'ace',         'title' => 'Ace',            'desc' => '90%+ average score',           'icon' => 'medal'];
            if ($passRate >= 80 && $examsTaken >= 5)
                $achievements[] = ['key' => 'consistent',  'title' => 'Consistent',     'desc' => '80%+ pass rate',               'icon' => 'checkmark-circle'];
            if ($examsTaken >= 25)
                $achievements[] = ['key' => 'veteran',     'title' => 'Veteran',        'desc' => '25 exams completed',           'icon' => 'shield-checkmark'];

            return response()->json([
                'success' => true,
                'message' => 'LoggedIn User retrieved successfully',
                'data' => [
                    'id'        => $user->id,
                    'name'      => $user->name,
                    'firstname' => $user->firstname,
                    'lastname'  => $user->lastname,
                    'username'  => $user->username,
                    'email'     => $user->email,
                    'image'     => $user->image,
                    'about'     => $user->about,
                    'interest'  => $user->interest ?? [],
                    'level'     => $user->level,
                    'gender'    => $user->gender,
                    'school'    => $user->school ? [
                        'id'      => $user->school->id,
                        'name'    => $user->school->name,
                        'acronym' => $user->school->acronym,
                    ] : null,
                    'stats' => [
                        'exams_taken'      => $examsTaken,
                        'questions_answered' => $totalQAnswered,
                        'passed'           => $passedCount,
                        'pass_rate'        => $passRate,
                        'avg_score'        => $avgScore,
                        'eco_points'       => $ecoPoints,
                        'school_rank'      => $schoolRank,
                        'streak'           => $streak,
                    ],
                    'achievements' => $achievements,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function updateAccount(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            if ($request->has('interest')) {
                $user->interest = $request->interest;
            }

            if ($request->has('about')) {
                $user->about = $request->about;
            }

            if ($request->has('school_id')) {
                if(!$school = School::find($request->school_id)){
                    return response()->json(['success' => false, 'message' => 'Invalid school'], 400);
                }
                $user->school_id = $request->school_id;
            }


            if ($request->has('username')) {
                $validation = Validator::make($request->all(), [
                    'username' => 'unique:users,username'
                ]);
                if ($validation->fails()) {
                    return response()->json(['success' => false, 'message' => 'Username not available'], 400);
                }
                $user->username = $request->username;
            }

            $user->save();
            return response()->json([
                'success' => true,
                'message' => 'Account updated and retrieved successfully',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function updateProfilePicture (Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            if( request()->files->count() ){
                $files = request()->files;
                foreach ($files as $key => $value) {
                    FileFacade::cloudinaryDelete(File::where('identifier', $key)->where('entity_id', $user->id)->get() ); 
                    FileFacade::cloudinaryUpload($value, $user, identifier:$key);
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Profile picture updated successfully',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteAccount(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            
            $request->validate([
                'password' => 'required|string'
            ]);

            if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Incorrect password'
                ], 422);
            }

            // Denormalize/anonymize email and phone, but keep data
            $user->email = 'deleted_' . \Illuminate\Support\Str::uuid() . '@eurekaedu.app';
            if ($user->phone) {
                $user->phone = 'deleted_' . time();
            }
            $user->save();

            // Soft-delete the user
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Account deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
