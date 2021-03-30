<?php

namespace App\Http\Controllers\Website;

use App\Model\Post;
use App\Model\Category;
use App\Model\Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['categories'] =  Category::tree();
        $data['categoryArray'] = Category::pluck('name', 'id');
        $data['posts'] = Post::where('status', 'published')->latest('index_sticky')->latest('refresh_at')->limit(50)->get();
        $data['ad'] = Config::value('website.ad');
        return view('website.home.index', $data);
    }
}
