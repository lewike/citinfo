@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
           置顶记录
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
                    <th width="70">置顶目标</th>
                    <th width="70">置顶时间</th>
                    <th width="70">消费金额</th>
                    <th width="70">状态</th>
                    <th width="70">置顶人</th>
                    <th width="70">置顶开始时间</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stickies as $sticky)
                <tr>
                <td><a href="/pinche/show/{{$sticky->stickyable_id}}">拼车{{$sticky->stickyable_id}}</a></td>
                <td>{{$sticky->minutes}}</td>
                <td>{{$sticky->cost_fee}}</td>
                <td>{{$sticky->status}}</td>
                <td>{{$sticky->user_id}}</td>
                <td>{{$sticky->finished_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($stickies->hasMorePages())
        <div class="card-footer">
          {{ $stickies->links() }}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection