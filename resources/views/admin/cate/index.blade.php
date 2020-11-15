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
        <a href="{{route('admin.cate.create')}}" class="btn btn-primary btn-sm ml-3 d-none d-sm-inline-block">
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
              <th>分类ID</th>
              <th>分类名</th>
              <th>分类标识</th>
              <th>描述</th>
              <th>状态</th>
              <th>高亮</th>
              <th>排序</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr class="category-depth-{{$category['depth']}}">
              <td>{{$category['m_id']}}</td>
              <td>{{$category['name']}}</td>
              <td>{{$category['ename']}}</td>
              <td>{{$category['desc']}}</td>
              <td>{{$category['status']}}</td>
              <td>{{$category['highlight']}}</td>
              <td>{{$category['weight']}}</td>
              <td>置顶 删除 编辑</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection