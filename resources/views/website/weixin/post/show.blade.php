@extends('layouts.wechat')

@section('content')
<div class="wrap post-show">
    <div class="breadcrumb">
        首页 > 分类1 > 分类2
    </div>
    <div class="post-show-title">
        {{$post->title}}
    </div>
    <div class="post-show-info">
        浏览次数  发布时间 有效期
    </div>
    <div class="post-show-content">
        {{$post['content']}}
    </div>
    <div class="post-show-img">
        附件图片
    </div>
    <div class="post-show-phone">
        联系方式
    </div>
    <div class="post-show-tip">提醒：</div>
</div>
@endsection