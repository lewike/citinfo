<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Model\Post;
use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['post_cnt'] = Post::count();
        $data['user_cnt'] = User::count();
        $data['today_post_cnt'] = Post::whereDate('created_at', Carbon::today())->count();
        $data['yesterday_post_cnt'] = Post::whereDate('created_at', Carbon::yesterday())->count();
        return view('admin.home.index', $data);
    }
}
