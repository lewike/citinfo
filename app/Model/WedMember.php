<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WedMember extends Model
{
    protected $guarded = [];

    protected $casts = [
        'images' => 'array'
    ];
}
