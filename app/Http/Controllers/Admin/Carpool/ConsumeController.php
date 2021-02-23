<?php

namespace App\Http\Controllers\Admin\Carpool;

use App\Model\Sticky;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsumeController extends Controller
{
    public function index()
    {
        $data['stickies'] = Sticky::with('stickyable')->paginate(30);
        return view('admin.carpool.consume.index', $data);
    }
}
