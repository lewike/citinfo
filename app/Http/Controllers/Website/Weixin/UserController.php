<?php

namespace App\Http\Controllers\Website\Weixin;

use App\Model\User;
use App\Model\Post;
use App\Model\File;
use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $wechatUser = session('wechat.oauth_user.default');
        $user = User::findByOpenId($wechatUser->id);
        $data['posts'] = Post::where('user_id', $user->id)->where('status', 'published')->latest()->get();
        return view('website.weixin.user.index', $data);
    }
}
