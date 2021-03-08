<?php

namespace App\Http\Controllers\Website\Weixin;

use App\Model\User;
use App\Model\Post;
use App\Model\File;
use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        return view('website.weixin.user.index');
    }
}
