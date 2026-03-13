<?php

namespace App\Http\Controllers;

use App\Models\VolunteerApplication;
use Illuminate\Http\Request;

class VolunteerApplicationController extends Controller
{
    public function showForm()
    {
        return view('volunteer.apply');
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'university' => 'nullable|string|max:255',
            'course' => 'nullable|string|max:255',
            'motivation' => 'required|string|min:20',
            'experience' => 'nullable|string|min:10',
            'skills' => 'nullable|array',
        ]);

        if (isset($data['skills'])) {
            $data['skills'] = array_values($data['skills']);
        }

        VolunteerApplication::create($data);

        return redirect()->back()->with('success', 'Thank you — your application has been received.');
    }
}
