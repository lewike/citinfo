@extends('layouts.mobile')

@section('content')
<div class="wrap">
    <div class="breadcrumb weui-flex">
        <div><a href="/"><img src="/images/mobile/home.png" alt=""></a></div>
        <div class="weui-flex__item text-center">
            <h3>免费发布消息</h3>
        </div>
        <div><a href="javascript:location.reload()"><img src="/images/mobile/reload.png" alt=""></a></div>
    </div>
    <div class="weui-panel" style="height: 100%">
        <div class="weui-panel__bd">
            暂不支持该方式提交信息，
            你可以在微信中打开该页面，
            或者关注微信公众号：在息县网，
            或者添加客服微信，直接将信息编辑后发送给客服
        </div>
    </div>
</div>

@section('extend_js')
<script>
$(function(){
    var ua = navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i)=="micromessenger") {
        window.location.href = '/wx/post/create';
    }
});
</script>
@endsection