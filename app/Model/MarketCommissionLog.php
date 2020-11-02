<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MarketCommissionLog extends Model
{
    protected $guarded = [];

    public static function getOrderSn()
    {
        return date('YmdHis', time()) . substr(implode(null, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
}
