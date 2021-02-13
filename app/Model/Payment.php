<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    protected $dates = ['paid_at'];

    public static function createRecharge($desc, $user, $amount, $giftAmount)
    {
        $orderId = '10'.date('ymdH').substr(microtime(), -4).str_pad(mt_rand(1,99999), 5, '0', STR_PAD_LEFT);
        return self::create([
            'order_id' => $orderId,
            'user_id' => $user->id,
            'order_type' => 'recharge',
            'desc' => $desc,
            'total_fee' => $amount,
            'gift_fee' => $giftAmount,
        ]);
    }

    public function paid($outTradeNo, $transactionId = null)
    {
        if ($this->status == 'paid') {
            return false;
        }
        $this->transaction_id = $transactionId ? $transactionId : '';
        $this->paid_at = date('Y-m-d H:i:s');
        $this->status = 'paid';
        $this->save();

        if ($this->order_type == 'recharge') {
            $user = User::find($this->user_id);
            $user->rechargeWallet($this->total_fee, $this->gift_fee);
        }
    }
}
