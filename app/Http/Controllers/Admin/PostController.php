<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.post.index');
    }

    public function create()
    {
        $data['categories'] = Category::treeArray();
        return view('admin.post.create', $data);
    }
}
