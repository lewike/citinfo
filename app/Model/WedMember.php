<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WedMember extends Model
{
    protected $guarded = [];

    protected $casts = [
        'images' => 'array'
    ];

    public function getGenderCnAttribute()
    {
        $value = $this->attributes['gender'];
        $genderMap = [1 => '男', 2 => '女'];
        return $genderMap[$value];
    }

    public function getMarryCnAttribute()
    {
        $value = $this->attributes['marry'];
        $marryMap = [1 => '未婚', 2 => '离异', 3 => '丧偶'];
        return $marryMap[$value];
    }

    public function getIncomeCnAttribute()
    {
        $value = $this->attributes['income'];
        $incomeMap = [2 => '2000以下', 4 => '2000-4000', 6 => '4000-6000', 10 => '6000-10000', 20 => '10000-20000', 21 => '20000以上'];
        return $incomeMap[$value];
    }

    public function needCompleted()
    {
        return !$this->name || !$this->avatar;
    }
}
