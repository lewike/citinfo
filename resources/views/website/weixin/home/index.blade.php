@extends('layouts.wechat')

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
</div>
@endsection