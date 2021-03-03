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
    public function qrcode(Request $request)
    { 
        if (env('APP_ENV') == 'local') {
            return response()
                ->json(['result' => true, 'data' => ['url' => 'https://gimg2.baidu.com/image_search/src=http%3A%2F%2Fwww.dh3344.com%2Fapi%2Fqrcode.png.php%3Fauth%3Dhttp%3A%2F%2Fwww.dh3344.com%2Fnews%2Fshow-90347.html&refer=http%3A%2F%2Fwww.dh3344.com&app=2002&size=f9999,10000&q=a80&n=0&g=0n&fmt=jpeg?sec=1613265413&t=78f36f77fb822ae32fff1c705d88b703']]);
        }
        $scene = $request->get('scene', 'none');
        $sceneStr = $scene.':'.Str::random(32);
        $qrCode = app('wechat.official_account')->qrcode;
        $result = $qrCode->temporary($sceneStr, 24 * 3600);
        $url = $qrCode->url($result['ticket']);
        
        session(['wechat_scene_str' => $sceneStr]);
        
        return response()
                ->json(['result' => true, 'data' => ['url' => $url]]);
    }

    public function check()
    {
        $code = session('wechat_scene_str');
        return response()
                ->json(['result' => !!Cache::get('openid:'.$code)]);
    }

    public function auth()
    {
        $user = session('wechat.oauth_user.default');
        $code = Str::random(32);
        $user = json_decode(json_encode($user), true);
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

    public function share(Request $request)
    {
        $app = app('wechat.official_account');
        $app->jssdk->setUrl($request->server('HTTP_REFERER'));
        return ['json' => $app->jssdk->buildConfig(['updateAppMessageShareData', 'updateTimelineShareData'], false, false, false)];
    }
}
