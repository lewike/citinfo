@extends('layouts.wechat')

@section('content')
<div class="wrap">
    <div class="breadcrumb weui-flex">
        <div class="weui-flex__item text-center">
            <h4>个人中心</h4> 
        </div>
    </div>
    <div class="card">
        <div class="card-title">
            我发布的信息
        </div>
        <div>
            <ul class="user-posts">
                <li>
                    <div>信息标题</div>
                    <div>分类： </div>
                    <div>浏览： </div>
                    <div>过期时间： </div>
                    <div><button class="btn-primary">刷新靠前</button>  <button class="btn-primary">延长一周</button> <button class="btn-danger">信息失效</button></div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('extend_js')
<script>

</script>
@endsection