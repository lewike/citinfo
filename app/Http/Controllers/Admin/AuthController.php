<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginAuth(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['is_admin'] = 1;
        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin');
        }
        return redirect('/admin/login')->withErrors('账号或者密码错误，请重新输入！');
    }
}
