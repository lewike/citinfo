@extends('layouts.carpool')
@section('title')
@endsection
@section('content')
<div class="weui-tab page-pinche">
    <div class="weui-tab__panel">
        <div class="weui-tab__content d-block">
            <div class="carpool-topbar weui-flex">
                <div><a href="/pinche">首页</a></div>
                <div>个人中心</div>
                <div><a href="javascript:location.reload()">刷新</a></div>
              </div>

            <div class="user-vip">
                <div class="weui-flex">
                    <div class="weui-flex__item">
                        账户余额： {{number_format($userWallet->total_amount/100, 2)}}
                    </div>
                    <div class="user-vip-renew">
                        <a href="javascript:;" class="btn-recharge">立即充值</a>
                    </div>
                </div>
            </div>
        
            <div class="pinche-list">
                <div class="weui-flex pinche-list__hd">
                    <div>我发布的拼车</div>
                </div>
                <div class="pinche-list-content">
                    @forelse ($carpools as $carpool)
                    <div class="weui-flex carpool">
                        <div class="weui-flex__item content">
                            <a href="/pinche/show/{{$carpool->id}}">

                                <div class="title">
                                    @if ($carpool->is_stick)
                                    <span class="sticky-icon">顶</span>
                                    @endif
                                    @if ($carpool->type == 'people')
                                    <span class="type-people">人找车</span>
                                    @else
                                    <span class="type-car">车找人</span>
                                    @endif
                                    <span class="direction"> <span>{{$carpool->direction_from}}</span>至<span>{{$carpool->direction_to}}</span></span>
                                    @if ($carpool->directions) 
                                    <span class="direction_with">途经<span>{{$carpool->directions}}</span></span>
                                    @endif
                                </div>
                                <div class="start">
                                    <span class="time" data-date="{{$carpool->start_at->valueOf()}}"></span> 
                                    @if ($carpool->additional)
                                    <span>({{$carpool->additional}})</span>
                                    @endif
                                    <span>出发</span>
                                    @if ($carpool->type == 'car') 
                                    <span class="seat"><i> {{$carpool->seat_cnt}}</i>个空位</span> 
                                    @else
                                    <span class="seat"><i> {{$carpool->seat_cnt}}</i>人</span>
                                    @endif
                                    @if ($carpool->car_type)
                                    <span>车型：{{$carpool->car_type}}</span>
                                    @endif
                                </div>
                                <div class="description">备注：{{$carpool->description}}</div>
                                <div>发布时间：{{$carpool->created_at}}</div>
                                @if (!$carpool->start_at->isPast())
                                @if ($carpool->sticky)
                                <div class="carpool_sticky">提示：置顶效果 {{substr($carpool->sticky_expired_at, 0,16)}} 后失效</div>
                                @endif
                                <div class="carpool-manage">
                                    <button class="lw-btn-primary btn-sticky-carpool" data-id="{{$carpool->id}}">付费置顶</button>
                    
                                    <button class="btn-edit-carpool" data-id="{{$carpool->id}}">修改信息</button>
                   
                                    <button class="lw-btn-warn btn-del-carpool" data-id="{{$carpool->id}}">删除信息</button>
                                </div>
                                @else
                                <div>注意：信息已过期</div>
                                @endif
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="nothing">
                        <p>没有找到未出发的拼车信息</p>
                        <p>要拼车？ <a href="/weixin/pinche/post">点击立即去发布</a></p>
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="weui-footer footer">
                <p>{{$config['copyright'] ?? ''}}</p>
            </div>
        </div>
    </div>
    <div class="weui-tabbar">
        <a href="/pinche" class="weui-tabbar__item">
            <img src="/images/pinche/home.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">主页</p>
        </a>
        <a href="/pinche/post" class="weui-tabbar__item">
            <img src="/images/pinche/create.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">发布</p>
        </a>
        <a href="javascript:;" class="weui-tabbar__item  weui-bar__item_on">
            <img src="/images/pinche/profile_on.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">我</p>
        </a>
    </div>
</div>
<div class="d-none">
{!! $config['tongji'] ?? '' !!}
</div>
@endsection

@section('extend_js')
<script>
    var config = {!!$app->jssdk->buildConfig(['chooseWXPay'], false)!!};
    wx.config(config);
    $(function(){
        $('.time').each(function(i, e) {
            var ele = $(e)
            var date = LWDate.formatDateTime(ele.data('date'))
            ele.html('<span class="datetime-'+ date.type+'">'+date.day+' ' + date.hours+':'+date.minutes+'</span>')
        })
        $('.carpool-call').click(function(e){
            window.location.href = 'tel:'+ $(e.target).data('tel')
            return false;
        })

        $('.btn-edit-carpool').click(function(e) {
            e.preventDefault();
            var carpoolId = $(e.target).data('id')
            window.location.href = '/pinche/edit/'+carpoolId;
        })

        $('.btn-del-carpool').click(function(e) {
            e.preventDefault();
            var carpoolId = $(e.target).data('id')
            weui.dialog({
                title: '提示',
                content: '确定要删除？',
                buttons: [{
                    label: '取消',
                    type: 'default',
                }, {
                    label: '确定',
                    type: 'primary',
                    onClick: function () {
                        $.ajax({
                            url: '/pinche/del/'+carpoolId,
                            success: function(res){
                                if (res.result) {
                                    weui.toast('删除成功！', {
                                        duration: 3000,
                                        callback: function(){ window.location.reload() }
                                    });
                                }
                            },
                            error: function(res) {
                                weui.toast('操作失败，稍后重试', {duration: 2000})
                            }
                        })
                    }
                }]
            })
        })

        $('.btn-sticky-carpool').click(function(e){   
            e.preventDefault();
            var carpoolId = $(e.target).data('id')
            weui.picker(@json($sticky_cost), {
                title: '请选择置顶时长',
                onConfirm: function (result) {
                    axios.post('/pinche/sticky', {id: carpoolId, stick: result[0].label, total_fee: result[0].value, minutes: result[0].minutes})
                    .then(function (response) {
                        if (response.data.result) {
                            window.location.href = '/pinche/user';
                        } else {
                            weui.toast(response.data.message, {duration: 2000})
                        }
                    })
                    .catch(function (error) {
                        
                    })
                }
            }
            );
        })
        
        $('.btn-recharge').click(function(e){
            e.preventDefault();
            weui.picker(@json($recharge), {
                title: '请选择充值金额',
                onConfirm: function (result) {
                    axios.post('/pinche/recharge', {recharge_amount: result[0].value, gift_amount: result[0].gift})
                    .then(function (response) {
                        if (response.data.result) {
                            wxPay(response.data.data);
                        } else {
                            weui.toast(response.data.message, {duration: 2000});
                        }
                    })
                    .catch(function (error) {
                        
                    })
                }
            }
            );
        });
    })
  
    function wxPay(config)
    {
        wx.chooseWXPay({
            timestamp: config.timestamp,
            nonceStr: config.nonceStr,
            package: config.package,
            signType: config.signType,
            paySign: config.paySign,
            success: function (res) {
                weui.alert('已经支付成功！', {
                    title: '恭喜你！',
                    buttons: [{
                        label: '确定',
                        type: 'primary',
                        onClick: function(){ window.location.reload() }
                    }]
                })
            }
        });
    }
</script>
@endsection