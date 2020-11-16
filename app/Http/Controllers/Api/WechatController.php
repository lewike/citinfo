<?php

namespace App\Http\Controllers\Api;

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
}
