<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $dates = ['expired_at', 'refresh_at'];

    protected $casts = [
       'images' => 'array'
    ];

    public function url()
    {
        return '/post/'.$this->id;
    }

    public function scopeNormal($query)
    {
        return $query->whereIn('status', ['pending', 'published']);
    }

    public function scopeShow($query)
    {
        return $query->where('status', 'published');
    }

    public function getImagesAttribute($value)
    {
        $images = json_decode($value, true);
        if (is_array($images)) {
            return array_map(function ($image) {
                return env('CDN_URL').$image;
            }, $images);
        }
        return [];
    }

    public function getImages($size = null)
    {
        $images = json_decode($this->attributes['images'], true);
        if (is_array($images)) {
            return array_map(function ($i) use ($size) {
                if ($size) {
                    return env('IMG_URL').$i."!{$size}x{$size}";
                }
                return env('IMG_URL').$i;
            }, $images);
        }
        return [];
    }

    public function categoryId()
    {
        $categories = explode('/', $this->category_path);
        return end($categories);
    }

    public function expiredDays()
    {
        return $this->expired_at->diffInDays();
    }
}
