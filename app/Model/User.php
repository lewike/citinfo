<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'wechat_openid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return !!$this->is_admin;
    }
    
    public function isWedMember()
    {
        $wedMemer = WedMember::where('user_id', $this->id)->first();
        return $wedMemer && $wedMemer->needCompleted();
    }

    public static function findByOpenId($openId)
    {
        if (!$user = self::where('wechat_open_id', $openId)->first()) {
            $user = self::create([
                'name' => $openId,
                'email' => $openId.'@zaixixian.com',
                'password' => 'none',
                'wechat_open_id' => $openId
            ]);
        }
        return $user;
    }

    public function rechargeWallet($amount, $gift)
    {
        $wallet = UserWallet::findByUser($this);
        $wallet->recharge($amount, $gift);
    }
}
