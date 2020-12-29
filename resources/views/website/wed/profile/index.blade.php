@extends('layouts.wed', ['page' => 'profile'])

@section('content')
<div class="wrap">
    <div class="profile-top-wrap">
        <div class="profile-avatar">
            <img src="https://imgavater.ui.cn/avatar/5/7/4/9/919475.jpg?imageMogr2/auto-orient/crop/!842x842a75a0/thumbnail/148x148" alt="">
        </div>
        <div class="profile-info">
            <div class="profile-info-name">姓名 <span>未实名认证</span></div>
            <div class="profile-info-percent">资料完成度100%</div>
        </div>
    </div>
    <div class="profile-photos">
        上传相册图片
    </div>
    <div class="profile-menu">
        <ul>
            <li>
                <img src="/images/wed/icons/detail.png" alt=""> <span>我的资料</span>
            </li>
            <li>
                <img src="/images/wed/icons/hartbeat.png" alt=""> <span>联系红娘</span>
            </li>
            <li>
                <img src="/images/wed/icons/show.png" alt=""> <span>隐藏我的信息</span> 
            </li>
        </ul>
    </div>
</div>
@endsection