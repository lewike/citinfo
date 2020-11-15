<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::treeArray();
        return view('admin.cate.index', $data);
    }

    public function create()
    {
        $categories = Category::where('p_id', 0)->get();
        return view('admin.cate.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        return response()->json(['result' => true]);
    }
}
