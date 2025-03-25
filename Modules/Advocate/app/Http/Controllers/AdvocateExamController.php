<?php

namespace Modules\Advocate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Exam\Models\Exam;
use Modules\Exam\Models\Question;
use Modules\Exam\Models\QuestionOption;
use Modules\Exam\Models\Subject;
use Modules\File\Facades\FileFacade;
use Modules\File\Models\File;
use Modules\Student\Models\StudentExam;
use Modules\Student\Models\StudentExamResult;

class AdvocateExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $exams = Exam::with('subject')->paginate(20);
        return view('advocate::exams.index', compact('exams'));
    }

    public function create(){
        $subjects = Subject::all();
        return view('advocate::exams.create', compact('subjects'));
    }

    public function storeExam(Request $request){

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
        $exam->school_id = $advocate->school_id;
        // $exam->user_id = $advocate->id;
        $exam->save();


        if( $request->hasFile('image') ){
            $files = request()->files;
            foreach ($files as $key => $value) {
                // dd($key);
                FileFacade::cloudinaryUpload(File::where('identifier', $key)->where('entity_id', $exam->id)->get() ); //delete previous
                FileFacade::cloudinaryDelete($key);
            }
        }

        $notify[]=['success', 'Exam created successfully'];
        return redirect()->route('advocate.exams.show', $exam->id)->withNotify($notify);
    
    }


    public function show(Request $request, $exam){
        $exam = Exam::with('subject')->find($exam);
        $exam->attempt_count = StudentExamResult::where('exam_id', $exam->id)->count();
       
        $exam->total_hours = StudentExam::where('exam_id', $exam->id)
        ->whereNotNull('started_at')
        ->whereNotNull('ended_at')
        ->selectRaw('ROUND(SUM(TIMESTAMPDIFF(SECOND, started_at, ended_at)/3600), 2) as total_hours')
        ->value('total_hours') ?? 0;

        $questions = Question::where('exam_id', $exam->id)->paginate(10);
    
        return view('advocate::exams.show', compact('exam', 'questions'));
    }

    public function update(Request $request, $exam){
        $exam = Exam::find($exam);

        if( $request->hasFile('image') ){
            $files = request()->files;
            foreach ($files as $key => $value) {
                // dd($key);
                // FileFacade::publicFileUpload($value, $exam, identifier:$key);
                FileFacade::cloudinaryUpload($value, $exam, identifier:$key);
                FileFacade::cloudinaryDelete($key);
            }
        }

        $exam->title = $request->title;
        // $exam->subject_id = $request->subject_id;
        $exam->instruction = $request->instruction;
        $exam->duration = $request->duration;
        $exam->pass_percentage = $request->pass_percentage;

        $exam->save();

        $notify[]=['success', 'Updated succesfully'];
        return redirect()->back()->withNotify($notify);
    }
    
    public function getCreateQuestion(Request $request, Exam $exam){
        return view('advocate::exams.create_question', compact('exam'));
    }

    public function getQuestion(Request $request, Exam $exam, Question $question){
        
        return view('advocate::exams.question', compact('exam', 'question'));
    }

    public function updateQuestion(Request $request, Exam $exam, Question $question){
        
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
                'is_correct' => $option->is_correct
            ]);
        }
        unset($request['option']);
        $question->save();

        if($request->acceptsJson()){
            return response()->json(['success' => true]);
        }else{
            $notify[]=['success', 'Updated successfully'];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function storeQuestion(Request $request, Exam $exam){
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
                'is_correct' => $option->is_correct
            ]);
        }
        unset($request['option']);

        if($request->acceptsJson()){
            return response()->json(['success' => true]);
        }else{
            $notify[]=['success', 'Created successfully'];
            return redirect()->back()->withNotify($notify);
        }
    }
}
