<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $guarded = [];

    protected $casts = [
        'value' => 'array',
    ];

    public static function value($name = 'wed')
    {
        $config = self::where('name', $name)->first();
        return $config->value ?? [];
    }
}
