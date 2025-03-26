<?php

namespace Modules\Advocate\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Models\School;
use Modules\Exam\Models\Exam;
use Modules\Student\Models\StudentChallenge;

class AdvocateController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $advocate = Auth::user();
        $quick_infos = [
            'recent_school' => School::latest()->first()?->only(['name', 'cover_image', 'created_at']) ?? [
                "name" => "No Recent School",
                "cover_image" => "https://ui-avatars.com/api/?name=NS&color=184391&background=fff",
                'created_at' => null
            ],
            'recent_student' => User::latest()->where('role', 'student')->first()?->only(['firstname', 'image', 'created_at']) ?? [
                "firstname" => "No Recent Student",
                "image" => "https://ui-avatars.com/api/?name=NS&color=184391&background=fff",
                'created_at' => null
            ],
            'recent_exam' => Exam::latest()->first()?->only(['title', 'cover_image', 'created_at'])  ?? [
                "title" => "No Recent Exam",
                "cover_image" => "https://ui-avatars.com/api/?name=NS&color=184391&background=fff",
                'created_at' => null,
            ],
        ];
        
        $top_exams = Exam::where('school_id', $advocate->school_id)->withCount('examResults')->orderBy('exam_results_count', 'desc')->take(5)->get();
        $top_students = User::where('school_id', $advocate->school_id)->where('role', 'student')->withCount('examResults')->orderBy('exam_results_count', 'desc')->take(5)->get();

        $stats = [
            'total_students' => User::where('school_id', $advocate->school_id)->where('role', 'student')->count(),
            'total_exams' => Exam::where('school_id', $advocate->school_id)->count(),
            'total_challenges' => StudentChallenge::whereIn('exam_id', [$advocate->school_id])->count(),
            'total_questions' => Exam::where('school_id', $advocate->school_id)->withCount('questions')->get()->sum('questions_count'),
        ];

        return view('advocate::dashboard', compact('quick_infos', 'top_exams', 'top_students', 'stats'));
    }

    
    
}
