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
        <div>{{$member['name']}}</div>
        <div class="gender-{{$member['gender']}}">{{$member['age']}}</div>
    </div>
    <div class="user-detail-other">
        <div>
            工作：{{$member['job']}}
        </div>
        <div>收入：{{$member['income_cn']}}</div>
        <div>
            车房：
            <span>{{$member['car'] ? '无车' : '有车'}}</span>、
            <span>{{$member['house'] ? '无房' : '有房'}}</span>
        </div>
        <div>自我介绍：</div>
        <div>择偶要求：</div>
    </div>
    <div class="user-detail-images">
        <ul>
            <li><img src="" alt=""></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div>
        联系红娘迅速牵线
        红娘二维码。。。
    </div>
</div>
@endsection