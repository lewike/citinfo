<?php

namespace App\Http\Controllers\Admin\Wed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('admin.wed.member.index');
    }

    public function create()
    {
        return view('admin.wed.member.create');
    }

    public function store(Request $request)
    {
        return response()->json(['']);
    }
}
