<?php

namespace App\Http\Controllers\Admin\Wed;

use App\Model\Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function edit()
    {
        $data['config'] = Config::value('wed');
        return view('admin.wed.config.edit', $data);
    }

    public function update(Request $request)
    {
        $data['value'] = $request->all();
        $data['name'] = 'wed';
        $config = Config::where('name', 'wed')->first();
        if (! $config) {
            Config::create([
                'name' => 'wed',
                'value' => $request->except(['_token'])
            ]);
        } else {
            $config->update(['value' => $request->except(['_token'])]);
        }
        
        return ['result' => true];
    }
}
