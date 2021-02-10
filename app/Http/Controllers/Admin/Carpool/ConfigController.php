<?php

namespace App\Http\Controllers\Admin\Carpool;

use App\Model\Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function edit()
    {
        $data['config'] = Config::value('carpool');
        return view('admin.carpool.config.edit', $data);
    }

    public function update(Request $request)
    {
        $name = $request->get('key');
        $config = Config::where('name', $name)->first();
        $value = $request->except(['_token', 'key']);

        if (! $config) {
            Config::create([
                'name' => $name,
                'value' => $value
            ]);
        } else {
            $config->update(['value' => $value]);
        }
        
        return ['result' => true];
    }
}
