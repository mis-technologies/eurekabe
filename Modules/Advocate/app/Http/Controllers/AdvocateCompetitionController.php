<?php

namespace Modules\Advocate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Models\School;
use Modules\Exam\Models\Competition;
use Modules\Exam\Models\CompetitionExam;
use Modules\Exam\Models\CompetitionSchool;
use Modules\Exam\Models\Exam;
use Modules\File\Facades\FileFacade;
use Modules\File\Models\File;

class AdvocateCompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCompetitions()
    {
        // Fetch all competitions for the authenticated user
        $user = Auth::user();
        $competitions = Competition::where('school_id', $user->school_id)->paginate(20);
        return view('advocate::competitions.index', compact('competitions'));
    }

    /**
     * Show the form for editing the specified resource.
     */ 
    public function showCompetition($id)
    {
        $competition = Competition::findOrFail($id);
        return view('advocate::competitions.show', compact('competition'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createCompetition()
    {
        // Fetch all schools and exams for the dropdowns
        $schools = School::all();
        $exams = Exam::all();
        return view('advocate::competitions.create', compact('schools', 'exams'));

    }


    // edit
    public function editCompetition($id)
    {
        $competition = Competition::findOrFail($id);
        $schools = School::all();
        $exams = Exam::all();
        $competitionSchools = $competition->schools()->pluck('school_id')->toArray();
        $competitionExams = $competition->exams()->pluck('exam_id')->toArray();
        return view('advocate::competitions.edit', compact('competition', 'schools', 'exams', 'competitionSchools', 'competitionExams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeCompetitions(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'instruction' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            // 'visibility' => 'required|in:public,private',
            // 'type' => 'required|in:1,2',
            'school_id' => 'required|array',
            'school_id.*' => 'exists:schools,id',
            'exam_id' => 'required|array',
            'exam_id.*' => 'exists:exams,id',
            'exam_duration' => 'required|array',
            'exam_duration.*' => 'nullable|integer|min:1',
            'exam_questions' => 'required|array',
            'exam_questions.*' => 'nullable|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Create the competition
        $competition = Competition::create([
            'user_id' => $user->id,
            'school_id' => $user->school_id,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'instruction' => $validated['instruction'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            // 'visibility' => $validated['visibility'],
            // 'type' => $validated['type'],
        ]);

        if ($request->hasFile('image')) {
            $files = request()->files;
            foreach ($files as $key => $value) {
                FileFacade::cloudinaryDelete(File::where('identifier', $key)->where('entity_id', $competition->id)->get());
                FileFacade::cloudinaryUpload($value, $competition, identifier: $key);
            }
        }

        // Attach schools to the competition
        foreach ($validated['school_id'] as $schoolId) {
            CompetitionSchool::create([
                'competition_id' => $competition->id,
                'school_id' => $schoolId,
            ]);
        }

        // Attach exams to the competition
        foreach ($validated['exam_id'] as $index => $examId) {
            CompetitionExam::create([
                'competition_id' => $competition->id,
                'exam_id' => $examId,
                'duration' => $validated['exam_duration'][$examId] ?? 60, // Default to 60 minutes if not provided
                'total_questions' => $validated['exam_questions'][$examId] ?? 10, // Default to 10 questions if not provided
            ]);
        }

        // Redirect with success message
        return redirect()->route('advocate.competitions.index')->with('success', 'Competition created successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCompetition(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'instruction' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            // 'visibility' => 'required|in:public,private',
            // 'type' => 'required|in:1,2',
            'school_id' => 'required|array',
            'school_id.*' => 'exists:schools,id',
            'exam_id' => 'required|array',
            'exam_id.*' => 'exists:exams,id',
            'exam_duration' => 'required|array',
            'exam_duration.*' => 'nullable|integer|min:1',
            'exam_questions' => 'required|array',
            'exam_questions.*' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
       
        $competition = Competition::findOrFail($id);

        // Handle file upload
        if ($request->hasFile('image')) {
            $files = request()->files;
            foreach ($files as $key => $value) {
                FileFacade::cloudinaryDelete(File::where('identifier', $key)->where('entity_id', $competition->id)->get());
                FileFacade::cloudinaryUpload($value, $competition, identifier: $key);
            }
        }

        // Update competition details
        $competition->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'instruction' => $validated['instruction'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            // 'visibility' => $validated['visibility'],
            // 'type' => $validated['type'],
        ]);

        // Sync schools
        $competition->schools()->sync($validated['school_id']);

        // dd($validated);

        // Sync exams
        $competition->exams()->detach(); // Detach all existing exams
        foreach ($validated['exam_id'] as $index => $examId) {
            CompetitionExam::updateOrCreate([
                'competition_id' => $competition->id,
                'exam_id' => $examId,
            ],[
                'competition_id' => $competition->id,
                'exam_id' => $examId,
                'duration' => $validated['exam_duration'][$examId] ?? 60, // Default to 60 minutes if not provided
                'total_questions' => $validated['exam_questions'][$examId] ?? 10, // Default to 10 questions if not provided
            ]);
        }

        // Redirect with success message
        return redirect()->route('advocate.competitions.index')->with('success', 'Competition updated successfully!');
    }

}
