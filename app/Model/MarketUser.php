<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MarketUser extends Model
{
    protected $guarded = [];

    public static function findOrCreate($user)
    {
        if (! $marketUser = self::where('openid', $user->id)->first()) {
            $marketUser = self::Create([
                'openid' => $user->id,
                'nickname' => $user->nickname,
                'avatar' => $user->avatar
            ]);
        }

        return $marketUser;
    }
}
