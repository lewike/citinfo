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
              <td><a href="/admin/post/edit/{{$post['id']}}">{{$post['id']}}</a></td>
              <td>{{$post->category()->name}}</td>
              <td><a href="/post/{{$post['id']}}" target="_blank">{{$post['title']}}</a></td>
              <td>{{$post['phone']}}</td>
              <td>{{$post['expired_at']}}</td>
              <td>{{$post['index_sticky'] ? '是' : '否'}} 有效期:{{$post['index_sticky_expired_at']}}</td>
              <td>{{$post['category_sticky'] ? '是' : '否'}} 有效期:{{$post['category_sticky_expired_at']}}</td>
              <td>{{$post['views']}}</td>
              <td>{{$post['created_at']}}</td>
              <td><span class="post-status-{{$post['status']}}"></span></td>
              <td><a href="" data-bs-toggle="modal" data-bs-target="#modal-sticky">置顶</a> | <a href="/admin/post/expired/{{$post['id']}}" class="comfirmed" data-bs-toggle="modal" data-bs-target="#modal-expired">失效</a> | <a href="/admin/post/delete/{{$post['id']}}" data-bs-toggle="modal" data-bs-target="#modal-small">删除</a> | <a href="/admin/post/edit/{{$post['id']}}">编辑</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @if ($posts->hasMorePages())
        <div class="card-footer">
          {{ $posts->links() }}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
<div class="modal" id="modal-expired" tabindex="-1" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-title">确定失效？</div>
        <div>确定执行该操作！</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">取消</button>
        <button type="button" class="btn btn-danger btn-expired-post" data-bs-dismiss="modal">确定</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="modal-delete" tabindex="-1" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-title">确定删除？</div>
        <div>如果确定，数据会被永久删除！</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">取消</button>
        <button type="button" class="btn btn-danger btn-delete-post" data-bs-dismiss="modal">确定，删除数据</button>
      </div>
    </div>
  </div>
</div>
@endsection