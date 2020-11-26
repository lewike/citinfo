<?php

namespace App\Http\Middleware;

use Closure;

class NeedBaseInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! Auth::check()) {
            $wechatUser = session('wechat.oauth_user.default');
            if (! $user = User::where('wechat_openid', $wechatUser->id)->first()) {
                $user = User::create([
                    'wechat_openid' => $wechatUser->id,
                    'name' => $wechatUser->name,
                    'avatar' => $wechatUser->avatar,
                    'email' => $wechatUser->id.'@zaixixian.com'
                ]);
            }
            Auth::login($user);
        }

        $user = Auth::user();

        if (! $user->hasWed()) {
            return redirect('/wed/userinfo');
        }
       
        return $next($request);
    }
}
