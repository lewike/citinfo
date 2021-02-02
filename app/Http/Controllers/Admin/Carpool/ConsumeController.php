<?php

namespace App\Http\Controllers\Admin\Carpool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsumeController extends Controller
{
    public function index()
    {
        return view('admin.carpool.consume.index');
    }
}
