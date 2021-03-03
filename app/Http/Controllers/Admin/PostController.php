<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Model\Post;
use App\Model\Category;
use App\Model\PhoneInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $data['posts'] = Post::paginate(30);
        return view('admin.post.index', $data);
    }

    public function create()
    {
        $data['categories'] = Category::treeArray();
        return view('admin.post.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_path' => 'required',
            'title' => 'required',
            'content' => 'required',
            'phone' => 'required|size:11',
        ], [
            'category_path.required' => '请选择要发布的栏目',
            'title.required' => '标题不能为空',
            'content.required' => '内容不能为空',
            'phone.required' => '手机号码不能为空',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return ['result' => false, 'message' => join('、', $errors->all())];
        }

        $data = $request->only(['category_path', 'content', 'title', 'expired_day', 'phone', 'images']);
        $data['content'] = str_replace(["\r\n", "\n", "\r"], '<br />', $data['content']);
        $data['expired_at'] = date('Y-m-d H:i:s', time()+$data['expired_day']*86400);
        $data['refresh_at'] = date('Y-m-d H:i:s');
        $data['ip'] = $request->ip();
        $data['status'] = 'published';
        if (! $phoneInfo = PhoneInfo::where('phone', $data['phone'])->first()) {
            $phoneInfo = PhoneInfo::create([
                'phone' => $data['phone'],
                'local' => $this->getPhoneLocal($data['phone']),
                'post_cnt' => 1
            ]);
        } else {
            $phoneInfo->post_cnt++;
            $phoneInfo->save();
        }
        if (empty($data['images'])) { 
            $data['images'] = [];
        }
        $data['phone_local'] = $phoneInfo['local'];
        Post::create($data);
        return ['result' => true];
    }

    public function edit(Post $post)
    {
        $data['categories'] = Category::treeArray();
        $data['post'] = $post;
        return view('admin.post.edit', $data);
    }

    public function update(Post $post, Request $request)
    {
        $data = $request->only(['category_path', 'content', 'title', 'expired_day', 'phone', 'images']);
        $data['content'] = str_replace(["\r\n", "\n", "\r"], '<br />', $data['content']);
        $data['expired_at'] = date('Y-m-d H:i:s', time()+$data['expired_day']*86400);
        $data['status'] = 'published';
        if (! $phoneInfo = PhoneInfo::where('phone', $data['phone'])->first()) {
            $phoneInfo = PhoneInfo::create([
                'phone' => $data['phone'],
                'local' => $this->getPhoneLocal($data['phone']),
                'post_cnt' => 1
            ]);
        } else {
            $phoneInfo->post_cnt++;
            $phoneInfo->save();
        }
        if (empty($data['images'])) {
            $data['images'] = [];
        }
        $data['phone_local'] = $phoneInfo['local'];
        $post->update($data);
        return ['result' => true];
    }

    public function delete(Request $request)
    {
        $postId = $request->get('id');
        Post::destroy($postId);
        return ['result' => true];
    }
    
    public function getPhoneLocal($phone)
    {
        $data = json_decode(file_get_contents('https://cx.shouji.360.cn/phonearea.php?number='.$phone), true);
        return isset($data['data']) ? $data['data']['province'].$data['data']['city'] : '未知';
    }

    public function checkPhone(Request $request)
    {
        $phone = $request->phone;
        if ($phoneInfo = PhoneInfo::where('phone', $phone)->first()) {
            return  Arr::only($phoneInfo->toArray(), ['local', 'post_cnt']);
        }
    
        $phoneInfo = PhoneInfo::create([
            'phone' => $phone,
            'local' => $this->getPhoneLocal($phone),
            'post_cnt' => 0
        ]);
        return Arr::only($phoneInfo->toArray(), ['local', 'post_cnt']);
    }
}
