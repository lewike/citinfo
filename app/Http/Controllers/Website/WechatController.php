<?php

namespace App\Http\Controllers\Website;

use Cache;
use Auth;
use App\Model\User;
use Illuminate\Support\Arr;
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

    public function auth()
    {
        $user = session('wechat.oauth_user.default');
        $code = Str::random(32);
        $user = Arr::only($user, ['id', 'name', 'nickname', 'avatar']);
        Cache::put($code, $user, 1800);
        return redirect(request()->get('url').'?code='.$code.'&redirect='.request()->get('redirect-url'));
    }

    public function login()
    {
        $redirectUrl = request()->get('redirect');
        $code = request()->get('code');
        $url = env('WECHAT_AUTH_CODE_URL').'?code='.$code;
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $contents = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($contents, true);
        if (is_array($data) && $data['result']) {
            $openId = $data['data']['id'];
            $user = User::findByOpenId($openId);
            Auth::login($user);
            return redirect($redirectUrl);
        } else {
            return abort(500);
        }
    }
}
