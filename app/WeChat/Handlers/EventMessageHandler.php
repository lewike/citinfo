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
            if (! $payload['EventKey']) {
                return '欢迎，等你很久了，感谢你的关注！';
            }
            $wechatCode = Str::after($payload['EventKey'], 'qrscene_');
            
            Cache::put('wechat-code'.$wechatCode, $openId, 1800);
            
            if (Str::start($wechatCode, 'createPost')) {
                return '欢迎，感谢你的关注！你的信息正在提交，需要经过审核后才能显示！';
            }
        }

        if ($payload['Event'] == 'SCAN') {
            if (! $payload['EventKey']) {
                return '扫码成功，欢迎你访问公众号！';
            }
            
            Cache::put('wechat-code'.$payload['EventKey'], $openId, 1800);

            if (Str::start($payload['EventKey'], 'createPost')) {
                return '扫码成功，你的信息正在提交，需要经过审核后才能显示！';
            }
        }
    }
}
