<?php

namespace App\Http\Controllers\Api;

use Cache;
use EasyWeChat\Factory;
use App\Model\Payment;
use App\Model\WechatMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Kernel\Messages\Message;
use App\WeChat\Handlers\EventMessageHandler;

class WechatController extends Controller
{
    public function check()
    {
        $signature = $_GET["signature"] ?? '';
        $timestamp = $_GET["timestamp"] ?? '';
        $nonce = $_GET["nonce"] ?? '';

        $token = env('WECHAT_OFFICIAL_ACCOUNT_TOKEN');
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return $_GET['echostr'] ?? '';
        } else {
            return 'false';
        }
    }

    public function handle()
    {
        $app = app('wechat.official_account');
        $app->server->push(EventMessageHandler::class, Message::EVENT);
        return $app->server->serve();
    }

    public function getUser()
    {
        $code = request()->code;
        $user = Cache::get($code);
        return ['result' => true, 'data' => $user];
    }

    public function payment(Request $request)
    {
        $app = Factory::payment([
            'app_id' => env('WPAY_APPID'),
            'mch_id' => env('WPAY_MCHID'),
            'key' => env('WPAY_KEY'),
        ]);

        $response = $app->handlePaidNotify(function($message, $fail) use ($app) {
            $payment = Payment::where('order_id', $message['out_trade_no'])->first();
            if (!$payment || $payment->paid_at) { 
                return true;
            }

            $result = $app->order->queryByOutTradeNumber($message['out_trade_no']);

            if ($result['trade_state'] !== 'SUCCESS') {
                info('Warning: 交易状态异常，请及时检查', ['data' => [$result, $message]]);
                return true;
            }

            if ($message['return_code'] === 'SUCCESS') { 
                if ($message['result_code'] === 'SUCCESS') {
                    if ((int)$message['total_fee'] !== $payment->total_fee) {
                        info('Warning: 交易金额不一致，请及时检查', ['data' => $message]);
                        return true;
                    }
                    $payment->paid($message['out_trade_no'], $message['transaction_id']);
                } elseif (array_get($message, 'result_code') === 'FAIL') {
                    $payment->status = 'paid_fail';
                    $payment->save();
                }
            } else {
                return $fail('通信失败，请稍后再通知我');
            }
            return true;
        });
        return $response;
    }

    public function hookMsg(Request $request)
    {
        $content = (string)$request->get("data");
        $msg = json_decode($content, true);
        info($msg);
        if ($msg['id2'] == 'dai-dongsheng') {
            
        }
        if (! $msg['id1']) {
            $wxRoom = WechatRoom::findByRoomId($msg['id2']);
            if (! $wxRoom) {
                WechatRoom::addRoom($msg['id2']);
            }
            if ($msg['id1'] == 'dai-dongsheng') {
                $wxRoom->name = '已标记';
                $wxRoom->save();
            }
        }
    }

    public function getTask()
    {
        $msg = WechatMessage::getMsg();
        $msg->send();
        return ['result' => 'true', 'receiver_id' => $msg->receiver_id, 'content' => $msg->content, 'type' => $msg->type];
    }
}
