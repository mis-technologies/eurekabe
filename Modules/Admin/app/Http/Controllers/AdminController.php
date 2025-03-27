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
       return view('admin::pages.home.index', compact('homePage'));
   }

   public function updateHomePage(Request $request)
   {
       $homePage = HomePage::first();
   
       // Update each section dynamically
       $sections = ['herosection', 'pathnersection', 'whoarewe', 'socialsection', 'whatweoffer', 'teamsection', 'downloadsection', 'engagementsection'];
   
       foreach ($sections as $section) {
           if ($request->has($section)) {
               $sectionData = json_decode($homePage->$section, true);
               $updatedData = $request->input($section, []);
               $homePage->$section = json_encode(array_merge($sectionData, $updatedData));
           }
       }
   
       $homePage->save();
   
       return redirect()->route('admin.pages.home')->with('success', 'HomePage updated successfully.');
   }





}
