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
        {{$member['name']}}
    </div>
    <div class="user-detail-other">
        <div>
            <span>{{$member['gender']}}</span>
            <span>
                {{$member['age']}}    
            </span>
            <span>
                {{$member['job']}}
            </span>
        </div>
        <div>
        <span>{{$member['car']}}</span>
        <span>{{$member['house']}}</span>
        </div>
        <div>收入:</div>
        <div>择偶要求:</div>
    </div>
    <div class="user-detail-images">
        <div>更多生活照</div>
        <ul>
            <li><img src="" alt=""></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>
@endsection