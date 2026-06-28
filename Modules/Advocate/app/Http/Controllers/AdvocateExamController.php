<?php

namespace Modules\Advocate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Models\Exam;
use Modules\Common\Models\Question;
use Modules\Common\Models\QuestionOption;
use Modules\Common\Models\Subject;
use Modules\Common\Facades\FileFacade;
use Modules\Common\Models\File;
use Modules\Student\Models\StudentExam;
use Modules\Student\Models\StudentExamResult;

class AdvocateExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advocate = Auth::user();
        $exams = Exam::with('subject')->where('school_id', $advocate->school_id)->paginate(20);
        return view('advocate::exams.index', compact('exams'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('advocate::exams.create', compact('subjects'));
    }

    public function aiCreate()
    {
        $advocate = Auth::user();

        // dd($advocate);
        $subjects = Subject::all();
        $school_id = $advocate->school_id ?? 1;
        return view('advocate::exams.ai_create', compact('subjects', 'school_id'));
    }
    

    public function storeExam(Request $request)
    {

        $advocate = Auth::user();
        $exam = new Exam();
        $exam->title = $request->title;
        $exam->subject_id = $request->subject_id;
        $exam->instruction = $request->instruction;
        $exam->duration = $request->duration;
        $exam->totalmark = 0; // we may not need this field, it can be calculated from exam question marks
        $exam->value = 0;
        $exam->status = 1;
        $exam->pass_percentage = $request->pass_percentage;
        $exam->school_id = $advocate->school_id ?? 1;
        $exam->question_type = $request->question_type;
        $exam->save();

        if ($request->hasFile('image')) {
            $files = request()->files;
            foreach ($files as $key => $value) {
                FileFacade::cloudinaryDelete(File::where('identifier', $key)->where('entity_id', $exam->id)->get());
                FileFacade::cloudinaryUpload($value, $exam, identifier: $key);
            }
        }

        $notify[] = ['success', 'Exam created successfully'];
        return redirect()->route('advocate.exams.show', $exam->id)->withNotify($notify);

    }

    public function show(Request $request, $exam)
    {
        $exam = Exam::with('subject')->find($exam);
        $exam->attempt_count = StudentExamResult::where('exam_id', $exam->id)->count();

        $exam->total_hours = StudentExam::where('exam_id', $exam->id)
            ->whereNotNull('started_at')
            ->whereNotNull('ended_at')
            ->selectRaw('ROUND(SUM(TIMESTAMPDIFF(SECOND, started_at, ended_at)/3600), 2) as total_hours')
            ->value('total_hours') ?? 0;

        $questions = Question::where('exam_id', $exam->id)->paginate(10);
        $subjects = Subject::all();
        return view('advocate::exams.show', compact('exam', 'questions', 'subjects'));
    }

    public function update(Request $request, $exam)
    {
        $exam = Exam::find($exam);

        if ($request->hasFile('image')) {
            $files = request()->files;
            foreach ($files as $key => $value) {
                // FileFacade::publicFileUpload($value, $exam, identifier:$key);
                FileFacade::cloudinaryDelete(File::where('identifier', $key)->where('entity_id', $exam->id)->get());
                FileFacade::cloudinaryUpload($value, $exam, identifier: $key);
            }
        }

        $exam->title = $request->title;
        $exam->subject_id = $request->subject_id;
        $exam->instruction = $request->instruction;
        $exam->duration = $request->duration;
        $exam->pass_percentage = $request->pass_percentage;
        $exam->status = $request->status ?? 1;
        $exam->allow_ai_hints = $request->has('allow_ai_hints') ? (bool) $request->allow_ai_hints : true;
        $exam->save();

        $notify[] = ['success', 'Updated succesfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function getCreateQuestion(Request $request, Exam $exam)
    {
        return view('advocate::exams.create_question', compact('exam'));
    }

    public function getQuestion(Request $request, Exam $exam, Question $question)
    {

        return view('advocate::exams.question', compact('exam', 'question'));
    }

    public function updateQuestion(Request $request, Exam $exam, Question $question)
    {

        // dd($request->all());
        $question->question = $request->question;
        $question->marks = $request->marks;
        $options = json_decode($request->options);

        foreach ($options as $option) {
            QuestionOption::updateOrCreate([
                'question_id' => $question->id,
                'option' => $option->option,
            ], [
                'exam_id' => $exam->id,
                'question_id' => $question->id,
                'is_correct' => $option->is_correct,
            ]);
        }
        unset($request['option']);
        $question->save();

        if ($request->acceptsJson()) {
            return response()->json(['success' => true]);
        } else {
            $notify[] = ['success', 'Updated successfully'];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function storeQuestion(Request $request, Exam $exam)
    {
        $question = new Question();
        $question->exam_id = $exam->id;
        $question->question = $request->question;
        $question->marks = $request->marks;
        $question->save();

        $options = json_decode($request->options);

        foreach ($options as $option) {
            QuestionOption::create([
                'exam_id' => $exam->id,
                'question_id' => $question->id,
                'option' => $option->option,
                'is_correct' => $option->is_correct,
            ]);
        }
        unset($request['option']);

        if ($request->acceptsJson()) {
            return response()->json([
                'success' => true,
                'redirect' => route('advocate.exams.show', $exam->id),
            ]);
        } else {
            $notify[] = ['success', 'Created successfully'];
            return redirect()->back()->withNotify($notify);
        }
    }


    public function allExamResults()
    {
        $advocate = Auth::user();
        $examIds = Exam::where('school_id', $advocate->school_id)->pluck('id');
        $data['results'] = StudentExam::whereIn('exam_id', $examIds)->latest()->get();
        return view('advocate::results.index', $data);
    }

    // getExamResults
    public function getExamResults(Exam $exam)
    {
        $data['exam'] = $exam;
        return view('advocate::exams.results', $data);
    }
}
