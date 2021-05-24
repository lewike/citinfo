<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WechatMessage extends Model
{
    protected $guarded = [];
    
    public static function getMsg()
    {
        return self::whereIsNull('send_at')->oldest('id')->first();
    }

    public function send()
    {
        $this->send_at = date('Y-m-d H:i:s');
        $this->save();
    }
}
