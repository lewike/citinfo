<?php

namespace App\Http\Controllers\Website\Wed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('website.wed.home.index', $this->data);
    }

    public function show()
    {
        return view('website.wed.home.index');   
    }
}
