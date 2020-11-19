@extends('layouts.wed')

@section('content')
<div class="wrap">
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
        <div class="item">
            <div class="user-info">
                <div class="info-wrap">
                    <img src="{{$member['avatar']}}" alt="">
                    <span class="vip-user"></span>
                </div>
                <div>
                    <ul class="user-assets">
                        <li class="has-house">有房</li>
                        <li class="has-car">有车</li>
                    </ul>
                    <p>{{$member['name']}} 未婚 22</p>
                </div>
            </div>
        </div>    
        @endforeach       
    </div>
</div>
@endsection

@section('extend_js')
<script>
  $(function(){

  })
</script>
@endsection