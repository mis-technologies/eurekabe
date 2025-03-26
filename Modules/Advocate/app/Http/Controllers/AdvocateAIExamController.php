<?php
namespace Modules\Advocate\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Common\Actions\OpenRouter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Exam\Models\Subject;

class AdvocateAIExamController extends Controller
{
    
    public function aiCreate()
    {
        $advocate = Auth::user();

        // dd($advocate);
        $subjects = Subject::all();
        $school_id = $advocate->school_id ?? 1;
        return view('advocate::exams.ai_create', compact('subjects', 'school_id'));
    }

}
