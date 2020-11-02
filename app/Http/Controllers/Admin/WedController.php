<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WedController extends Controller
{
    public function member()
    {
        return view('admin.wed.member');
    }
}
