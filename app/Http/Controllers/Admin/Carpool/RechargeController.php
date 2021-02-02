<?php

namespace App\Http\Controllers\Admin\Carpool;

use Carbon\Carbon;
use App\Model\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RechargeController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startWeek = $now->startOfWeek()->format('Y-m-d H:i:s');
        $endWeek = $now->endOfWeek()->format('Y-m-d H:i:s');
        $startToday = $now->format('Y-m-d 00:00:00');
        $endToday = $now->format('Y-m-d 23:59:59');
        $startMonth = $now->format('Y-m-01 00:00:00');
        $endMonth = $now->format('Y-m-31 23:59:59');
        $data['month'] = Payment::whereBetween('created_at', [$startMonth, $endMonth])->where('status', 'paid')->sum('total_fee');
        $data['week'] = Payment::whereBetween('created_at', [$startWeek, $endWeek])->where('status', 'paid')->sum('total_fee');
        $data['today'] = Payment::whereBetween('created_at', [$startToday, $endToday])->where('status', 'paid')->sum('total_fee');
        $data['payments'] = Payment::latest()->paginate(20);
        $data['typeMap'] = ['stick' => '置顶', 'publish' => '发布', 'carpool' => '拼车'];
        $data['orderTypeMap'] = ['carpool' => '拼车'];
        $data['statusMap'] = ['unpaid' => '未付款', 'cancle' => '已取消', 'close' => '已关闭', 'paid' => '已付款']; 
        return view('admin.carpool.recharge.index', $data);
    }
}
