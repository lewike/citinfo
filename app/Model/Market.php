<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $guarded = [];

    public function hasViewCommission()
    {
        return true;
    }
}
