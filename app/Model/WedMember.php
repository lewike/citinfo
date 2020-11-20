<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WedMember extends Model
{
    protected $guarded = [];

    protected $casts = [
        'images' => 'array'
    ];

    public function getGenderAttribute($value)
    {
        $genderMap = [1 => '男', 2 => '女'];
        return $genderMap[$value];
    }

    public function getMarryAttribute($value)
    {
        $marryMap = [1 => '未婚', 2 => '离异', 3 => '丧偶'];
        return $marryMap[$value];
    }
}
