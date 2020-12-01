<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class WechatAuth
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
        if (env('APP_ENV') != 'local' && ! Auth::check()) {
            return redirect(env('WECHAT_AUTH_URL').'?url='.urlencode(env('APP_URL').'/wechat/login').'&redirect-url='.urlencode($request->url()));
        }
        return $next($request);
    }
}
