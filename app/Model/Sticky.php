<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sticky extends Model
{
    protected $guarded = [];

    protected $dates = ['finished_at'];

    public function stickyable()
    {
        return $this->morphTo();
    }

    public function finish()
    {
        $this->finished_at = date('Y-m-d H:i:s');
        $this->status = 'finish';
        $this->save();
        
        $sticky = $this->stickyable;

        $sticky->setSticky($this->minutes);
    }

    public function userWalletLog()
    {
        return $this->morphOne(UserWalletLog::class, 'relation');
    }

    public function getAmount()
    {
        return $this->cost_fee;
    }
}
