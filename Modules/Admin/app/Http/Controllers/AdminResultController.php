<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Models\Exam;
use Modules\Student\Models\StudentExam;
use Modules\Student\Models\StudentExamResult;

class AdminResultController extends Controller
{
    public function index(Request $request)
    {
        $query = StudentExam::with(['user', 'exam'])->latest();

        if ($request->filled('exam_id')) {
            $query->where('exam_id', $request->exam_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $results = $query->paginate(20)->withQueryString();
        $exams = Exam::orderBy('title')->get();

        return view('admin::results.index', compact('results', 'exams'));
    }

    public function show($id)
    {
        $studentExam = StudentExam::with([
            'user',
            'exam',
        ])->findOrFail($id);

        $examResults = StudentExamResult::with('question')
            ->where('student_exam_id', $id)
            ->get();

        return view('admin::results.show', compact('studentExam', 'examResults'));
    }
}
