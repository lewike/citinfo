<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MarketShareView extends Model
{
    protected $guarded = [];

    public static function exists($user, $market)
    {
        return self::where('market_id', $market->id)->where('view_user_id', $user->id)->exists();  
    }
}
