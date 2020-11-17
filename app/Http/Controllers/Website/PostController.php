<?php

namespace App\Http\Controllers\Website;

use Validator;
use App\Model\Post;
use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        $data['categories'] = Category::tree();
        return view('website.post.create', $data);
    }

    public function show(Post $post)
    {
        $category = explode('/', $post->category_path);
        $categoryId = end($category);
        $data['category'] = Category::where('m_id', $categoryId)->first();
        $data['fenlei'] = $data['category']->parent();
        $data['post'] = $post;
        $chars = ['6', '7', '5', '8', '9', '0', '3', '2', '1', '4'];
        $data['contact_phone'] = join('', array_map(function ($value) use ($chars) {
            return $chars[$value];
        }, str_split($post->phone)));
        return view('website.post.show', $data);
    }

    public function views(Post $post)
    {
        $post->increment('views');
        return $post->views;
    }

    public function report(Request $request)
    {
        $data = $request->only(['post_id', 'type']);
        $data['ip'] = $request->ip();
        PostReport::create($data);
        return ['result' => true];
    }

    public function postCheckPassword(Request $request)
    {
        $data = $request->only(['post_id', 'password']);
        $post = Post::find($data['post_id']);
        if (! $post) {
            return ['result' => false, 'message' => '请求参数错误！'];
        }
        if ($post->password != $data['password']) {
            return ['result' => false, 'message' => '预留密码不正确，请重试'];
        }
        $token = Str::random(16);
        session(['edit_token:'.$data['post_id'] => $token]);
        return ['result' => true, 'data' => ['token' => $token]];
    }
        
    public function postEditPost(Request $request)
    {
        $data = $request->only(['post_id', 'edit_action', 'expired_day', 'edit_token']);
        $token = session('edit_token:'.$data['post_id'], '');
        session()->forget('edit_token:'.$data['post_id']);
        if ($token != $data['edit_token'] || empty($token)) {
            return ['result' => false, 'message' => '你尚未获取修改权限！'];
        }
        $post = Post::find($data['post_id']);
        if (! $post) {
            return ['result' => false, 'message' => '请求参数错误！'];
        }
        if ($data['edit_action'] == 'expired') {
            $post->expired_at = date('Y-m-d H:i:s');
        }
        if ($data['edit_action'] == 'refresh') {
            if ($post->refresh_at->isToday()) {
                return ['result' => false, 'message' => '每天只能刷新一次'];
            }
            $post->refresh_at = date('Y-m-d H:i:s');
        }
        if ($data['edit_action'] == 'delay_expired') {
            if ($data['expired_day'] < 1) {
                return ['result' => false, 'message' => '延长过期时间最小天数为一天！'];
            }
            $post->expired_at = $post->expired_at->addDays($data['expired_day']);
        }
        $post->save();
        return ['result' => true];
    }

    public function search()
    {
        return view('post.search');
    }

    public function postSearch($keyword)
    {
        if (empty($keyword)) {
            return view('post.search');
        }
        $data['keyword'] = $keyword;
        $data['posts'] = Post::where(function ($query) use ($keyword) {
            $query->where('id', $keyword)->orWhere('phone', $keyword);
        })->show()->latest('refresh_at')->get();
        return view('post.search-result', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_path' => 'required',
            'content' => 'required',
            'phone' => 'required|size:11',
            'password' => 'required|min:6',
            'ticket' => 'required',
            'randstr' => 'required'
        ], [
            'category_path.required' => '请选择要发布的栏目',
            'content.required' => '内容不能为空',
            'phone.required' => '手机号码不能为空',
            'password.required' => '预留密码不能为空',
            'phone.size' => '手机号码不正确，请确认！',
            'password.min' => '预留密码最低6位字符，请确认'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return ['result' => false, 'message' => join('、', $errors->all())];
        }
        $data = $request->only(['ticket', 'randstr']);
        if (env('APP_ENV') !== 'local') {
            if (! $this->check($data['ticket'], $data['randstr'], $request->ip())) {
                return ['result' => false, 'message' => '验证不通过，请重试！'];
            }
        }
        $data = $request->only(['category_path', 'content', 'expired_day', 'password', 'phone', 'contact', 'images']);
        $data['expired_at'] = $data['refresh_at'] = date('Y-m-d H:i:s');
        $data['ip'] = $request->ip();
        $post = Post::create($data);
        return ['result' => true, 'data' => ['url' => $post->url()]];
    }

    private function check($ticket, $randstr, $clientIp)
    {
        $params = http_build_query([
            "aid" => env('CAPTCH_ID'),
            "AppSecretKey" => env('CAPTCH_KEY'),
            "Ticket" => $ticket,
            "Randstr" => $randstr,
            "UserIP" => $clientIp
        ]);
        $curlHttp = curl_init();
        curl_setopt($curlHttp, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curlHttp, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($curlHttp, CURLOPT_TIMEOUT, 60);
        curl_setopt($curlHttp, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHttp, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curlHttp, CURLOPT_URL, "https://ssl.captcha.qq.com/ticket/verify?".$params);
        if (($response = curl_exec($curlHttp)) === false) {
            return false;
        }
        curl_close($curlHttp);
        $result = json_decode($response, true);
        if ($result['response'] == 1) {
            return true;
        }
        return false;
    }
}
