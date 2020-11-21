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
        return view('website.wed.index', $data);
    }

    public function list($page)
    {
        $fields = ['id', 'avatar', 'nick_name', 'gender', 'job', 'marry', 'car', 'house', 'vip_level'];
        $data['members'] = WedMember::where('show', 1)->offset($page*12)->limit(12)->get($fields);
        return ['result' => true, 'data' => $data];
    }

    public function detail(WedMember $member)
    {
        $data['member'] = $member;
        return view('website.wed.detail', $data);
    }
}
