@extends('layouts.website')

@section('content')
<nav aria-label="breadcrumb" class="py-3">
  <ol class="breadcrumb">
      <li class="text-muted">当前位置：</li>
    <li class="breadcrumb-item"><a href="/">首页</a></li>
    <li class="breadcrumb-item"><a href="/fenlei/{{$category->ename}}">{{$category->name}}</a></li>
    <li class="breadcrumb-item"><a href="/post/create" class="text-success"><strong>免费发布信息</strong></a></li>  </ol>
</nav>
<div class="content row">
  <div class="col pr-2">
      <div class="border-bottom pb-2">  
        <strong>按栏目浏览：</strong>
      </div>
      <div class="py-3">
        <div class="row">
        @foreach ($subCategories as $subCategory)
          <div class="col-auto py-2"><a href="/category/{{$subCategory->id}}">{{$subCategory->name}}</a></div>
        @endforeach
        </div>
      </div>
      <div class="border-bottom py-1 mb-1 text-end">
        <a href="/promotion" class="text-sm text-danger">置顶，让信息效果更好！</a>
      </div>
      <div class="">
        <table class="table table-borderless table-sm">
          <thead>
            <tr>
              <th>标题</th>
              <th width="100" class="text-center">剩余有效期</th>
              <th width="100" class="text-end">发布时间</th>
            </tr>
          </thead>
          <tbody class="cate-posts-list">
            @foreach ($posts as $post)
            <tr>
              <td @if($post->category_sticky) class="category-stick" @endif><a href="{{route('website.post.show', ['post'=> $post->id])}}">{{$post->title}}</a></td>
              <td width="100" class="text-center text-secondary"><span class="expired_time" data-time="{{$post->expired_at}}"></span></td>
              <td width="100" class="text-end text-secondary"><small>{{$post->created_at->format('Y-m-d')}}</small></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{$posts->links()}}
      </div>
  
  </div>
  <div class="col-auto index-ad ml-2">
    <div class="border-bottom pb-2">
      <strong>赞助商广告</strong>
    </div>
    <ul class="list-unstyled my-4">
      <li class="text-center">欢迎投放广告!</li>
    </ul>
  </div>
</div>
@endsection