@extends('layouts.wed')

@section('content')
<div class="wrap">
    <div class="user-detail">
        <div class="user-detail-header">
            <div class="user-avatar">
                <img src="{{$member['avatar']}}" alt="">
            </div>
        </div>
    </div>
    <div class="user-detail-info">
        <div><strong>{{$member['name']}}</strong></div>
        <div class="gender-{{$member['gender']}}">{{$member['age']}}</div>
    </div>
    <div class="user-detail-card-header">基本资料</div>
    <div class="user-detail-other">
        <div>
            <strong>工作：</strong><span>{{$member['job']}}</span>
        </div>
        <div><strong>收入：</strong><span>{{$member['income_cn']}}</span></div>
        <div>
            <strong>车房：</strong>
            <span>{{$member['car'] ? '无车' : '有车'}}</span>
            <span>{{$member['house'] ? '无房' : '有房'}}</span>
        </div>
        <div><strong>婚姻：</strong><span>{{$member['marry_cn']}}</span></div>
        <div><strong>自我介绍：</strong><span>性格和善，工作稳定，身高一米八</span></div>
        <div><strong>择偶要求：</strong><span>20-30岁，工作稳定，有车有房</span></div>
    </div>
    <div class="user-detail-card-header">Ta的相册</div>
    <div class="user-detail-images">
        @if (!$member['images'])
        <div class="none-images">Ta还没有上传照片，通过红娘联系Ta!</div>
        @else 
        <ul>
            <li><img src="" alt=""></li>
            <li></li>
            <li></li>
        </ul>
        @endif
    </div>
    <div class="contact-us">
        <img src="http://www.dtwmsj.com/uploads/20201208/c9420b24a81d84348f4e8cba1566808b.png">
        <p>扫码联系红娘迅速牵线</p>
    </div>
</div>
@endsection