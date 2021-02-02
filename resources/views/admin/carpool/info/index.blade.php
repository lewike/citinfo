@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
            拼车信息
        </h2>
      </div>
      <div class="col-auto ml-auto d-print-none">
        <a href="/admin/pinche/info/create" class="btn btn-primary btn-sm ml-3 d-none d-sm-inline-block">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="22" height="22" viewBox="0 0 20 20"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z"></path>
            <line x1="11" y1="5" x2="11" y2="17"></line>
            <line x1="5" y1="11" x2="17" y2="11"></line>
          </svg>
          添加
        </a>
      </div>
    </div>
  </div>
  <div class="row row-deck row-cards">
    <div class="col-lg-12">
      <div class="card">
        <table class="table card-table table-vcenter">
            <thead>
                <tr>
                    <th width="60">编号</th>
                    <th width="70">拼车类型</th>
                    <th width="70">出发地</th>
                    <th width="70">目的地</th>
                    <th width="70">途经地</th>
                    <th width="100">出发时间</th>
                    <th width="100">补充</th>
                    <th width="100">座位/人数</th>
                    <th width="100">车型</th>
                    <th width="100">电话</th>
                    <th width="60">拨打数</th>
                    <th width="80">ip</th>
                    <th width="50">渠道</th>
                    <th width="50">是否付款</th>
                    <th width="50">是否置顶</th>
                    <th width="100">发布时间</th>
                    <th width="130">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carpools as $carpool)
                <tr>
                <td>{{$carpool->id}}</td>
                <td>{{$carpool->type()}}</td>
                <td>{{$carpool->direction_from}}</td>
                <td>{{$carpool->direction_to}}</td>
                <td>{{$carpool->directions ?? '-'}}</td>
                <td>{{$carpool->start_at}}</td>
                <td>{{$carpool->additional ?? '-'}}</td>
                <td>{{$carpool->seat_cnt}}</td>
                <td>{{$carpool->car_type ?? '-'}}</td>
                <td>{{$carpool->phone}}</td>
                <td>{{$carpool->call_cnt}}</td>
                <td>{{$carpool->ip ?? '-'}}</td>
                <td>{{$carpool->source}}</td>
                <td>{{$carpool->payStatus()}}</td>
                <td>
                    {{$carpool->is_stick? '是':'否'}}
                    {{$carpool->stick_expired_at}}
                </td>
                <td>{{$carpool->created_at}}</td>
                <td><a href="javascript:;" data-id="{{$carpool->id}}" class="btn-delete-carpool">删除</a> <a href="/admin/pinche/edit/{{$carpool->id}}">修改</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($carpools->hasMorePages())
        <div class="card-footer">
          {{ $carpools->links() }}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection