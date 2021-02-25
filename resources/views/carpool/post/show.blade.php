@extends('layouts.carpool')
@section('title')

@endsection
@section('content')
<div class="weui-tab">
  <div class="weui-tab__panel">
    <div class="weui-tab__content d-block">
      <div class="weui-panel">
        <div class="carpool-topbar weui-flex">
          <div><a href="/pinche">首页</a></div>
          <div>拼车信息详情</div>
          <div><a href="javascript:" onclick="history.back()">返回</a></div>
        </div>
        <div class="carpool-show-content">
            <div class="content-border content-border__{{$carpool->type}}">
                @if($carpool->type == 'car')
                <div class="carpool-type__car">车找人</div>
                @else 
                <div class="carpool-type__people">人找车</div>
                @endif
                <div class="carpool-direction-info">
                    <div>{{$carpool->direction_from}} -> {{$carpool->direction_to}}</div>
             
                </div>
                @if ($carpool->directions)
                <div class="carpool-directions">途&#12288;&#12288;经：<span>{{$carpool->directions}}</span></div>
                @endif
                <div class="carpool-start-time">
                    <div>出发时间：<span class="start-time" data-time="{{$carpool->start_at->valueOf()}}"></span></div>
                    @if($carpool->additional)
                    <div>补充说明：{{$carpool->additional}}</div>
                    @endif
                </div>
                <div class="carpool-seat-info">
                    @if ($carpool->type == 'car')
                    <div>空&#12288;&#12288;位： <span>{{$carpool->seat_cnt}}</span> 个</div>
                    <div>车&#12288;&#12288;型：{{$carpool->car_type}}</div>
                    @else
                    <div>人&#12288;&#12288;数： <span>{{$carpool->seat_cnt}}</span> 人</div>
                    @endif
                </div>
                <div class="carpool-description">
                    备&#12288;&#12288;注：{{$carpool->description}}
                </div>
                <div class="carpool-phone">
                    <div>联系电话：<a href="javascript:;" class="carpool-call" data-tel="{{$carpool->phone}}" data-id="{{$carpool->id}}">{{$carpool->phone}}</a>
                    </div>
                </div>
            </div>
            <div class="show-post-tips">
                <p><strong>友情提示:</strong></p>
                <p>该信息由网友发布，其真实性、准确性和合法性由发布信息的网友负责</p>
                <p>【{{$config['website'] ?? ''}}】对其不提供任何保证，不承担任何责任</p>
                <p>友情提示：提高警惕，谨防诈骗</p>
              </div>
        </div>
      </div>
      <div class="weui-footer footer">
        <p><a href="/pinche/user">管理我的信息</a></p>
        <p>{{$config['copyright'] ?? ''}}</p>
      </div>
    </div>
  </div>
</div>
<div class="d-none">
  {!! $config['tongji'] ?? '' !!}
</div>
@endsection

@section('extend_js')
<script>
  $(function(){
      $('.start-time').each(function(i, e) {
          var ele = $(e)
          var date = LWDate.formatDateTime(ele.data('time'))
          ele.html('<span class="datetime-'+ date.type+'">'+date.day+' ' + date.hours+':'+date.minutes+'</span>')
      })
      $('.carpool-call').click(function(e){
        @if (isset($config['call-notice']))
        weui.dialog({
            title: '提示',
            content: '{{$config['call-notice']}}',
            buttons: [{
                label: '点击拨打电话',
                type: 'primary',
                onClick: function () {
                    $.ajax({url: '/pinche/call/'+$(e.target).data('id')})
                    window.location.href = 'tel:'+ $(e.target).data('tel')
                }
            }]
        });
        @else
        $.ajax({url: '/pinche/call/'+$(e.target).data('id')})
        window.location.href = 'tel:'+ $(e.target).data('tel')
        @endif 
        return false;
      })
  })
  var host = '{{env('APP_URL')}}';
  var config = {!!$app->jssdk->buildConfig(['updateAppMessageShareData', 'updateTimelineShareData'])!!};
  wx.config(config);
  wx.ready(function () {
      wx.updateAppMessageShareData({ 
          title: '{{$share['title']}}',
          desc: '{{$share['desc']}}',
          link: host+'/pinche/show/{{$carpool->id}}',
          imgUrl: '{{$share['image']}}',
          success: function () {
            
          }
      })
      wx.updateTimelineShareData({  
          title: '{{$share['title']}}',
          link: host+'/pinche/show/{{$carpool->id}}',
          imgUrl: '{{$share['image']}}',
          success: function () {
            
          }
      })
  });
</script>
@endsection