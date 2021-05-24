<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WechatRoom extends Model
{
    protected $guarded = [];

    public static function findByRoomId($roomId)
    {
        return self::where('roomid', $roomId)->first();
    }

    public static function addRoom($roomId)
    {
        return self::create([
            'roomid' => $roomId,
            'name' => '未命名'
        ]);
    }
}
