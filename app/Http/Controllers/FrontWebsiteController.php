<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Common\Models\School;
use App\Models\HomePage;
use App\Models\Event;
use App\Models\Blog;
use Carbon\Carbon;


class FrontWebsiteController extends Controller
{
    // home page
    public function home()
    {
        // Fetch the first record from the HomePage model
        $homePage = HomePage::first();

        if ($homePage) {
            // Decode the JSON data
            $homePageData = [
                'herosection' => json_decode($homePage->herosection, true),
                'pathnersection' => json_decode($homePage->pathnersection, true),
                'whoarewe' => json_decode($homePage->whoarewe, true),
                'socialsection' => json_decode($homePage->socialsection, true),
                'whatweoffer' => json_decode($homePage->whatweoffer, true),
                'teamsection' => json_decode($homePage->teamsection, true),
                'downloadsection' => json_decode($homePage->downloadsection, true),
                'engagementsection' => json_decode($homePage->engagementsection, true),
            ];

            // Prepend APP_URL to image paths
            $appUrl = config('app.url');
            foreach ($homePageData['herosection']['img_url'] as $key => $value) {
                $homePageData['herosection']['img_url'][$key] = $appUrl . '/' . $value;
            }
            foreach ($homePageData['pathnersection']['schools'] as &$school) {
                $school['img_url'] = $appUrl . '/' . $school['img_url'];
            }
            foreach ($homePageData['whoarewe'] as $key => $value) {
                if ($key === 'img_url' || $key === 'community_url') {
                    $homePageData['whoarewe'][$key] = $appUrl . '/' . $value;
                }
            }
            foreach ($homePageData['socialsection'] as &$social) {
                if (isset($social['img_url'])) {
                    $social['img_url'] = $appUrl . '/' . $social['img_url'];
                }
            }
            foreach ($homePageData['whatweoffer']['services'] as &$service) {
                $service['img_url'] = $appUrl . '/' . $service['img_url'];
            }
            foreach ($homePageData['teamsection']['members'] as &$member) {
                $member['img_url'] = $appUrl . '/' . $member['img_url'];
            }
            foreach ($homePageData['downloadsection'] as &$store) {
                $store['img_url'] = $appUrl . '/' . $store['img_url'];
            }
        } else {
            // Set default values if no data is available
            $homePageData = [
                'herosection' => [
                    'title' => 'No data available',
                    'desc' => 'No data available',
                    'img_url' => [
                        'img1' => '',
                        'img2' => '',
                        'img3' => '',
                        'img4' => '',
                        'img5' => '',
                        'img6' => '',
                        'img7' => '',
                        'img8' => '',
                    ],
                ],
                'pathnersection' => [
                    'title' => 'No data available',
                    'schools' => [
                        [
                            'school_name' => '',
                            'img_url' => '',
                        ],
                    ],
                ],
                'whoarewe' => [
                    'title' => 'No data available',
                    'desc' => 'No data available',
                    'img_url' => '',
                    'content' => 'No data available',
                    'points' => [],
                    'community_url' => '',
                ],
                'socialsection' => [],
                'whatweoffer' => [
                    'title' => 'No data available',
                    'sub_title' => 'No data available',
                    'desc' => 'No data available',
                    'advocacy_url' => '',
                    'services' => [],
                ],
                'teamsection' => [
                    'members' => [],
                ],
                'downloadsection' => [],
                'engagementsection' => [
                    'title' => 'No data available',
                    'sub_title' => 'No data available',
                    'desc' => 'No data available',
                    'advocate_url' => '',
                ],
            ];
        }
        // dd($homePageData);

        // Pass the data to the view
        return view('welcome', compact('homePageData'));
    }

    public function events()
    {
        $appUrl = config('app.url');
    
        // Fetch all events from the database
        $events = Event::all()->map(function ($event) use ($appUrl) {
            $event->image = $appUrl . '/' . $event->image;
            $event->speakers = collect(json_decode($event->speakers))->map(function ($speaker) use ($appUrl) {
                $speaker->img_url = $appUrl . '/' . $speaker->img_url;
                return $speaker;
            });
            $event->sponsors = collect(json_decode($event->sponsors))->map(function ($sponsor) use ($appUrl) {
                $sponsor->logo_url = $appUrl . '/' . $sponsor->logo_url;
                return $sponsor;
            });
    
            // Calculate duration
            $start = \Carbon\Carbon::parse($event->start_datetime);
            $end = \Carbon\Carbon::parse($event->end_datetime);
            $event->duration = $start->diffInHours($end);
    
            return $event;
        });

        // dd($events->toArray());
    
        // Pass the events data to the Blade view
        return view('pages.event', compact('events'));
    }


    

    

    

    

 
 
   
    
 

    public function article()
    {
        // dd('here');

        // $blogContent = Blog::findOrFail($id);
        return view('pages.article');
    }
   



    public function faq()
    {
        return view('pages.faq');
    }

    public function blog()
    {
        return view('pages.blogs');
    }

    public function requestForm()
    {
        $data['schools']= School::latest()->get();
        return view('pages.requestForm', $data);
    }

    public function contact()
    {
        return view('pages.contact-us');
    }

    public function login()
    {
        return view('pages.login');
    }

   

    public function policyPrivacy()
    {
        return view('pages.privacy-policy');
    }

   
}
