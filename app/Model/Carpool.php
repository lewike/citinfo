<?php

namespace App\Model;

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
}
