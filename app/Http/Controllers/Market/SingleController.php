<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MarketUser;
use App\Model\Market;
use App\Model\MarketShareView;
use App\Model\MarketOrder;
use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Image;

class SingleController extends Controller
{
    public function show($marketId, Request $request)
    {
        $user = session('wechat.oauth_user.default');
        $currentUser = MarketUser::findOrCreate($user);
        
        $source = explode('_', $request->get('source', '0_0'));
        $shareUser = null;
        if (is_array($source) && count($source) == 2 && $source[0] == $marketId) {
            $shareUser = MarketUser::find($source[1]);
            session(['share_user_id' => $source[1]]);
        } 

        $market = Market::find($marketId);
        if ($market->hasViewCommission()) {
            if (! MarketShareView::exists($currentUser, $market)) {
                list($result, $memo) = $this->checkUser($shareUser);
    
                MarketShareView::create([
                    'market_id' => $marketId,
                    'share_user_id' => $shareUser ? $shareUser->id : 0,
                    'view_user_id' => $currentUser->id,
                    'commission' => $result ? 0.3 : 0,
                    'ip' => $request->ip(),
                    'memo' => $memo
                ]); 
            }
        }
        $data['app'] = \EasyWeChat::officialAccount();
        $data['market'] = $market;

        $market->increment('view_count');

        return view('market.single.show', $data);
    }


    public function order(Request $request)
    {
        $user = session('wechat.oauth_user.default');
        $currentUser = MarketUser::findOrCreate($user);
        $market = Market::find($request->get('market_id'));
        $options = [
            'phone' => $request->get('phone', ''),
            'share_user_id' => session('share_user_id', 0)
        ];
        $order = MarketOrder::newOrder($market, $currentUser, $options);
        
        $app = \EasyWeChat::payment();
        
        $result = $app->order->unify([
            'body' => '支付',
            'out_trade_no' => $order->trade_no,
            'total_fee' => $order->price,
            'notify_url' => 'https://pay.weixin.qq.com/wxpay/pay.action', 
            'trade_type' => 'JSAPI',
            'openid' => $currentUser->openid,
        ]);

        if ($result['return_code'] === 'SUCCESS') {
            return ['result' => false];
        }

        return ['result' => true, 'data' => $app->jssdk->sdkConfig($result[''])];
    }

    public function buy()
    {
        return '';
    }

    public function payment()
    {
        
    }

    //核销订单
    public function consume()
    {
        
        return '';        
    }

    public function share()
    {
        $app = \EasyWeChat::officialAccount();
        $res = $app->url->shorten('https://gift.zaixixian.com/market/single/1?source=1_1');
        if ($res['errcode'] === 0) {
            $url = $res['short_url'];
            $qrCode = new QrCode($url);
            $bgImage = 'http://giftadmin.chengzi001.cn/image/20200509/1589017697533266.png';
            $image = Image::make()->insert($qrCode->writeDataUri());
        }

        $image->save(storage_path().'/1.jpg');

        return response()->download(storage_path().'/1.jpg');
        
        // return view('market.single.share');
    }

    private function checkUser($user)
    {
        if (!$user) {
            return [false, '分享人不存在'];
        }
        if ($user->isBan()) {
            return [false, '分享人在黑名单中'];
        }
        $shareCount = MarketShareView::where('share_user_id', $user->id)->whereDate('created_at', Carbon::today())->count();

        if ($shareCount > 10) {
            return [false, '今日分享次数超过限制'];
        }
        return [true, ''];
    }

    private function commission($marketPayment)
    {
        $app = \EasyWeChat::payment();

        $tradeNo = MarketCommissionLog::getOrderSn();

        $result = $app->transfer->toBalance([
            'partner_trade_no' => $tradeNo,
            'openid' => $marketPayment->getOpenId(),
            'check_name' => 'NO_CHECK', // NO_CHECK：不校验真实姓名, FORCE_CHECK：强校验真实姓名
            'amount' => $marketPayment->getCommissonAmount(),
            'desc' =>  $marketPayment->getDesc(),
        ]);

        if ($result) { //支付成功
            $marketPayment->PaidCommisson();
            MarketCommissionLog::create([]);
        }
    }
}
