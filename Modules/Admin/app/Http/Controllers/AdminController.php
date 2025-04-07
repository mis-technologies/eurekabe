<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Modules\Admin\Emails\NotifyUser;
use App\Models\HomePage;

class AdminController extends Controller
{
   public function dashboard()
   {

        return view('admin::dashboard');
   }

   public function allStudents()
   {
        $data['students'] = User::where('role', 'student')->with(['school', 'schools'])->latest()->get();
        return view('admin::students.index', $data);
   }

   public function update(Request $request, $id)
   {
        $user = User::find($id);
        if ($user->status == 0) {

            Mail::to($user->email)->send(new NotifyUser());
        }
        $user->update([
            'status' => !$user->status
        ]);
        $notify[]=['success', 'Updated succesfully'];
        return redirect()->back()->withNotify($notify);
   }

   public function allAdvocates()
   {
        $data['advocates'] = User::where('role', 'advocate')->with(['school', 'schools'])->latest()->get();
        return view('admin::advocates.index', $data);
   }

   // Home Page
   

   public function showHomePage()
   {
       $homePage = HomePage::first(); // Assuming there's only one record
       $homePageData = json_decode($homePage, true); // Decode the JSON data into an array
       return view('admin::pages.home.index', compact('homePage', 'homePageData'));
   }


public function updateHomePage(Request $request)
{
    $homePage = HomePage::first();

    // Update each section dynamically
    $sections = ['herosection', 'pathnersection', 'whoarewe', 'socialsection', 'whatweoffer', 'teamsection', 'downloadsection', 'engagementsection'];

    foreach ($sections as $section) {
        if ($request->has($section)) {
            // Decode the existing JSON data for the section
            $sectionData = json_decode($homePage->$section, true) ?? [];

            // Update text fields
            $updatedData = $request->input($section, []);
            foreach ($updatedData as $key => $value) {
                if (!empty($value)) {
                    $sectionData[$key] = $value; // Only update if the new value is not empty
                }
            }

            // Special handling for pathnersection schools
            if ($section === 'pathnersection' && isset($updatedData['schools'])) {
                foreach ($updatedData['schools'] as $index => $school) {
                    // Update school name
                    if (!empty($school['school_name'])) {
                        $sectionData['schools'][$index]['school_name'] = $school['school_name'];
                    }

                    // Handle file uploads for school images
                    if ($request->hasFile("$section.schools.$index.img_url")) {
                        $file = $request->file("$section.schools.$index.img_url");
                        if ($file) {
                            $filePath = $file->store("uploads/$section/schools", 'public');
                            $sectionData['schools'][$index]['img_url'] = 'storage/' . $filePath;
                        }
                    }
                }
            }

            // Handle file uploads for images (general img_url field)
            if ($request->hasFile("$section.img_url")) {
                foreach ($request->file("$section.img_url") as $key => $file) {
                    if ($file) {
                        $filePath = $file->store("uploads/$section", 'public');
                        $sectionData['img_url'][$key] = 'storage/' . $filePath;
                    }
                }
            }

            // Save the updated JSON data back to the section
            $homePage->$section = json_encode($sectionData);
        }
    }

    // Save the updated record
    $homePage->save();

    return redirect()->route('admin.pages.home')->with('success', 'HomePage updated successfully.');
}





}
