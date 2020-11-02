<?php

namespace App\Http\Controllers\Website;

use App\Model\Post;
use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['categories'] =  Category::tree();
        $data['categoryArray'] = Category::pluck('name', 'id');
        $data['posts'] = Post::where('status', 'published')->latest('index_stick')->latest('refresh_at')->limit(50)->get();        
        return view('website.home.index', $data);
    }
}
