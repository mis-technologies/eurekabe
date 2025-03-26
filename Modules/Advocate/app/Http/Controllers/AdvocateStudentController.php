<?php

namespace Modules\Advocate\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Student\Models\StudentChallenge;
use Modules\Student\Models\StudentExam;

class AdvocateStudentController extends Controller
{

    public function getStudents()
    {
        $advocate = Auth::user();
        $data['students'] = User::where('role', 'student')->where('school_id', $advocate->school_id)->with(['school', 'schools'])->latest()->paginate(50);
        return view('advocate::students.index', $data);
    }

    // showStudent
    public function showStudent(User $student)
    {
        $advocate = Auth::user();
        $data['student'] = $student;

        // student stats such as total exams taken, total challenges, total hours spent, total feedbacks
        $total_hours = StudentExam::where('user_id', $student->id)
            ->whereNotNull('started_at')
            ->whereNotNull('ended_at')
            ->selectRaw('SUM(TIMESTAMPDIFF(SECOND, started_at, ended_at)) / 3600 as total_hours')
            ->value('total_hours') ?? 0;

        $data['stats'] = [
            'total_exams' => StudentExam::where('user_id', $student->id)->count(),
            'total_challenges' => StudentChallenge::where('user_id', $student->id)->count(),
            'total_hours' => $total_hours,
            'total_feedbacks' => 0,
        ];

        return view('advocate::students.show', $data);
    }

}
