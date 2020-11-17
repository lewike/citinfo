@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
          分类信息
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
              <th>分类</th>
              <th>标题</th>
              <th>联系方式</th>
              <th>过期时间</th>
              <th>首页置顶</th>
              <th>栏目置顶</th>
              <th>浏览量</th>
              <th>发布时间</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
            <tr>
              <td>{{$post['id']}}</td>
              <td>{{$post->category()->name}}</td>
              <td><a href="/post/{{$post['id']}}" target="_blank">{{$post['title']}}</a></td>
              <td>{{$post['phone']}}</td>
              <td>{{$post['expired_at']}}</td>
              <td>{{$post['index_stick']}}</td>
              <td>{{$post['category_stick']}}</td>
              <td>{{$post['views']}}</td>
              <td>{{$post['created_at']}}</td>
              <td><span class="post-status-{{$post['status']}}"></span></td>
              <td>置顶 删除 <a href="/admin/post/edit/{{$post['id']}}">编辑</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection