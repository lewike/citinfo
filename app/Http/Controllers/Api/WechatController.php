<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    public function check()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = env('WECHAT_OFFICIAL_ACCOUNT_TOKEN');
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        return $_GET['echostr'];

        if ($tmpStr == $signature) {
            return $_GET['echostr'];
        } else {
            return 'false';
        }
    }

    public function handle(Request $request)
    {
        $app = app('wechat.official_account');
        $app->server->push(EventMessageHandler::class, Message::EVENT);
        return $app->server->serve();
    }
}
