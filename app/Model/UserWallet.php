<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public static function findByUser($user)
    {
        $userWallet = self::where('user_id', $user->id)->first();
        if (! $userWallet) {
            $userWallet = self::create(['user_id' => $user->id]);
        }
        return $userWallet;
    }

    public function recharge($payment)
    {
        $amount = $payment->getAmount();
        $gift = $payment->getGift();
        $payment->userWalletLog()->save(new UserWalletLog([
            'user_id' => $this->user_id,
            'before_total_amount' => $this->total_amount,
            'before_actual_amount' => $this->actual_amount,
            'before_gift_amount' => $this->gift_amount,
            'after_total_amount' => $this->total_amount + $amount + $gift,
            'after_actual_amount' => $this->actual_amount + $amount,
            'after_gift_amount' => $this->gift_amount + $gift,
        ]));

        $this->total_amount = $this->total_amount + $amount + $gift;
        $this->actual_amount = $this->actual_amount + $amount;
        $this->gift_amount = $this->gift_amount + $gift;
        $this->save();
    }

    public function consume($consume)
    {
        $amount = $consume->getAmount();
        $actual = $amount;
        $gift = 0;
        if ($this->actual_amount < $amount) {
            $actual = $this->actual_amount;
            $gift = $amount - $actual;
        }
        $consume->userWalletLog()->save(new UserWalletLog([
            'user_id' => $this->user_id,
            'type' => 'out',
            'before_total_amount' => $this->total_amount,
            'before_actual_amount' => $this->actual_amount,
            'before_gift_amount' => $this->gift_amount,
            'after_total_amount' => $this->total_amount - $amount,
            'after_actual_amount' => $this->actual_amount - $actual,
            'after_gift_amount' => $this->gift_amount - $gift,
        ]));

        $this->total_amount = $this->total_amount - $amount;
        $this->actual_amount = $this->actual_amount - $actual;
        $this->gift_amount = $this->gift_amount - $gift;
        $this->save();
    }
}
