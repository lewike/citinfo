@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
            相亲会员
        </h2>
      </div>
      <div class="col-auto ml-auto d-print-none">
        <a href="{{route('admin.wed.member.create')}}" class="btn btn-primary btn-sm ml-3 d-none d-sm-inline-block">
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
              <th>编号</th>
              <th>姓名</th>
              <th>性别</th>
              <th>年龄</th>
              <th>有车</th>
              <th>有房</th>
              <th>会员</th>
              <th>职业</th>
              <th>备注</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($members as $member)
              <tr>
                <td>{{$member['id']}}</td>
                <td>{{$member['name']}}</td>
                <td>{{$member['gender']}}</td>
                <td>{{$member['age']}}</td>
                <td>{{$member['car']}}</td>
                <td>{{$member['house']}}</td>
                <td>{{$member['vip_level']}}</td>
                <td>{{$member['job']}}</td>
                <td>{{$member['note']}}</td>
                <td><a href="/admin/wed/member/edit/{{$member['id']}}">编辑</a> <a href="">隐藏</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection