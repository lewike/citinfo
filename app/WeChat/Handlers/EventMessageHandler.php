<?php

namespace App\WeChat\Handlers;

use Str;
use Cache;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class EventMessageHandler implements EventHandlerInterface
{
    public function handle($payload = null)
    {
        $openId = $payload['FromUserName'];

        if ($payload['Event'] == 'subscribe') {
            Cache::put('wechat-code'.Str::after($payload['EventKey'], 'qrscene_'), $openId, 1800);
            return '欢迎，感谢你的关注！';
        }

        if ($payload['Event'] == 'SCAN') {
            Cache::put('wechat-code'.$payload['EventKey'], $openId, 1800);
            return '恭喜，扫描成功！';
        }
    }
}
