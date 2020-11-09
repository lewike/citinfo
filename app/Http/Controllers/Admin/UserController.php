<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::paginate(30);
        return view('admin.user.index', $data);
    }
}
