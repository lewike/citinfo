@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
          用户管理
        </h2>
      </div>
      <div class="col-auto ml-auto d-print-none">
        <a href="{{route('admin.post.create')}}" class="btn btn-primary btn-sm ml-3 d-none d-sm-inline-block">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="22" height="22" viewBox="0 0 20 20"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z"></path>
            <line x1="11" y1="5" x2="11" y2="17"></line>
            <line x1="5" y1="11" x2="17" y2="11"></line>
          </svg>
          新建
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
            <th>昵称</th>
            <th>邮箱</th>
            <th>微信用户</th>
            <th>手机号</th>
            <th>手机认证</th>
            <th>注册时间</th>
            <th>上次登录时间</th>
            <th>状态</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td>{{$user['id']}}</td>
            <td>{{$user['name']}}</td>
            <td>{{$user['email']}}</td>
            <td>{{$user['wechat_openid']}}</td>
            <td>{{$user['phone']}}</td>
            <td>{{$user['phone_verified_at'] ?? '未认证'}}</td>
            <td>{{$user['created_at']}}</td>
            <td>{{$user['last_login_at']}}</td>
            <td>{{$user['status']}}</td>
            <td>限制</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @if ($users->hasMorePages())
      <div class="card-footer">
        {{ $users->links() }}
      </div>
      @endif
      </div>
    </div>
  </div>
</div>
@endsection