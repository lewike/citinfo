@extends('layouts.website')

@section('content')
<nav class="breadcrumb">
  <a class="breadcrumb-item" href="/">首页</a>
  <span class="breadcrumb-item text-success">搜索关键字: <span class="text-danger"><strong>{{$keyword}}</strong></span></span>
</nav>
<div class="content row">
  <div class="col">
    <div class="row no-gutters">
      <div class="col-12 border-bottom py-1 mb-1 text-right">
        <a href="" class="text-sm text-danger">置顶，让信息效果更好！</a>
      </div>
      <div class="col-12">
        <table class="table table-borderless table-sm">
          <thead>
            <tr>
              <th>标题</th>
              <th width="100" class="text-center">剩余有效期</th>
              <th width="100" class="text-right">发布时间</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
            <tr>
              <td><a href="{{route('post_show', ['post'=> $post->id])}}">{{$post->title}}</a></td>
              <td width="100" class="text-center"><span class="expired_time" data-time="{{$post->expired_at}}"></span></td>
              <td width="100" class="text-right">{{$post->created_at->format('Y-m-d')}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-auto index-ad">
    <div class="border-bottom pb-2">
      <strong>赞助商广告</strong>
    </div>
    <ul class="list-unstyled my-4">
      <li class="text-center">欢迎投放广告!</li>
    </ul>
  </div>
</div>
@endsection