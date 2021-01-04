<?php

namespace App\Http\Controllers\Website\Wed;

use Auth;
use App\Model\WedMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data['member'] = WedMember::where('user_id', $user->id)->first();
        return view('website.wed.profile.index', $data);
    }
    
    public function edit()
    {
        return view('website.wed.profile.edit');
    }

    public function updateImages(Request $request)
    {
        $images = $request->get('images');
        $user = Auth::user();
        $wedMember = WedMember::where('user_id', $user->id)->first();
        $wedMember->images = $images;
        $wedMember->save();
        return [];
    }
}
