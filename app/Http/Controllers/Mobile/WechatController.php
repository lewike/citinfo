<?php

namespace App\Http\Controllers\Mobile;

use App\Model\User;
use App\Model\Post;
use App\Model\File;
use App\Model\Category;
use App\Model\WechatMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    public function createPost()
    {
        return view('mobile.post.create');
    }

    public function savePost(Request $request)
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
        WechatMessage::create([
            'type' => 'txtMsg',
            'receiver_id' => 'dai-dongsheng',
            'content' => '有新的信息提交，需要审核'
        ]);
        return ['result' => true];
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

    public function updatePost(Request $request)
    {
        return ['result' => true];
    }

    public function user()
    {
        $wechatUser = session('wechat.oauth_user.default');
        $user = User::findByOpenId($wechatUser->id);
        $data['posts'] = Post::where('user_id', $user->id)->where('status', 'published')->latest()->get();
        return view('mobile.user.index');
    }

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