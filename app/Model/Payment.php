<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public static function createRecharge($desc, $user, $amount)
    {
        $orderId = '10'.date('ymdH').substr(microtime(), -4).str_pad(mt_rand(1,99999), 5, '0', STR_PAD_LEFT);
        return self::create([
            'order_id' => $orderId,
            'user_id' => $user->id,
            'desc' => $desc,
            'total_fee' => $amount
        ]);
    }
}
