@extends('layouts.website')
@section('content')
<nav aria-label="breadcrumb" class="py-3">
  <ol class="breadcrumb">
      <li class="text-muted">当前位置：</li>
    <li class="breadcrumb-item"><a href="/">首页</a></li>
    <li class="breadcrumb-item"><a href="/search">查找/修改/取消信息</a></li>
  </ol>
</nav>
<div class="content p-4">
  <h3 class="text-center pb-4">查找/修改/取消信息</h3>
  <div class="">
    <form class="text-center row justify-content-center">
      <div class="mb-3 col-6">
       <div class="input-group">
          <input type="text" class="form-control" name="keyword" placeholder="请输入信息编号或者手机号" aria-label="请输入信息编号或者手机号" aria-describedby="button-addon">
          <button class="btn btn-outline-primary btn-search-post" type="button" id="button-addon">搜 索</button>
      </div>
    </div>
    </form>
    <div class="p-5">
      <p><strong>查找信息</strong></p>
      <p>输入信息编号，或者发布信息时填写的电话号，点击“搜索”。</p>
      <p class="mt-4"><strong>修改或取消信息</strong></p>
      <p>通过“搜索”找到发布的信息，点击标题进入信息页，在管理信息版块输入发布信息时预留的密码登录，提交修改或取消信息的申请。</p>
      <p class="text-danger mt-4"><strong>忘记密码，或者联系方式被冒用</strong></p>
      <p>通过“搜索”找到相关的信息，用该信息中显示的联系方式联系网站客服处理。</p>
    </div>
  </div>
</div>
@endsection
@section('extend_js')
<script>
$(function(){
  $('.btn-search-post').click(function () {
    window.location.href = '/search/' + $('input[name="keyword"]').val()
  })
  $('input[name="keyword"]').keypress(function (event) {
    if (event.charCode == 13) {
      window.location.href = '/search/' + event.currentTarget.value
      return false
    }
  })
})
</script>
@endsection