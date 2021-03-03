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

        $welcome = '';

        if ($payload['Event'] == 'subscribe') {
            $welcome = '感谢你的关注！'."\r\n\r\n".'我们已经等你很久了，希望我们能给你帮点小忙！';
            $payload['EventKey'] = Str::after($payload['EventKey'], 'qrscene_');
        }
        if ($payload['Event'] == 'SCAN') {
            $welcome = '扫码成功！';
        }

        if (Str::start($payload['EventKey'], 'create-post')) {
            $welcome .= "\r\n\r\n".'你的信息正在提交，需要经过审核后才能显示！'."\r\n\r\n".'如需快速审核，请联系客服！';
        }

        if (Str::start($payload['EventKey'], 'edit-post')) {
            $welcome .= "\r\n\r\n".'你的信息正在更新中...';
        }

        Cache::put('openid:'.$payload['EventKey'], $openId, 1800);
        return $welcome;
    }
}
