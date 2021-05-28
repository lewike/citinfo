@extends('layouts.mobile')

@section('content')
<div class="wrap iscroll" data-page="/">
    <div class="breadcrumb weui-flex">
        <div><a href="/">主页</a></div>
        <div class="weui-flex__item text-center">
            <h3>{{$category->name}}</h3>
        </div>
        <div><a href="javascript:location.reload()">刷新</a></div>
    </div>

    <div class="new-post-list">
        <div class="post-list__title">最新信息</div>
        <ul>
            @foreach ($posts as $post)
            <li>
                <a href="/post/{{$post['id']}}">
                    <div class="post-title @if ($post->category_sticky) post-stick @endif">{{$post['title']}}</div>
                    <div class="post-info">
                        <div class="post-cate">{{$post->category_name}}</div>
                        <div class="post-date">{{$post->created_at->format('y-m-d')}}</div>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection