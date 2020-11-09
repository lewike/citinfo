<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminAuth
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
        if (env('APP_ENV') == 'local') {
            return $next($request);
        }
        $user = Auth::user();
        if ($user && $user->isAdmin()) {
            return $next($request);
        }
        return redirect('/admin/login');
    }
}
