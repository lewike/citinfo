<?php

namespace App\Http\Controllers\Carpool;

use App\Model\User;
use App\Model\Config;
use App\Model\Carpool;
use App\Model\UserWallet;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id)
    {
        $data['carpool'] = Carpool::find($id);
        $data['app'] = app('wechat.official_account');
        $data['share'] = $this->shareInfo($data['carpool']);
        return view('carpool.post.show', $data);
    }

    private function shareInfo($carpool)
    {
        $type = $carpool->type == 'car'?'车找人':'人找车';
        $start = substr($carpool->start_at, 0, 16);
        $directions = $carpool->directions ? '途经'.$carpool->directions : '';
        $seat = $carpool->type == 'car'? $carpool->seat_cnt.'空位': $carpool->seat_cnt.'人';

        $info = [
            'title' => "【{$type}】{$carpool->direction_from} 到 {$carpool->direction_to}",
            'desc' => "{$type} {$carpool->direction_from} 到 {$carpool->direction_to} {$seat} {$start} 出发 {$directions}",
            'image' => '/images/pinche/carpool-'.$carpool->type.'.png'
        ];

        return $info;
    }

    public function create()
    {
        $data['app'] = app('wechat.official_account');
        return view('carpool.post.create', $data);
    }

    public function store(Request $request)
    {
        $wechatUser = session('wechat.oauth_user.default');
        $user = User::findByOpenId($wechatUser->id);

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'start_at' => 'required',
            'direction_from' => 'required',
            'direction_to' => 'required',
            'seat_cnt' => 'required',
            'phone' => 'required'
            ]);

        if ($validator->fails()) {
            return ['result' => false, 'message' => '请填写完整信息！'];
        }

        $data = $request->all();

        if ($data['type'] == 'car') {
            $data = Arr::only($data, ['type', 'start_at',
                'direction_from', 'direction_to', 'directions', 'car_type',
                'seat_cnt', 'additional', 'description', 'phone'
            ]);
        } else {
            $data = Arr::only($data, ['type', 'start_at',
            'direction_from', 'direction_to',
            'seat_cnt', 'additional', 'description', 'phone'
            ]);
        }

        $config = Config::value('carpool');

        if (! $user->isAdmin()) {
            $count = Carpool::where('user_id', $user->id)->where('start_at', '>', date('Y-m-d H:i:s'))->where('status', 'paid')->count();
            if ($count >= $config['max_free_publish_cnt']) {
                return ['result' => false, 'message' => '你还有'.$count.'条拼车信息没有到出发时间，请勿重复发布！'];
            }
        }
    
        $data['user_id'] = $user->id;
        $data['start_at'] .= ':00';
        $data['source'] = '微信';
        $data['ip'] = $request->ip();
        $data['status'] = 'paid';

        Carpool::create($data);
        
        return ['result' => true];
    }

    public function rule()
    {
        $data['config'] = Config::value('carpool');
        return view('carpool.post.rule', $data);
    }

    public function sticky(Request $request)
    {
        $wechatUser = session('wechat.oauth_user.default');
        $user = User::findByOpenId($wechatUser->id);

        $carpoolId = $request->get('id');
        $carpool = Carpool::find($carpoolId);

        if ($carpool->sticking()) {
            return  ['result' => false, 'message' => '当前正在置顶，请勿重复操作！'];
        }

        $minutes = $request->get('minutes');

        $totalFee = $request->get('total_fee');

        $config = Config::value('carpool');

        $stickyCost = explode(',', $config['sticky']);

        $stickyCheck = false;
        foreach($stickyCost as $cost) {
            $sticky = explode(':', $cost); 
            if ($sticky[1] == $totalFee && $sticky[2] == $minutes) {
                $stickyCheck = true;
            }
        }
        
        if (! $stickyCheck) {
            return ['result' => false, 'message' => '置顶金额与时间错误！'];
        }

        $userWallet = UserWallet::findByUser($user);
        if ($totalFee > $userWallet->total_amount) {
            return ['result' => false, 'message' => '余额不足，请充值！'];
        }

        $sticky = $carpool->createSticky($totalFee, $minutes, $user);
        $user->sticky($totalFee);
        $sticky->finish();

        return ['result' => true];
    }

    public function edit($id)
    {
        $wechatUser = session('wechat.oauth_user.default');
        $user = User::findByOpenId($wechatUser->id);
        $carpool = Carpool::find($id);
        if ($carpool->user_id == $user->id || $user->isAdmin()) {
            $data['carpool'] = $carpool;
            return view('carpool.post.edit', $data);
        }
        return '非法访问！';
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'start_at' => 'required',
            'direction_from' => 'required',
            'direction_to' => 'required',
            'seat_cnt' => 'required',
            'phone' => 'required'
            ]);

        if ($validator->fails()) {
            return ['result' => false, 'message' => '请填写完整信息！'];
        }
        
        if (! $carpool = Carpool::find($id)) {
            return ['result' => false, 'message' => '没有找到该信息'];
        }

        $wechatUser = session('wechat.oauth_user.default');
        $user = User::findByOpenId($wechatUser->id);
        if ($carpool->user_id != $user->id && !$user->isAdmin()) {
            return ['result' => false, 'message' => '你没有权限修改该信息！'];
        }
        
        if ($carpool->start_at->isPast()) {
            return ['result' => false, 'message' => '拼车信息已经失效！'];
        }
        
        if ($carpool->type == 'car') {
            $data = $request->only(['start_at',
                'direction_from', 'direction_to', 'directions', 'car_type',
                'seat_cnt', 'additional', 'description', 'phone'
            ]);
        } else {
            $data = $request->only(['start_at',
            'direction_from', 'direction_to',
            'seat_cnt', 'additional', 'description', 'phone'
            ]);
        }
        if (strlen($data['start_at']) == 16) {
            $data['start_at'] .= ':00';
        }
        $carpool->update($data);
        return ['result' => true];
    }

    public function delete($id)
    {
        $wechatUser = session('wechat.oauth_user.default');
        $user = User::findByOpenId($wechatUser->id);
        
        $data['carpool'] = Carpool::find($id);
        if ($data['carpool']->user_id == $user->id || $user->isAdmin()) {
            Carpool::destroy($id);
            return ['result' => true];
        }
        return '非法访问！';
    }
}
