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
        $data['members'] = WedMember::where('show', 1)->limit(20)->get();
        return view('website.wed.index', $data);
    }
}
