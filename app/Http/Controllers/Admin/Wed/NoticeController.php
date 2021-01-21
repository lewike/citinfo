<?php

namespace App\Http\Controllers\Admin\Wed;

use App\Model\Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        // $data['config'] = Config::value('wed');
        $data['notice'] = Config::value('wed.notice');
        return view('admin.wed.notice.index', $data);
    }
    
    public function edit()
    {
        return view('admin.wed.notice.edit', $data);
    }
}
