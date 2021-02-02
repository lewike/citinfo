@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
            充值记录
        </h2>
      </div>
    </div>
  </div>
  <div class="row row-deck row-cards">
    <div class="col-lg-12">
      <div class="card">
        <table class="table card-table table-vcenter">
            <thead>
                <tr>
                    <th width="70">订单id</th>
                    <th width="70">订单类型</th>
                    <th width="70">订单目标</th>
                    <th width="70">订单目标id</th>
                    <th width="100">描述</th>
                    <th width="100">付款人</th>
                    <th width="100">付款金额</th>
                    <th width="100">付款状态</th>
                    <th width="100">交易单号</th>
                    <th width="100">预支付编号</th>
                    <th width="100">付款渠道</th>
                    <th width="130">付款时间</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                <tr>
                <td>{{$payment->order_id}}</td>
                <td>{{$typeMap[$payment->order_type] ?? '-'}}</td>
                <td>{{$orderTypeMap[$payment->order_object_type] ?? '-'}}</td>
                <td>{{$payment->order_object_id}}</td>
                <td>{{$payment->desc}}</td>
                <td>{{$payment->open_id}}</td>
                <td>￥ {{number_format($payment->total_fee/100, 2, '.', '')}}</td>
                <td>{{$statusMap[$payment->status] ?? ''}}</td>
                <td>{{$payment->transaction_id}}</td>
                <td>{{$payment->prepay_id}}</td>
                <td>{{$payment->pay_type}}</td>
                <td>{{$payment->paid_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($payments->hasMorePages())
        <div class="card-footer">
          {{ $payments->links() }}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection