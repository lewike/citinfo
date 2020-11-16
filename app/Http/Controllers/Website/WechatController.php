<?php

namespace App\Http\Controllers\Website;

use Cache;
use Illuminate\Support\Str; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    public function qrcode()
    {
        $wechatCode = 'createPost-'.Str::random(32);
    
        $qrCode = app('wechat.official_account')->qrcode;
        $result = $qrCode->temporary($wechatCode, 24 * 3600);
        $url = $qrCode->url($result['ticket']);
        
        session(['wechat-code' => $wechatCode]);
        
        return response()
                ->json(['result' => true, 'data' => ['url' => $url]]);
    }

    public function check()
    {
        $code = session('wechat-code');
        return response()
                ->json(['result' => !!Cache::get('wechat-code'.$code)]);
    }
}
