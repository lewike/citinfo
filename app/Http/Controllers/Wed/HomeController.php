<?php

namespace App\Http\Controllers\Wed;

use App\Model\Config;
use App\Model\WedMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['swipers'] = Config::value('wed.swiper');
        
        $data['notice'] = Config::value('wed.notice');
        $data['members'] = WedMember::where('show', 1)->limit(12)->get();
        return view('wed.home.index', $data);
    }
}