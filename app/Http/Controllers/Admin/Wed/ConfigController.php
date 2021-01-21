<?php

namespace App\Http\Controllers\Admin\Wed;

use App\Model\Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function edit()
    {
        $data['swipers'] = Config::value('wed.swiper');
        return view('admin.wed.config.edit', $data);
    }

    public function update(Request $request)
    {
        $name = $request->get('key');
        $config = Config::where('name', $name)->first();
        if (! $config) {
            Config::create([
                'name' => $name,
                'value' => $request->except(['_token', 'key'])
            ]);
        } else {
            $config->update(['value' => $request->except(['_token', 'key'])]);
        }
        
        return ['result' => true];
    }
}
