<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Carpool extends Model
{
    protected $guarded = [];

    protected $dates = ['start_at', 'sticky_expired_at'];

    public function type()
    {
        return $this->type == 'car' ? '车找人' : '人找车';
    }

    public function payStatus()
    {
        return $this->status == 'paid'? '已付款':'未付款';
    }

    public function createSticky($totalFee, $minutes, $user)
    {
        return $this->sticky()->save(new Sticky(['cost_fee' => $totalFee, 'minutes' => $minutes, 'user_id' => $user->id]));
    }

    public function setSticky($minutes)
    {
        $this->sticky = 1;
        $this->sticky_expired_at = Carbon::now()->addMinutes($minutes);
        $this->save();
    }    

    public function sticky()
    {
        return $this->morphMany(Sticky::class, 'stickyable');
    }

    public function sticking()
    {
        return $this->sticky == 1;
    }
}
