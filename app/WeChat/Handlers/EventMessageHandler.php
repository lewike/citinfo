<?php

namespace App\WeChat\Handlers;

use Str;
use Cache;
use \EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class EventMessageHandler implements EventHandlerInterface
{
    public function handle($payload = null)
    {
        $openId = $payload['FromUserName'];

        if ($payload['Event'] == 'subscribe') {
            Cache::put('user-openid-'.Str::after($payload['EventKey'], 'qrscene_'), $openId, 1800);
            return ;
        }

        if ($payload['Event'] == 'SCAN') {
            Cache::put('user-openid-'.$payload['EventKey'], $openId, 1800);
            return ;
        }
    }
}
