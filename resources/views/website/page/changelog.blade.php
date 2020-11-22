@extends('layouts.website')
@section('content')
<nav class="breadcrumb">
  <a class="breadcrumb-item" href="/">首页</a>
  <a class="breadcrumb-item" href="/changelog">更新日志</a>
</nav>
<div class="content p-4">
  <h3 class="text-center pb-4">更新日志</h3>
    <p>2019年12月24日，发布信息页面，由之前的匿名发布改为了通过扫描关注微信公众号后才能发布，这样更方便用户使用微信对已发布信息进行管理，同时更加简化了信息发布流程，只保留了分类选择，内容，联系方式，依然是后台审核并修改后才能显示信息。</p>
    <p>2019年12月20日，xixian.cc域名因为备案问题，切换到zaixixian.com，沿用了之前网站名称【息县濮淮网】，网站程序正式命名为Citinfo，该程序会选在一个适当时机开源，前端选择了传统的bootstrap框架，后端由之前的Laravel应用开发改为了基于Laravel框架的包开发模式。</p>
    <p>2020年11月20日，xixian.cc备案，做为备用域名，以zaixixian.com为主域名，重新命名网站名称【息县网】，网站程序命名保持不变</p>
    <p class="mt-5 text-right">2020年11月20日</p>
</div>
@endsection