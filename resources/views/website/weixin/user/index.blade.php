@extends('layouts.wechat')

@section('content')
<div class="wrap">
    <div class="breadcrumb weui-flex">
        <div class="weui-flex__item text-center">
            <h3>个人中心</h3>
        </div>
    </div>
    <div class="card">
        <div class="card-title">
            我发布的信息
        </div>
        <div>
            <ul class="user-posts">
                @foreach ($posts as $post)
                <li>
                    <div class="post-title"><a href="/wx/post/show/{{$post->id}}">{{$post->title}}</a></div>
                    <div class="post-info">
                        <div>浏&#12288;览： {{$post->views}} 次</div>
                        <div>分&#12288;类：{{$post->category()->name}}</div>
                       <div>有效期：{{$post->expired_at->format('Y-m-d H:i')}}</div>
                    </div>
                    <div class="post-opts"><button class="btn-primary" data-action="refresh" data-id="{{$post->id}}">刷新信息</button>  <button class="btn-primary" data-action="delay" data-id="{{$post->id}}">延长信息</button> <button class="btn-danger" data-action="delete" data-id="{{$post->id}}">删除信息</button></div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

@section('extend_js')
<script>
$(function(){
    $('.post-opts button').on('click', function(e){
        var $ele = $(e.currentTarget);
        
    })
})
</script>
@endsection