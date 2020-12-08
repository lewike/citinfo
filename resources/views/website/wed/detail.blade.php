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
    <div class="user-detail-other">
        <div>
            工作：<strong>{{$member['job']}}</strong>
        </div>
        <div>收入：<strong>{{$member['income_cn']}}</strong></div>
        <div>
            车房：
            <strong><span>{{$member['car'] ? '无车' : '有车'}}</span>
            <span>{{$member['house'] ? '无房' : '有房'}}</span></strong>
        </div>
        <div>自我介绍：<strong></strong></div>
        <div>择偶要求：<strong></strong></div>
    </div>
    <div class="user-detail-images">
        <ul>
            <li><img src="" alt=""></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="contact-us">
        <img src="http://www.dtwmsj.com/uploads/20201208/c9420b24a81d84348f4e8cba1566808b.png">
        <p>扫码联系红娘迅速牵线</p>
    </div>
</div>
@endsection