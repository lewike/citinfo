<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MpController extends Controller
{
    public function configMenu()
    {
        return view('admin.mp.config.menu');
    }

    public function updateConfigMenu(Request $request)
    {
        $menu = $request->get('menu');
        $menu = json_decode($menu, true);

        $app = app('wechat.official_account');
        $app->menu->create($menu['button']);
        return ['result' => true];
    }
}
