@extends('layouts.wed', ['page' => 'home'])

@section('content')
<div class="wrap iscroll">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($swipers['image'] as $i => $swiper)
            <div class="swiper-slide"><img src="{{$swipers['image'][$i]}}" data-url="{{$swipers['url'][$i]}}"></div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="notice ">
        <img src="/images/wed/icons/notice.png" alt="通知公告">
        <div>
            <a href="{{$notice['url']}}">{{$notice['title']}}</a>
        </div>
    </div>
    <div class="masonry-container">
        @foreach ($members as $member)
        <div class="item" data-url="/wed/detail/{{$member['id']}}">
            <a href="/wed/detail/{{$member['id']}}">
            <div class="user-info">
                <div class="user-info-image">
                    <img src="{{$member['avatar']}}" alt="">
                    <span class="vip-user"></span>
                </div>
                <div class="user-info-intro">
                    <div class="intro-base">
                        <p class="user-name">{{$member['name']}}</p>
                        <p class="user-other">{{$member['gender_cn']}} {{$member['age']}}岁
                            {{$member['job']}}</p>
                    </div>
                    <ul class="intro-assets">
                        @if ($member->house)
                            <li class="has-house tag-text border-text-red">有房</li>
                        @endif
                        @if ($member->car)
                            <li class="has-car tag-text border-text-green">有车</li>
                        @endif
                        @if ($member->real_name)
                            <li class="tag-text border-text-green">实名</li>
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
            <a href="">
            <div class="user-info">
                <div class="user-info-image">
                    <img src="" alt="">
                    <span class="vip-user d-none"></span>
                </div>
                <div class="user-info-intro">
                    <div class="intro-base">
                        <p class="user-name"></p>
                        <p class="user-other"></p>
                    </div>
                    <ul class="intro-assets">
                        <li class="has-house tag-text border-text-red d-none">有房</li>
                        <li class="has-car tag-text border-text-green d-none">有车</li>
                        <li class="real-name tag-text border-text-green d-none">实名</li>
                    </ul>
                </div>
            </div>
            </a>
        </div>
    </div>
</div>
@endsection

@section('extend_js')
<script>

</script>
@endsection