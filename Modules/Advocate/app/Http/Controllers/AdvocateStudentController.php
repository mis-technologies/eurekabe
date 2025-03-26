<?php

namespace Modules\Advocate\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Models\School;
use Modules\Exam\Models\Exam;
use Modules\Student\Models\StudentChallenge;

class AdvocateStudentController extends Controller
{


public function getStudents()
   {
        $advocate = Auth::user();
        $data['students'] = User::where('role', 'student')->where('school_id', $advocate->school_id)->with(['school', 'schools'])->latest()->get();
        return view('advocate::students.index', $data);
   }

}
