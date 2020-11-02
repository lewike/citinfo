<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('website.page.about');
    }

    public function changelog()
    {
        return view('website.page.changelog');
    }

    public function contact()
    {
        return view('website.page.contact');
    }

    public function help()
    {
        return view('website.page.help');
    }

    public function policy()
    {
        return view('website.page.policy');
    }

    public function promotion()
    {
        return view('website.page.promotion');
    }
}
