<?php

namespace App\Http\Controllers\Website;

use App\Model\Config;
use App\Model\WedMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WedController extends Controller
{
    public function index()
    {
        $data['config'] = Config::value('wed');
        $data['members'] = WedMember::where('show', 1)->limit(12)->get();
        $data['index'] = 'find';
        return view('website.wed.index', $data);
    }

    public function list($page)
    {
        $fields = ['id', 'avatar', 'nick_name', 'gender', 'job', 'age', 'marry', 'car', 'house', 'vip_level'];
        $data['members'] = WedMember::where('show', 1)->offset($page*12)->limit(12)->get($fields);
        return ['result' => true, 'data' => $data];
    }

    public function detail($memberId)
    {
        $data['member'] = WedMember::find($memberId);
        return view('website.wed.detail', $data);
    }

    public function userInfo()
    {
        return view('website.wed.userinfo');
    }

    public function userInfoComplete(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        if ($wedMember = WedMember::where('user_id', $data['user_id'])->first()) {
            $wedMember->update($data);
        } else {
            WedMember::create($data);
        }
        return ['result' => true];
    }

    public function profile()
    {
        $data['user'] = Auth::user();
        $data['member'] =  WedMember::where('user_id', $data['user']->id)->first();
        $data['page'] = 'profile';
        return view('website.wed.profile', $data);
    }
}
