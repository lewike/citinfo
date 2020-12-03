@extends('layouts.wechat')

@section('content')
<div class="wrap iscroll" data-page="/wx">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($config['swiper'] as $i => $swiper)
            <div class="swiper-slide"><img src="{{$swiper}}" data-url="{{$config['url'][$i]}}"></div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="category">
        <ul>
            <li>
                <a href="">
                    <img src="/images/wx-nav/house.png" alt="">
                    <div>房产信息</div>
                </a>
            </li><li>
                <a href="">
                    <img src="/images/wx-nav/job.png" alt="">
                    <div>人才信息</div>
                </a>
            </li><li>
                <a href="">
                    <img src="/images/wx-nav/circle.png" alt="">
                    <div>供求信息</div>
                </a>
            </li><li>
                <a href="">
                    <img src="/images/wx-nav/car.png" alt="">
                    <div>车辆信息</div>
                </a>
            </li><li>
                <a href="">
                    <img src="/images/wx-nav/education.png" alt="">
                    <div>招生信息</div>
                </a>
            </li><li>
                <a href="">
                    <img src="/images/wx-nav/homemaking.png" alt="">
                    <div>服务信息</div>
                </a>
            </li><li>
                <a href="">
                    <img src="/images/wx-nav/huodong.png" alt="">
                    <div>优惠信息</div>
                </a>
            </li>
        </ul>
    </div>
    <div class="new-post-list">
        <div class="post-list__title">最新信息</div>
        <ul>
            @foreach ($posts as $post)
            <li>
                <div class="post-title @if ($post->index_stick) post-stick @endif">{{$post['title']}}</div>
                <div class="post-info">
                    <div class="post-cate">{{$post->category_name}}</div>
                    <div class="post-date">{{$post->created_at->format('y-m-d')}}</div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection