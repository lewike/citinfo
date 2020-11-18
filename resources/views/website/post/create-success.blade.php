@extends('layouts.website')
@section('content')
<nav class="breadcrumb">
  <a class="breadcrumb-item" href="/">首页</a>
  <a class="breadcrumb-item" href="/post/create">发布信息</a>
</nav>
<div class="content p-4">
  <h3 class="text-center pb-4">恭喜，你的信息已经提交！</h3>

<p>你的信息已经提交，需要经过管理员审核之后才能显示，请耐心等待！</p>

<p>快速通道　<a href="/post/create">免费发布信息</a> - <a href="/search">查找/修改/取消信息</a> - <a href="/promotion">置顶推广信息</a> - <a href="/search">联系方式被冒用怎么办</a></p>

<p>联系方式</p>

<p>电话：199 0376 3214 （微信同号）</p>

<p>ＱＱ：77561113</p>

<p>邮箱：77561113@qq.com</p>

<p>工作时间：周一至周五早 9:00 - 晚 5:00</p>
</div>
@endsection