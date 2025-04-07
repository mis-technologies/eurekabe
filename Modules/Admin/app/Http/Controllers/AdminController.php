<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Modules\Admin\Emails\NotifyUser;
use App\Models\HomePage;
use Modules\Admin\Http\Requests\BlogUpdateRequest;

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

public function blogDisplay()
{

    $data['blogs'] = Blog::with('category')->latest()->get();

    return view('admin::blog-crud.index', $data);
}

public function blogUpdate(BlogUpdateRequest $request, $blog_id=null)
{

    $blog = Blog::updateOrCreate(
        ['id' => $blog_id],
        [
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'content'=>$request->content,
            'status'=>$request->status,
            'category_id'=> $request->category_id,
        ]
        );

    if ($request->has('image')) {

        $blogImage = self::imageUploader($request->image, 'SuperAdmin', 'blog-images');
        $blog->image = $blogImage;
        $blog->save();
    }

    $notify[]=['success', 'Updated succesfully'];
        return redirect()->back()->withNotify($notify);

}

public function blogUpdateView($blog_id=null)
{

    $data['cats'] = Category::all();
    $data['blog'] = Blog::with('category')->where('id', $blog_id)->first();

    return view('admin::blog-crud.update-blog', $data);

}










public static function imageUploader($fileRequest, $user, $folderName)
    {
        $ext = $fileRequest->getClientOriginalExtension();
        $name = \Str::slug($user).time().".".$ext;

        $tempPath = $fileRequest->getRealPath();
        $destinationPath = storage_path( 'app/public/' . $folderName);

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0775, true);
            chmod($destinationPath, 0775);
        }

        $finalPath = $fileRequest->storeAs($folderName, $name, 'public');


        if ($finalPath) {
            if (env('APP_ENV') == 'local') {

                return '/storage/' . $finalPath;

            }else{

                return env('ASSET_URL') .'/storage'. $finalPath;

            }
        } else {
            throw new \Exception('File upload failed.');
        }
    }

}
