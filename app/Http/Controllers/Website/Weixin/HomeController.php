<?php

namespace App\Http\Controllers\Website\Weixin;

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
        return view('website.weixin.home.index', $data);
    }
    public function category($id)
    {
        return view('website.weixin.home.category');
    }

    public function fenlei($name)
    {
        return view('website.weixin.home.fenlei');
    }

    public function detail($id)
    {
        return view('website.weixin.home.detail');
    }
}
