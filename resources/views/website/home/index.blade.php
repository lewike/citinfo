@extends('layouts.website')
@section('content')
<div class="content row py-2">
  <div class="col">
    <div class="content-nav border-bottom py-2">
      <a href="/post/create" class="text-success create-post-link">免费发布信息</a> <a href="/search">查找/修改/取消信息</a> <a href="/promotion"><strong>信息置顶推广</strong></a> <a href="/search">联系方式被冒用怎么办?</a>
    </div>
    <ul class="home-posts-list list-unstyled pt-2">
      @foreach ($posts as $post)
      <li class="py-1 @if ($post->index_stick) index-stick @endif"><span class="float-right timeago text-secondary" datetime="{{$post->created_at}}"></span><a href="{{route('post_show', ['post'=> $post->id])}}">{{$post->title}}</a><small class="ml-2"><a href="/category/{{$post->categoryId()}}" class="text-secondary">{{$categoryArray[$post->categoryId()]}}</a></small></li>
      @endforeach
    </ul>
  </div>
  <div class="col-md-auto index-ad">
    <div class="border-bottom py-2">
      <strong>赞助商广告</strong>
    </div>
    <ul class="list-unstyled my-4">
      <li class="text-center">
        <img src="https://img.zaixixian.com/images/ad/ad1.png" alt="">
      </li>
      <li class="text-center">
        <img src="https://img.zaixixian.com/images/ad/ad2.png" alt="">
      </li>
      <li class="text-center">
        <img src="https://img.zaixixian.com/images/ad/ad3.png" alt="">
      </li>
    </ul>
  </div>
</div>
<div>
  <div class="border-bottom pb-2">
    <strong>站内导航</strong>
  </div>
  <div class="site-nav py-2">
    @foreach ($categories as $category)
    <div class="row no-gutters py-1">
      <div class="col-md-auto pr-2">
        <a href="/fenlei/{{$category['data']->ename}}"><strong>{{$category['data']->name}}</strong>： </a>
      </div> 
      <div class="col">
        @foreach ($category['child'] as $subcategory)
        <a href="/category/{{$subcategory->id}}">{{$subcategory->name}}</a>
        @endforeach
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection