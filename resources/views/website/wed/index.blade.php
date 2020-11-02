@extends('layouts.wed')

@section('content')
<div class="wrap">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">Slide 1</div>
            <div class="swiper-slide">Slide 2</div>
            <div class="swiper-slide">Slide 3</div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="notice">
        公告:
    </div>
    <div class="masonry-container">
        <div class="item">
            <div class="avatar">
                <img src="https://iph.href.lu/200x300?fg=666666&bg=cccccc" alt="">
            </div>
            <div>
                <div>有车</div>
            </div>
        </div>
        <div class="item">
            <div class="avatar">
                <img src="https://iph.href.lu/200x300?fg=666666&bg=cccccc" alt="">
            </div>
            <div>
                <div>有车</div>
                <div>有房</div>
                <div>有房</div>
                <div>有房</div>
            </div>
        </div>
        <div class="item">
            <div class="avatar">
                <img src="https://iph.href.lu/200x300?fg=666666&bg=cccccc" alt="">
            </div>
            <div>
                <div>有车</div>
                <div>有房</div>
            </div>
        </div>
        <div class="item">
            <div class="avatar">
                <img src="https://iph.href.lu/200x300?fg=666666&bg=cccccc" alt="">
            </div>
            <div>
                <div>有车</div>
                <div>有车</div>
                <div>有房</div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('extend_js')
<script>
  $(function(){
    $('.buy-it').click(function(e) {

      axios.post('/market/single/buy', {id: 1, phone: '13712345678'})
      .then(function (response) {
        success
      })
      .catch(function (error) {
        error
      })
    })
  })
</script>
@endsection