<?php

namespace App\Http\Controllers\Admin\Carpool;

use App\Model\Carpool;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index()
    {
        $data['carpools'] = Carpool::latest()->paginate(30);
        return view('admin.carpool.info.index', $data);
    }

    public function create()
    {
        return view('admin.carpool.info.create');
    }

    public function save(Request $request)
    {
        return ['result' => true];
    }
}
