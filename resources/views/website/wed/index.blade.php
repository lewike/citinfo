@extends('layouts.wed')

@section('content')
<div class="wrap">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="/upload/post/img/201111/a96139a5a24ecf494812174af9496191.png" data-url=""></div>
            <div class="swiper-slide"><img src="/upload/post/img/201111/f5b117a16872c3e0a8c5d91c68e21abc.png" data-url=""></div>
            <div class="swiper-slide"><img src="/upload/post/img/201111/40236d6ed63bc844ffe63fa5ff7164db.png" data-url=""></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="notice">
        公告:
    </div>
    <div class="masonry-container">
        <div class="item">
            <div class="user-info">
                <div class="info-wrap">
                    <img src="/upload/post/img/201111/36c16cb9f3f5fc89e069e27401706cea.png" alt="">
                    <span class="vip-user"></span>
                </div>
                <div>
                    <ul class="user-assets">
                        <li class="has-house">有房</li>
                        <li class="has-car">有车</li>
                    </ul>
                    <p>刘女士 未婚 22</p>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="user-info">
                <div class="info-wrap">
                    <img src="/upload/post/img/201111/36c16cb9f3f5fc89e069e27401706cea.png" alt="">
                    <span class="vip-user"></span>
                </div>
                <div>
                    有车
                </div>
            </div>
        </div>
        <div class="item">
            <div class="user-info">
                <div class="info-wrap">
                    <img src="/upload/post/img/201111/36c16cb9f3f5fc89e069e27401706cea.png" alt="">
                    <span class="vip-user"></span>
                </div>
                <div>
                    有车
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection

@section('extend_js')
<script>
  $(function(){

  })
</script>
@endsection