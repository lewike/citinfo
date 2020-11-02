<?php

namespace App\Http\Middleware;

use Closure;
use Overtrue\Socialite\User;

class MockWechat
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
        $user = new User([
            'id' => 'openid_123456',
            'name' => 'test',
            'nickname' => '测试名字',
            'avatar' => 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLfeUnSfxZzZ1GWlKOF2a0ZCjQ6k50K1iaJvrEYV8uibTEoCXCUdhsbg7kIlpmH0e7LAL3bnea5ib3cA/132',
            'email' => null,
            'original' => [],
            'provider' => 'WeChat',
        ]);
        session(['wechat.oauth_user.default' => $user]);

        return $next($request);
    }
}
