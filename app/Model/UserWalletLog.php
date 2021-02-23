<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserWalletLog extends Model
{
    protected $guarded = [];

    public function relation()
    {
        return $this->morphTo();
    }
}
