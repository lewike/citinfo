<?php

namespace App\Http\Controllers\Mobile;

use App\Model\Post;
use App\Model\Config;
use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['config'] = Config::value('mp');
        $data['categories'] = Category::where('depth', 1)->get();
        $data['posts'] = Post::where('status', 'published')->latest('index_sticky')->latest('refresh_at')->limit(50)->get();
        return view('mobile.home.index', $data);
    }
    public function category($id)
    {
        $category = Category::find($id);
        $data['subCategories'] = $category->subCategories()->get();
        $data['posts'] = $category->posts()->show()->latest('category_sticky')->latest('refresh_at')->limit(40)->get();
        return view('mobile.home.category', $data);
    }

    public function fenlei($ename)
    {
        $data['category'] = Category::where('ename', $ename)->first();
        $data['subCategories'] = $data['category']->subCategories()->get();
        $data['posts'] = $data['category']->posts()->show()->latest('category_sticky')->latest('refresh_at')->limit(40)->get();
        return view('mobile.home.fenlei', $data);
    }
}