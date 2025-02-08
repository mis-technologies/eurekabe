<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('pages.requestForm');
    }

    public function contact()
    {
        return view('pages.contact-us');
    }

    public function login()
    {
        return view('pages.login');
    }
}
