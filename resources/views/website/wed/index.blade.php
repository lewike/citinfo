@extends('layouts.wed')

@section('content')
<div class="wrap iscroll">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($config['swiper'] as $i => $swiper)
            <div class="swiper-slide"><img src="{{$swiper}}" data-url="{{$config['url'][$i]}}"></div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="notice">
        公告:
    </div>
    <div class="masonry-container">
        @foreach ($members as $member)
        <div class="item" data-url="/wed/detail/{{$member['id']}}">
            <a href="/wed/detail/{{$member['id']}}">
            <div class="user-info">
                <div class="info-wrap">
                    <img src="{{$member['avatar']}}" alt="">
                    <span class="vip-user"></span>
                </div>
                <div>
                    <div class="user-baseinfo">
                        <p class="user-name">{{$member['name']}}</p>
                        <p class="user-other">{{$member['gender']}} {{$member['age']}}岁 {{$member['marry']}}
                            {{$member['job']}}</p>
                    </div>
                    <ul class="user-assets">
                        @if ($member->house)
                            <li class="has-house tag-text border-text-red">有房</li>
                        @endif
                        @if ($member->car)
                            <li class="has-car tag-text border-text-green">有车</li>
                        @endif
                        @if ($member->real_name)
                            <li class="tag-text border-text-green">实名认证</li>
                        @endif
                    </ul>
                </div>
            </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="loading d-none">正在加载中...</div>
    <div class="no-more d-none">已经到底，没有了</div>
    <div class="load-more">上拉加载更多</div>
    <div class="d-none template">
        <div class="item">
            <div class="user-info">
                <div class="info-wrap">
                    <img src="" alt="">
                    <span class="vip-user"></span>
                </div>
                <div>
                    <div class="user-baseinfo">
                        <p class="user-name">{{$member['name']}}</p>
                        <p class="user-other">{{$member['gender']}} {{$member['age']}}岁 {{$member['marry']}}
                            {{$member['job']}}</p>
                    </div>
                    <ul class="user-assets">
                        <li class="has-house tag-text border-text-red">有房</li>
                        <li class="has-car tag-text border-text-green">有车</li>
                        <li class="tag-text border-text-green">实名认证</li>
                        <li class="tag-text border-text-green">高级会员</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extend_js')
<script>

</script>
@endsection