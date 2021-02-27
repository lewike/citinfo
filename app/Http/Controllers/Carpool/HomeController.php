<?php

namespace App\Http\Controllers\Carpool;

use App\Model\Carpool;
use App\Model\Config;
use App\Model\Payment;
use App\Model\UserWallet;
use App\Model\User;
use EasyWeChat\Factory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data['config'] = Config::value('carpool');
        $query = Carpool::query();
        if ($type = $request->get('type')) {
            $query = $query->where('type', $type);
        }
        $query = $query->where('start_at', '>', date('Y-m-d H:i:s'))->where('status', 'paid');
        $from = $request->get('direction_from');
        $to = $request->get('direction_to');

        $data['direction_from'] = $from;
        $data['direction_to'] = $to;
        if ($to && $from) {
            $query = $query->where('direction_from', 'like', '%'.$from.'%')->where(function ($query) use ($to) {
                $query->where('direction_to', 'like', '%'.$to.'%')
                    ->orWhere('directions', 'like', '%'.$to.'%');
            });
        }

        $query = $query->orderBy('sticky', 'DESC');

        if ($sort = $request->get('sort', 'created')) {
            $order = 'DESC';
            if ($sort == 'start') {
                $order = 'ASC';
            }
            $query = $query->orderBy($sort.'_at', $order);
        }
        $data['carpools'] = $query->get();

        $hotways = explode(',', $data['config']['hotways']);
        $data['config']['hotways'] = [];
        foreach($hotways as $hotway) {
            $way = explode('-', $hotway);
            $data['config']['hotways'][] = [
                'from' => $way[0],
                'to' => $way[1],
            ];
        }
        return view('carpool.home.index', $data);
    }

    public function user()
    {
        $data['app'] = app('wechat.official_account');
        $authUser = session('wechat.oauth_user.default');
        $user = User::findByOpenId($authUser->id);
        if ($user->isAdmin()) {
            $data['carpools'] = Carpool::where('status', '!=', 'unpaid')->latest()->get();
        } else {
            $data['carpools'] = Carpool::where('user_id', $user->id)->where('status', '!=', 'unpaid')->latest()->get();
        }
        $config = Config::value('carpool');
        $sticky = explode(',', $config['sticky']);
        foreach($sticky as $stick) {
            $cost = explode(':', $stick);
            $data['sticky_cost'][] = [
                'label' => $cost[0],
                'value' => $cost[1],
                'minutes' => $cost[2],
            ];
        }

        $recharge = explode(',', $config['recharge']);
        foreach($recharge as $item) {
            $cost = explode(':', $item);
            $data['recharge'][] = [
                'label' => $cost[0],
                'value' => $cost[1],
                'gift' => $cost[2],
            ];
        }
        $data['userWallet'] = UserWallet::findByUser($user);
        return view('carpool.home.user', $data);
    }

    public function recharge(Request $request)
    {
        $data = $request->only(['recharge_amount', 'gift_amount']);

        $wechatUser = session('wechat.oauth_user.default');
        $user = User::findByOpenId($wechatUser->id);

        $app = Factory::payment([
            'app_id' => env('WPAY_APPID'),
            'mch_id' => env('WPAY_MCHID'),
            'key' => env('WPAY_KEY'),
        ]);
        $rechargeAmount = number_format($data['recharge_amount']/100, 2);
        $giftAmount = number_format($data['gift_amount']/100, 2);
        $desc = '充值金额:'.$rechargeAmount.'元-赠送金额:'.$giftAmount.'元';

        if (! $payment = Payment::createRecharge($desc, $user, $data['recharge_amount'], $data['gift_amount'])) {
            return ['result' => false, 'message' => '订单生成失败，请稍后重试！'];
        }

        $result = $app->order->unify([
            'body' => '用户充值-'.$desc.'-#'.$payment->order_id,
            'out_trade_no' => $payment->order_id,
            'total_fee' => $data['recharge_amount'],
            'notify_url' => env('WPAY_NOTIFY_URL', env('APP_URL').'/api/wechat/payment'),
            'trade_type' => 'JSAPI',
            'openid' => $user->wechat_open_id,
        ]);

        if ($result['return_msg'] !== 'OK') {
            $payment->delete();
            return ['result' => false, 'message' => '支付生成失败，请重试！'];
        }

        $payment->prepay_id = $result['prepay_id'];
        $payment->save();
        $config = $app->jssdk->sdkConfig($result['prepay_id']);
        return ['result' => true, 'data' => $config];
    }

    public function call($id)
    {
        $carpool = Carpool::find($id);
        $carpool->call_cnt++;
        $carpool->save();
    }
}
