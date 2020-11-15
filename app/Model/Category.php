<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function posts()
    {
        return Post::where('category_path', 'like', $this->path.'%');
    }

    public static function tree($status = null)
    {
        if ($status) {
            $categories = Category::where('status', $status)->get();
        } else {
            $categories = Category::get();
        }
        $categoryTree = [];
        foreach ($categories as $category) {
            if ($category['p_id']) {
                $categoryTree[$category['p_id']]['child'][] = $category;
            } else {
                $categoryTree[$category['m_id']]['data'] = $category;
            }
        }
        return $categoryTree;
    }
    
    public static function treeArray($status = null)
    {
        if ($status) {
            $categories = Category::where('status', $status)->get();
        } else {
            $categories = Category::get();
        }
        $categoryTree = [];
        foreach ($categories as $category) {
            if ($category['p_id']) {
                $categoryTree[$category['p_id']]['child'][] = $category;
            } else {
                $categoryTree[$category['m_id']]['data'] = $category;
            }
        }

        $treeArray = [];

        foreach($categoryTree as $category) {
            $treeArray[] = $category['data'];
            foreach($category['child'] as $subCategory) {
                $treeArray[] = $subCategory;
            }
        }
        
        return $treeArray;
    }

    public function subCategories()
    {
        return Category::where('p_id', $this->m_id);
    }

    public function parent()
    {
        return Category::where('m_id', $this->p_id)->first();
    }
}
