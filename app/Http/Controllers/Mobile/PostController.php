<?php

namespace App\Http\Controllers\Mobile;

use App\Model\User;
use App\Model\Post;
use App\Model\File;
use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $data['post'] = $post;
        $category = explode('/', $post->category_path);
        $categoryId = end($category);
        $data['category'] = Category::where('m_id', $categoryId)->first();
        $data['fenlei'] = $data['category']->parent();

        return view('mobile.post.show', $data);
    }

    public function views(Post $post)
    {
        $post->increment('views');
        return $post->views;
    }

    public function phone(Post $post)
    {
        $post->increment('call_cnt');
        return ['result' => true, 'data' => ['phone' => $post->phone]];
    }
}