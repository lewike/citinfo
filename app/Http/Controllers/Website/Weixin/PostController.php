<?php

namespace App\Http\Controllers\Website\Weixin;

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

        return view('website.weixin.post.show', $data);
    }

    public function create()
    {
        return view('website.weixin.post.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['content', 'expired_day', 'phone', 'images']);
        $wechatUser = session('wechat.oauth_user.default');
        $user = User::findByOpenId($wechatUser->id);
        $data['user_id'] = $user->id;
        $data['category_path'] = '0';
        $data['source'] = 'wechat';
        $data['expired_at'] = $data['refresh_at'] = date('Y-m-d H:i:s');
        $data['ip'] = $request->ip();
        Post::create($data);
        return ['result' => true];
    }

    public function phone($id)
    {
        $post = Post::find($id);
        $post->call_cnt++;
        $post->save();
        return ['result' => true, 'data' => ['phone' => $post->phone]];
    }

    public function upload(Request $request)
    {
        $file = $request->image;
        $md5 = md5_file($file->path());
        $filename = $md5.'.'.$file->guessExtension();
        $path = $file->storeAs('post_images/'.date('ymd'), $filename, 'upload');
        
        $path = '/upload/'.$path;
        File::create([
            'action' => 'post_images',
            'type' => $file->getClientMimeType(),
            'path' => $path,
            'size' => $file->getSize(),
            'md5' => $md5,
        ]);

        if (env('IMG_CDN')) {
            $url = env('CDN_URL').$path.'!120x120';
        } else {
            $url = $path;
        }
        return ['img' => $url];
    }

    public function view(Post $post)
    {
        $post->views++;
        $post->save();
    }
}
