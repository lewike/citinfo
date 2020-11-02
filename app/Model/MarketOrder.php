<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MarketOrder extends Model
{
    protected $guarded = [];

    public static function getOrderSn()
    {
        return date('YmdHis', time()) . substr(implode(null, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

    public static function newOrder($market, $user, $options = [])
    {
        return self::create([
            'market_id' => $market->id,
            'buy_user_id' => $user->id,
            'order_no' => self::getOrderSn(),
            'price' => $market->price,
            'commssion' => $market->commission,
            'phone' => isset($options['phone']) ? $options['phone'] : '',
            'share_user_id' => isset($options['share_user_id']) ? $options['share_user_id'] : '',
        ]);
    }
}
