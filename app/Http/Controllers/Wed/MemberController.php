<?php

namespace App\Http\Controllers\Wed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('wed.member.index');
    }
}
