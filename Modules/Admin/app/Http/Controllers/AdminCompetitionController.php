<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Models\Competition;
use Modules\Common\Models\Exam;
use Modules\Common\Models\School;

class AdminCompetitionController extends Controller
{
    public function index()
    {
        $competitions = Competition::with(['schools'])
            ->withCount('participants')
            ->latest()
            ->paginate(20);

        return view('admin::competitions.index', compact('competitions'));
    }

    public function create()
    {
        $schools = School::orderBy('name')->get();
        $exams = Exam::orderBy('title')->get();
        return view('admin::competitions.create', compact('schools', 'exams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'instruction'       => 'nullable|string',
            'status'            => 'required|in:upcoming,ongoing,completed,cancelled',
            'start_date'        => 'nullable|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
            'visibility'        => 'required|in:public,school,private',
            'type'              => 'required|string|max:100',
            'price'             => 'nullable|numeric|min:0',
            'timezone'          => 'required|timezone',
            'window_start_hour' => 'required|integer|min:0|max:23',
            'window_end_hour'   => 'required|integer|min:0|max:23',
            'school_ids'        => 'nullable|array',
            'school_ids.*'      => 'exists:schools,id',
        ]);

        $competition = Competition::create([
            'user_id'           => Auth::id(),
            'name'              => $validated['name'],
            'description'       => $validated['description'] ?? null,
            'instruction'       => $validated['instruction'] ?? null,
            'status'            => $validated['status'],
            'start_date'        => $validated['start_date'] ?? null,
            'end_date'          => $validated['end_date'] ?? null,
            'visibility'        => $validated['visibility'],
            'type'              => $validated['type'],
            'price'             => $validated['price'] ?? 0,
            'timezone'          => $validated['timezone'] ?? 'UTC',
            'window_start_hour' => $validated['window_start_hour'] ?? 0,
            'window_end_hour'   => $validated['window_end_hour'] ?? 1,
        ]);

        if (!empty($validated['school_ids'])) {
            $competition->schools()->sync($validated['school_ids']);
        }

        session()->flash('success', 'Competition created successfully.');
        return redirect()->route('admin.competitions.show', $competition->id);
    }

    public function show($id)
    {
        $competition = Competition::with([
            'schools',
            'exams',
            'participants.user',
        ])->findOrFail($id);

        $attachedExamIds = $competition->exams->pluck('id');
        $availableExams  = Exam::orderBy('title')
            ->whereNotIn('id', $attachedExamIds)
            ->get();

        return view('admin::competitions.show', compact('competition', 'availableExams'));
    }

    public function addExam(Request $request, $id)
    {
        $request->validate([
            'exam_id'         => 'required|exists:exams,id',
            'duration'        => 'nullable|integer|min:1',
            'total_questions' => 'nullable|integer|min:1',
        ]);

        $competition = Competition::findOrFail($id);

        if ($competition->exams()->where('exam_id', $request->exam_id)->exists()) {
            session()->flash('error', 'That exam is already attached to this competition.');
            return redirect()->route('admin.competitions.show', $id);
        }

        $competition->exams()->attach($request->exam_id, [
            'duration'        => $request->duration ?: null,
            'total_questions' => $request->total_questions ?: null,
        ]);

        session()->flash('success', 'Exam added to competition.');
        return redirect()->route('admin.competitions.show', $id);
    }

    public function removeExam($id, $examId)
    {
        $competition = Competition::findOrFail($id);
        $competition->exams()->detach($examId);

        session()->flash('success', 'Exam removed from competition.');
        return redirect()->route('admin.competitions.show', $id);
    }

    public function edit($id)
    {
        $competition = Competition::with('schools')->findOrFail($id);
        $schools = School::orderBy('name')->get();
        $exams = Exam::orderBy('title')->get();
        return view('admin::competitions.edit', compact('competition', 'schools', 'exams'));
    }

    public function update(Request $request, $id)
    {
        $competition = Competition::findOrFail($id);

        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'instruction'       => 'nullable|string',
            'status'            => 'required|in:upcoming,ongoing,completed,cancelled',
            'start_date'        => 'nullable|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
            'visibility'        => 'required|in:public,school,private',
            'type'              => 'required|string|max:100',
            'price'             => 'nullable|numeric|min:0',
            'timezone'          => 'required|timezone',
            'window_start_hour' => 'required|integer|min:0|max:23',
            'window_end_hour'   => 'required|integer|min:0|max:23',
            'school_ids'        => 'nullable|array',
            'school_ids.*'      => 'exists:schools,id',
        ]);

        $competition->update([
            'name'              => $validated['name'],
            'description'       => $validated['description'] ?? null,
            'instruction'       => $validated['instruction'] ?? null,
            'status'            => $validated['status'],
            'start_date'        => $validated['start_date'] ?? null,
            'end_date'          => $validated['end_date'] ?? null,
            'visibility'        => $validated['visibility'],
            'type'              => $validated['type'],
            'price'             => $validated['price'] ?? 0,
            'timezone'          => $validated['timezone'] ?? 'UTC',
            'window_start_hour' => $validated['window_start_hour'] ?? 0,
            'window_end_hour'   => $validated['window_end_hour'] ?? 1,
        ]);

        $competition->schools()->sync($validated['school_ids'] ?? []);

        session()->flash('success', 'Competition updated successfully.');
        return redirect()->back();
    }

    public function updateStatus(Request $request, $id)
    {
        $competition = Competition::findOrFail($id);

        $request->validate([
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
        ]);

        $competition->update(['status' => $request->status]);

        session()->flash('success', 'Competition status updated.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            $competition = Competition::findOrFail($id);
            $competition->schools()->detach();
            $competition->exams()->detach();
            $competition->delete();

            session()->flash('success', 'Competition deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to delete competition. It may have associated records.');
        }

        return redirect()->route('admin.competitions.index');
    }

    public function broadcast(Request $request, $id)
    {
        $competition = Competition::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'segment' => 'required|in:all_participants,schools,all_eligible',
        ]);

        $notification = new \Modules\Common\Notifications\Notification(null, [
            'title' => $request->title,
            'text' => $request->message,
            'entity' => get_class($competition),
            'entity_id' => $competition->id,
            'meta' => ['competition_id' => $competition->id, 'admin_broadcast' => true],
        ], ['database', 'push']);

        $recipients = [];

        match ($request->segment) {
            'all_participants' => $recipients = $competition->participants()->pluck('user_id')->toArray(),
            'schools' => $recipients = \App\Models\User::whereHas('schools', function ($q) use ($competition) {
                $q->whereIn('school_id', $competition->schools()->pluck('schools.id'));
            })->pluck('id')->toArray(),
            'all_eligible' => $recipients = $competition->visibility === 'public'
                ? \App\Models\User::where('user_type', 'student')->pluck('id')->toArray()
                : \App\Models\User::whereHas('schools', function ($q) use ($competition) {
                    $q->whereIn('school_id', $competition->schools()->pluck('schools.id'));
                })->pluck('id')->toArray(),
        };

        foreach (array_chunk($recipients, 100) as $chunk) {
            \App\Models\User::whereIn('id', $chunk)->each(fn ($user) => $user->notify($notification));
        }

        session()->flash('success', 'Notification broadcast to ' . count($recipients) . ' recipients.');
        return redirect()->back();
    }
}
