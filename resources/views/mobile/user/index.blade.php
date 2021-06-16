@extends('layouts.mobile')

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
                    <div class="post-title @if ($post->is_expired) post-deleted @endif"><a href="/wx/post/show/{{$post->id}}">{{$post->title}}</a></div>
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
        axios.post('/wx/post/update', {action: $ele.data('action'), id: $ele.data('id')})
        .then(function (response) {
            if (response.data.result) {
                weui.toast('操作成功', 2000);
            }
        })
        .catch(function(error) {
            weui.alert('服务器在偷懒，请稍后重试！');
        })
    })
})
</script>
@endsection