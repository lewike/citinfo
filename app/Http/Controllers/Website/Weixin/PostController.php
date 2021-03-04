<?php

namespace App\Http\Controllers\Website\Weixin;

use App\Model\Post;
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

        return view('website.weixin.post.show', $data);
    }

    public function create()
    {
        return view('website.weixin.post.create');
    }

    public function phone($id)
    {
        $post = Post::find($id);
        $post->call_cnt++;
        $post->save();
        return ['result' => true, 'data' => ['phone' => $post->phone]];
    }
}
