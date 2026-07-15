<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Models\Exam;
use Modules\Common\Models\Question;
use Modules\Common\Models\QuestionOption;
use Modules\Common\Models\School;
use Modules\Common\Models\Subject;

class AdminExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with(['school', 'subject'])->latest()->paginate(20);
        return view('admin::exams.index', compact('exams'));
    }

    public function create()
    {
        $schools = School::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        return view('admin::exams.create', compact('schools', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'school_id'      => 'required|exists:schools,id',
            'subject_id'     => 'required|exists:subjects,id',
            'duration'       => 'required|integer|min:1',
            'instruction'    => 'nullable|string',
            'pass_percentage' => 'required|numeric|min:0|max:100',
            'start_date'     => 'nullable|date',
            'end_date'       => 'nullable|date|after_or_equal:start_date',
            'status'         => 'required|in:draft,published,archived',
            'visibility'     => 'required|in:public,school,private',
            'allow_ai_hints' => 'sometimes|boolean',
        ]);

        $validated['allow_ai_hints'] = $request->boolean('allow_ai_hints');

        $exam = Exam::create($validated);

        session()->flash('success', 'Exam created successfully.');
        return redirect()->route('admin.exams.show', $exam->id);
    }

    public function show($id)
    {
        $exam = Exam::with(['questions.options'])->findOrFail($id);
        return view('admin::exams.show', compact('exam'));
    }

    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        $schools = School::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        return view('admin::exams.edit', compact('exam', 'schools', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'school_id'      => 'required|exists:schools,id',
            'subject_id'     => 'required|exists:subjects,id',
            'duration'       => 'required|integer|min:1',
            'instruction'    => 'nullable|string',
            'pass_percentage' => 'required|numeric|min:0|max:100',
            'start_date'     => 'nullable|date',
            'end_date'       => 'nullable|date|after_or_equal:start_date',
            'status'         => 'required|in:draft,published,archived',
            'visibility'     => 'required|in:public,school,private',
            'allow_ai_hints' => 'sometimes|boolean',
        ]);

        $validated['allow_ai_hints'] = $request->boolean('allow_ai_hints');

        $exam->update($validated);

        session()->flash('success', 'Exam updated successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            $exam = Exam::findOrFail($id);

            // Delete questions and their options
            foreach ($exam->questions as $question) {
                $question->options()->delete();
            }
            $exam->questions()->delete();
            $exam->delete();

            session()->flash('success', 'Exam deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to delete exam: ' . $e->getMessage());
        }

        return redirect()->route('admin.exams.index');
    }

    public function questions($examId)
    {
        $exam = Exam::findOrFail($examId);
        $questions = Question::with('options')->where('exam_id', $examId)->get();
        return view('admin::exams.questions', compact('exam', 'questions'));
    }

    public function storeQuestion(Request $request, $examId)
    {
        $exam = Exam::findOrFail($examId);

        $validated = $request->validate([
            'question'         => 'required|string',
            'marks'            => 'required|numeric|min:0',
            'options'          => 'required|array|min:2',
            'options.*.option' => 'required|string',
            'options.*.is_correct' => 'sometimes|boolean',
        ]);

        $question = Question::create([
            'exam_id'          => $examId,
            'question'         => $validated['question'],
            'marks'            => $validated['marks'],
            'question_type_id' => 1, // MCQ default
            'status'           => 1,
        ]);

        foreach ($validated['options'] as $optionData) {
            QuestionOption::create([
                'question_id' => $question->id,
                'option'      => $optionData['option'],
                'is_correct'  => isset($optionData['is_correct']) ? (bool) $optionData['is_correct'] : false,
            ]);
        }

        session()->flash('success', 'Question added successfully.');
        return redirect()->back();
    }

    public function destroyQuestion($examId, $questionId)
    {
        try {
            $question = Question::where('exam_id', $examId)->findOrFail($questionId);
            $question->options()->delete();
            $question->delete();

            session()->flash('success', 'Question deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to delete question: ' . $e->getMessage());
        }

        return redirect()->back();
    }
}
