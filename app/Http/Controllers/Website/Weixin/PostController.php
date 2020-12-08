<?php

namespace App\Http\Controllers\Website\Weixin;

use App\Model\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $data['post'] = $post;
        return view('website.weixin.post.show', $data);
    }
}
