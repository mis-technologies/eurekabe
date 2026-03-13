<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Modules\Admin\Emails\NotifyUser;
use App\Models\HomePage;
use App\Models\VolunteerApplication;
use Modules\Admin\Http\Requests\BlogUpdateRequest;
use Modules\Admin\Http\Requests\EventUpdateRequest;
use Modules\Admin\Models\Founder;
use Modules\Common\Models\Student;
use Modules\Exam\Models\Exam;
use Modules\Exam\Models\Question;
use Modules\Exam\Models\Result;
use Modules\Student\Http\Requests\StudentRequest;
use Modules\Student\Models\StudentExamResult;

class AdminController extends Controller
{
   public function dashboard()
   {

        $data['students'] = User::where('role', 'student')->count();
        $data['exams'] = Exam::count();
        $data['results'] = Result::count();
        $data['questions'] = Question::count();

        return view('admin::dashboard', $data);
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
       $founders = Founder::orderBy('order_column', 'asc')->get();
       return view('admin::pages.home.index', compact('homePage', 'homePageData', 'founders'));
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

    $data = [
        'title' => $request->title,
        'slug' => \Str::slug($request->title),
        'content'=>$request->content,
        'status'=>$request->status,
        'category_id'=> $request->category_id,
    ];

    if ($request->has('image')) {
        $blogImage = self::imageUploader($request->image, 'SuperAdmin', 'blog-images');
        $data['image'] = $blogImage;
    }

    $blog = Blog::updateOrCreate(['id' => $blog_id],$data);

    $notify[]=['success', 'Updated succesfully'];
        return redirect()->back()->withNotify($notify);

}

public function blogUpdateView($blog_id=null)
{

    $data['cats'] = Category::all();
    $data['blog'] = Blog::with('category')->where('id', $blog_id)->first();

    return view('admin::blog-crud.update-blog', $data);

}


public function eventsDisplay()
{

    $data['events'] = Event::latest()->get();

    return view('admin::event-crud.index', $data);
}

public function eventUpdate(EventUpdateRequest $request, $event_id = null)
{
    $validated = $request->validated();

    // dd($validated);

   // Handle speaker image uploads
$speakers = $validated['speakers'] ?? [];
$sponsors = $validated['sponsors'] ?? [];


foreach ($sponsors as $index => $sponsor) {
    if ($request->hasFile("sponsors.$index.logo_url")) {
        $logo = $request->file("sponsors.$index.logo_url");
        $path = self::imageUploader($logo, 'SuperAdmin', 'event-sponsors');
        $sponsors[$index]['logo_url'] = $path;
    } else {
        $sponsors[$index]['logo_url'] = $sponsor['logo_urll'] ?? null;
    }
}

foreach ($speakers as $index => $speaker) {
    if ($request->hasFile("speakers.$index.img_url")) {
        $image = $request->file("speakers.$index.img_url");
        $path = self::imageUploader($image, 'SuperAdmin', 'event-speakers');
        $speakers[$index]['img_url'] = $path;
    } else {
        $speakers[$index]['img_url'] = $speaker['img_urll'] ?? null;
    }
}

// Encode the speakers and sponsors data without adding extra slashes
$encodedSpeakers = json_encode($speakers);
$encodedSponsors = json_encode($sponsors);


// Handle event image upload
// if ($request->hasFile('image')) {
//     $eventImage = self::imageUploader($request->image, 'SuperAdmin', 'event-images');
//     $path = $eventImage;

// }

$data = [
    'title' => $validated['title'],
    'cta_text' => $validated['cta_text'],
    'type' => $validated['type'],
    'start_datetime' => $validated['start_datetime'],
    'end_datetime' => $validated['end_datetime'],
    'location' => $validated['location'],
    'price' => $validated['price'],
    'description' => $validated['description'],
    'speakers' => $encodedSpeakers, // JSON encoded
    'sponsors' => $encodedSponsors, // JSON encoded
    'special_bonus' => $validated['special_bonus'],
    'status' => $validated['status'],
    'reg_link' => $validated['reg_link'],
];

// Only add image if it exists
if ($request->hasFile('image')) {
    $path = self::imageUploader($request->file('image'), 'SuperAdmin', 'event-images');
    $data['image'] = $path;
}

$event = Event::updateOrCreate(['id' => $event_id], $data);
// dd($path);
// Create or update event
// $event = Event::updateOrCreate(
//     ['id' => $event_id],
//     [
//         'title' => $validated['title'],
//         'type' => $validated['type'],
//         'start_datetime' => $validated['start_datetime'],
//         'end_datetime' => $validated['end_datetime'],
//         'location' => $validated['location'],
//         'price' => $validated['price'],
//         'description' => $validated['description'],
//         'speakers' => $encodedSpeakers, // Save the JSON encoded speakers
//         'sponsors' => $encodedSponsors, // Save the JSON encoded sponsors
//         'special_bonus' => $validated['special_bonus'],
//         'status' => $validated['status'],
//         'reg_link' => $validated['reg_link'],
//             'image'=> $path ?? null,

//
//     ]
// );


    $notify[]=['success', 'Updated succesfully'];
    return redirect()->back()->withNotify($notify);
}



public function eventUpdateView($event_id=null)
{

    $data['event'] = Event::where('id', $event_id)->first();

    // dd(Blog::all());
    return view('admin::event-crud.update-event', $data);

}


public function deleteBlog($blog_id)
{

    $blog = Blog::find($blog_id);
    $blog->delete();

    $notify[]=['success', 'Deleted succesfully'];
    return redirect()->back()->withNotify($notify);

}
public function deleteEvent($event_id)
{

    $event = Event::find($event_id);
    $event->delete();

    $notify[]=['success', 'Deleted succesfully'];
    return redirect()->back()->withNotify($notify);

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

                return 'storage/' . $finalPath;

            }else{

                return 'storage/'. $finalPath;

            }
        } else {
            throw new \Exception('File upload failed.');
        }
    }

    // Volunteer Application Methods
    public function volunteers()
    {
        $data['volunteers'] = VolunteerApplication::latest()->get();
        return view('admin::volunteers.index', $data);
    }

    public function showVolunteer($id)
    {
        $data['volunteer'] = VolunteerApplication::findOrFail($id);
        return view('admin::volunteers.show', $data);
    }

    public function updateVolunteerStatus(Request $request, $id)
    {
        $volunteer = VolunteerApplication::findOrFail($id);
        $oldStatus = $volunteer->status;
        
        $volunteer->update([
            'status' => $request->status,
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
        ]);

        // Send email notification if status changed to approved or rejected
        if (in_array($request->status, ['approved', 'rejected']) && $oldStatus !== $request->status) {
            try {
                \Illuminate\Support\Facades\Mail::to($volunteer->email)
                    ->send(new \App\Mail\VolunteerApplicationStatus($volunteer, $request->status));
            } catch (\Exception $e) {
                \Log::error('Failed to send volunteer status email: ' . $e->getMessage());
            }
        }

        $statusText = ucfirst($request->status);
        $notify[] = ['success', "Application has been {$statusText}"];
        return redirect()->back()->withNotify($notify);
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'founders' => ['required', 'array'],
            'founders.*.name' => ['required', 'string', 'max:255'],
            'founders.*.position' => ['required', 'string', 'max:255'],
            'founders.*.is_active' => ['required', 'boolean'],
            'founders.*.order_column' => ['required', 'integer', 'min:0'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'image', 'mimes:png', 'max:2048'],
        ]);

        $founders = $request->input('founders', []);
        $images = $request->file('images', []);

        // Prevent duplicate order_column in request
        $orders = collect($founders)->pluck('order_column');

        if ($orders->duplicates()->isNotEmpty()) {
            return back()
                ->withErrors(['order_column' => 'Display order must be unique.'])
                ->withInput();
        }

        foreach ($founders as $id => $data) {

            $founder = Founder::find($id);

            if (!$founder) {
                continue;
            }

            // Handle image upload
            if (isset($images[$id]) && $images[$id]->isValid()) {

                if ($founder->image_path && File::exists(public_path($founder->image_path))) {
                    File::delete(public_path($founder->image_path));
                }

                $image = $images[$id];

                $filename = time().'_'.$image->getClientOriginalName();

                $image->move(public_path('asset/images'), $filename);

                $data['image_path'] = 'asset/images/'.$filename;
            }

            $founder->update([
                'name' => $data['name'],
                'position' => $data['position'],
                'order_column' => $data['order_column'],
                'is_active' => $data['is_active'],
                'image_path' => $data['image_path'] ?? $founder->image_path
            ]);
        }

        return redirect()->back()->with('success', 'Founders updated successfully.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
            'image' => ['required', 'image', 'mimes:png,jpeg,jpg']
        ]);

        $image = $request->file('image');

        $filename = uniqid().'_'.$image->getClientOriginalName();

        $image->move(public_path('asset/images'), $filename);

        $imagePath = 'asset/images/'.$filename;

        $nextOrder = (Founder::max('order_column') ?? 0) + 1;

        Founder::create([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'order_column' => $nextOrder,
            'is_active' => $validated['is_active'],
            'image_path' => $imagePath
        ]);

        return redirect()->back()->with('success', 'Founder created successfully.');
}

}
