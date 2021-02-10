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
}
