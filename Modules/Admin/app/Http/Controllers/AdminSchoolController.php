<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Models\School;

class AdminSchoolController extends Controller
{
    public function index()
    {
        $schools = School::latest()->paginate(20);
        return view('admin::schools.index', compact('schools'));
    }

    public function create()
    {
        return view('admin::schools.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'acronym'   => 'nullable|string|max:20',
            'about'     => 'nullable|string',
            'year'      => 'nullable|integer|min:1800|max:' . date('Y'),
            'city'      => 'nullable|string|max:100',
            'state'     => 'nullable|string|max:100',
            'type'      => 'required|in:university,polytechnic,college,secondary',
            'is_active' => 'sometimes|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        School::create($validated);

        session()->flash('success', 'School created successfully.');
        return redirect()->route('admin.schools.index');
    }

    public function edit($id)
    {
        $school = School::findOrFail($id);
        return view('admin::schools.edit', compact('school'));
    }

    public function update(Request $request, $id)
    {
        $school = School::findOrFail($id);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'acronym'   => 'nullable|string|max:20',
            'about'     => 'nullable|string',
            'year'      => 'nullable|integer|min:1800|max:' . date('Y'),
            'city'      => 'nullable|string|max:100',
            'state'     => 'nullable|string|max:100',
            'type'      => 'required|in:university,polytechnic,college,secondary',
            'is_active' => 'sometimes|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $school->update($validated);

        session()->flash('success', 'School updated successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            $school = School::findOrFail($id);
            $school->delete();

            session()->flash('success', 'School deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to delete school. It may have associated records.');
        }

        return redirect()->route('admin.schools.index');
    }
}
