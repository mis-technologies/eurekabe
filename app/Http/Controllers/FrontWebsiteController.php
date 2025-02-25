<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Common\Models\School;

class FrontWebsiteController extends Controller
{
    //
    public function events()
    {
        return view('pages.event');
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

    public function home()
    {
        return view('welcome');
    }

    public function policyPrivacy()
    {
        return view('pages.policy-privacy');
    }
}
