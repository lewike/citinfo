<?php

namespace App\Http\Controllers\Website;

use App\Model\Category;
use App\Model\Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function fenlei($ename)
    {
        $data['category'] = Category::where('ename', $ename)->first();
        $data['subCategories'] = $data['category']->subCategories()->get();
        $data['posts'] = $data['category']->posts()->show()->latest('category_sticky')->latest('refresh_at')->paginate(40);
        $data['ad'] = Config::value('website.ad');
        return view('website.category.fenlei', $data);
    }
    public function index(Category $category)
    {
        $data['category'] = $category;
        $data['parentCategory'] = $category->parent();
        $data['posts'] = $category->posts()->show()->latest('category_sticky')->latest('refresh_at')->paginate(40);
        $data['ad'] = Config::value('website.ad');
        return view('website.category.index', $data);
    }
}
