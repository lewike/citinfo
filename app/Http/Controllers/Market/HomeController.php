<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MarketUser;
use App\Model\Market;
use App\Model\MarketShareView;
use App\Model\MarketOrder;
use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Image;

class HomeController extends Controller
{
    public function index()
    {
        return view('market.home.index');
    }

    public function orders()
    {
        return view('market.home.orders');
    }
}