@extends('layouts.giftmarket')

@section('content')
<div class="wrap">
  <div class="title-bg">
    <img src="http://giftadmin.chengzi001.cn/image/20200530/1590832277887966.jpg" alt="">
  </div>

  <div class="market-detail">
    <div class="weui-flex">
      <div class="weui-flex__item">
        <p>{{$market['view_count']}}</p>
        <p>浏览量</p>
      </div>
      <div class="weui-flex__item">
      <p>{{$market['share_count']}}</p>
        <p>分享人数</p>
      </div>
      <div class="weui-flex__item">
        <p>{{$market['join_count']}}</p>
        <p>报名人数</p>
      </div>
    </div>
    <div class="time-count count-down" data-time="{{$market['end_at']}}">
  
    </div>
  </div>
  <div class="market-joiner">
    <div class="title">
      参与人数
    </div>
    <div class="joiner-list">
      <div class="rowup">
        <div>
          <img src="http://wx.qlogo.cn/mmopen/VB0kBDTtHzFEL3iabb59VuTtRoslVEtQJicPX3VeIjCQXq85icHSjforPDxZXL70Nn83XxwGeaicatL0AQRFPaKAr5H5CEHwzBic9/96" alt="">
          <p>姓名...</p>
        </div>
        <div>
          <img src="http://wx.qlogo.cn/mmopen/VB0kBDTtHzFEL3iabb59VuTtRoslVEtQJicPX3VeIjCQXq85icHSjforPDxZXL70Nn83XxwGeaicatL0AQRFPaKAr5H5CEHwzBic9/96" alt="">
          <p>姓名...</p>
        </div>
        <div>
          <img src="http://wx.qlogo.cn/mmopen/VB0kBDTtHzFEL3iabb59VuTtRoslVEtQJicPX3VeIjCQXq85icHSjforPDxZXL70Nn83XxwGeaicatL0AQRFPaKAr5H5CEHwzBic9/96" alt="">
          <p>姓名...</p>
        </div>
        <div>
          <img src="http://wx.qlogo.cn/mmopen/VB0kBDTtHzFEL3iabb59VuTtRoslVEtQJicPX3VeIjCQXq85icHSjforPDxZXL70Nn83XxwGeaicatL0AQRFPaKAr5H5CEHwzBic9/96" alt="">
          <p>姓名...</p>
        </div>
        <div>
          <img src="http://wx.qlogo.cn/mmopen/VB0kBDTtHzFEL3iabb59VuTtRoslVEtQJicPX3VeIjCQXq85icHSjforPDxZXL70Nn83XxwGeaicatL0AQRFPaKAr5H5CEHwzBic9/96" alt="">
          <p>姓名...</p>
        </div>
        <div>
          <img src="http://wx.qlogo.cn/mmopen/VB0kBDTtHzFEL3iabb59VuTtRoslVEtQJicPX3VeIjCQXq85icHSjforPDxZXL70Nn83XxwGeaicatL0AQRFPaKAr5H5CEHwzBic9/96" alt="">
          <p>姓名...</p>
        </div>
        <div>
          <img src="http://wx.qlogo.cn/mmopen/VB0kBDTtHzFEL3iabb59VuTtRoslVEtQJicPX3VeIjCQXq85icHSjforPDxZXL70Nn83XxwGeaicatL0AQRFPaKAr5H5CEHwzBic9/96" alt="">
          <p>姓名...</p>
        </div>
      </div>
    </div>
  </div>
  <div class="market-shopinfo">
    <div class="title">
      商家地址
    </div>
    <div class="shopinfo">
      <p>商家名称：</p>
      <p>营业时间：</p>
      <p>商家电话：</p>
      <p>商家地址：</p>
    </div>
  </div>
  <div class="market-rank">
    <div class="title">
      排行榜
    </div>
    <div class="rank-list">
      <div class="rowup">
        <div class="weui-flex">
          <div class="">
            <img src="http://wx.qlogo.cn/mmopen/VB0kBDTtHzFEL3iabb59VuTtRoslVEtQJicPX3VeIjCQXq85icHSjforPDxZXL70Nn83XxwGeaicatL0AQRFPaKAr5H5CEHwzBic9/96" alt="">
          </div>
          <div class="weui-flex__item">
            <p>姓名</p>
            <p>推广x人</p>
          </div>
          <div class="">
            <p>获得奖金</p>
            <p>1100</p>
          </div>
        </div>
        <div class="weui-flex">
          <div class="">
            <img src="http://wx.qlogo.cn/mmopen/VB0kBDTtHzFEL3iabb59VuTtRoslVEtQJicPX3VeIjCQXq85icHSjforPDxZXL70Nn83XxwGeaicatL0AQRFPaKAr5H5CEHwzBic9/96" alt="">
          </div>
          <div class="weui-flex__item">
            <p>姓名</p>
            <p>推广x人</p>
          </div>
          <div class="">
            <p>获得奖金</p>
            <p>1100</p>
          </div>
        </div>
        <div class="weui-flex">
          <div class="">
            <img src="http://wx.qlogo.cn/mmopen/VB0kBDTtHzFEL3iabb59VuTtRoslVEtQJicPX3VeIjCQXq85icHSjforPDxZXL70Nn83XxwGeaicatL0AQRFPaKAr5H5CEHwzBic9/96" alt="">
          </div>
          <div class="weui-flex__item">
            <p>姓名</p>
            <p>推广x人</p>
          </div>
          <div class="">
            <p>获得奖金</p>
            <p>1100</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="market-joiner">
    <div class="title">
      活动详情
    </div>
    <div class="joiner-list">
     
    </div>
  </div>
  <div class="btn-buy weui-flex">
    <div class="buy-count">
    {{$market['buy_count']}}人购买
    </div>
    <div class="buy-it">
      立即抢购
    </div>
  </div>

  <div class="buyer-list">
    <div class="rowup">
      <div>
        xxxx已经付款
      </div>
      <div>
        xxxx已经付款
      </div>
      <div>
        xxxx已经付款
      </div>
      <div>
        xxxx已经付款
      </div>
      <div>
        xxxx已经付款
      </div>
      <div>
        xxxx已经付款
      </div>
      <div>
        xxxx已经付款
      </div>
      <div>
        xxxx已经付款
      </div>
      <div>
        xxxx已经付款
      </div>
      <div>
        xxxx已经付款
      </div>
    </div>
  </div>

  <div class="share-img">
  <a href="/market/single/{{$market['id']}}/share"></a>
  </div>
  <div class="kefu">
    <div>
      客服
    </div>
  </div>
  <div class="more">
    更多活动
  </div>
  <a class="call" href="tel:18790129933">
    <div class="call-icon"></div>
  </a>
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