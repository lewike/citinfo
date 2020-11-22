<?php

namespace App\Http\Controllers\Admin;

use App\Model\Config;
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
    
    public function configCommon()
    {
        $data['config'] = Config::value('mp');
        return view('admin.mp.config.common', $data);
    }
    
    public function updateConfigCommon(Request $request)
    {
        $data['value'] = $request->all();
        $data['name'] = 'mp';
        $config = Config::where('name', 'mp')->first();
        if (! $config) {
            Config::create([
                'name' => 'mp',
                'value' => $request->except(['_token'])
            ]);
        } else {
            $config->update(['value' => $request->except(['_token'])]);
        }
        
        return ['result' => true];
    }
}
