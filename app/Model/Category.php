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

    public static function tree()
    {
        $categories = Category::where('status', 'normal')->get();
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
    
    public static function treeArray()
    {
        $categories = Category::where('status', 'normal')->orderBy('path')->orderBy('weight')->get('path');

        foreach($categories as $category) {
            $treeArray[] = [];
        }
        return $categories;
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
