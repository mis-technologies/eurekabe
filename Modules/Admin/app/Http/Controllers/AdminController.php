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
   public function Homepage()
   {
     $homePage = HomePage::first(); // Assuming there's only one record in the home_pages table
     $data['homePage'] = $homePage;
     return view('admin::pages.home.index', $data);
   }

   public function editHeroSection($column)
{
    $homePage = HomePage::first();
    $data['column'] = $column;
    $data['value'] = $homePage->$column;
    return view('admin::pages.home.edit-hero-section',compact('homePage', 'column'));
}

public function updateHeroSection(Request $request, $column)
{
    $homePage = HomePage::first();
    $heroSection = json_decode($homePage->herosection, true);

    // Update the heroSection array with new data
    $heroSection['title'] = $request->input('title', $heroSection['title']);
    $heroSection['desc'] = $request->input('desc', $heroSection['desc']);
    $heroSection['community_url'] = $request->input('community_url', $heroSection['community_url']);

    // Handle image uploads
    $imageFields = ['img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7', 'img8'];
    foreach ($imageFields as $imageField) {
        if ($request->hasFile($imageField)) {
            $image = $request->file($imageField);
            $imageName = $imageField . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $heroSection['img_url'][$imageField] = 'images/' . $imageName;
        }
    }

    // Update the herosection column
    $homePage->herosection = json_encode($heroSection);
    $homePage->save();

    return redirect()->route('admin.pages.home')->with('success', 'Section updated successfully.');
}


}
