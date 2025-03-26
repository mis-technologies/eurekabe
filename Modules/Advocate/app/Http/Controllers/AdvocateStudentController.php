<?php

namespace Modules\Advocate\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Exam\Models\Exam;
use Modules\Student\Models\StudentExam;

class AdvocateStudentController extends Controller
{

    public function getStudents()
    {
        $advocate = Auth::user();
        $data['students'] = User::where('role', 'student')->where('school_id', $advocate->school_id)->with(['school', 'schools'])->latest()->get();
        return view('advocate::students.index', $data);
    }

    public function allStudentResults()
    {
        $advocate = Auth::user();
        $examIds = Exam::where('school_id', $advocate->school_id)->pluck('id');
        $data['results'] = StudentExam::whereIn('exam_id', $examIds)->latest()->get();
        return view('advocate::results.index', $data);
    }

}
