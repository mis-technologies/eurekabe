<?php

namespace Modules\Advocate\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Exam\Models\Competition;
use Modules\Exam\Models\CompetitionSchool;
use Modules\Exam\Models\CompetitionExam;

class CompetitionController extends Controller
{
    
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'instruction' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'visibility' => 'required|in:public,private',
            'type' => 'required|in:1,2',
            'school_id' => 'required|array',
            'school_id.*' => 'exists:schools,id',
            'exam_id' => 'required|array',
            'exam_id.*' => 'exists:exams,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('competitions', 'public');
        }

        // Create the competition
        $competition = Competition::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'instruction' => $validated['instruction'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'visibility' => $validated['visibility'],
            'type' => $validated['type'],
            'school_id' => $user->school_id,
        ]);

        // Attach schools to the competition
        foreach ($validated['school_id'] as $schoolId) {
            CompetitionSchool::create([
                'competition_id' => $competition->id,
                'school_id' => $schoolId,
            ]);
        }

        // Attach exams to the competition
        foreach ($validated['exam_id'] as $examId) {
            CompetitionExam::create([
                'competition_id' => $competition->id,
                'exam_id' => $examId,
                'duration' => 60, // Default duration (can be customized)
                'total_questions' => 10, // Default total questions (can be customized)
            ]);
        }

        // Redirect with success message
        return redirect()->route('advocate.competitions.index')->with('success', 'Competition created successfully!');
    } 
}
