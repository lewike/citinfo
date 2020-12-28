<?php

namespace App\Http\Controllers\Website\Wed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        return view('website.wed.activity.index');
    }
}
