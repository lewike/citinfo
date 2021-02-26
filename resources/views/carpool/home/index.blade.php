@extends('layouts.carpool')
@section('title')
@endsection
@section('content')
<div class="weui-tab page-pinche">
    <div class="weui-tab__panel">
        <div class="weui-tab__content d-block fixed-topbar-warp">
            <div class="carpool-topbar weui-flex fixed-topbar">
                <div><a href="javascript:;" class="location">切换城市</a></div>
                <div class="weui-flex__item">{{$config['website'] ?? ''}}</div>
                <div>&#12288;&#12288;<a href="javascript:location.reload()">刷新</a></div>
            </div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($config['swipers']['image'] as $i => $swiper)
                    <div class="swiper-slide"><img src="{{$config['swipers']['image'][$i]}}" data-url="{{$config['swipers']['url'][$i]}}"></div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="weui-flex pinche-nav">
                <div class="weui-flex__item">
                    <a href="/pinche?type=car">我要找车 <img src="/images/pinche/car.png" alt="我要找车"></a>
                </div>
                <div class="weui-flex__item">
                    <a href="/pinche?type=people">我要找人 <img src="/images/pinche/people.png" alt="我要找人"></a>
                </div>
            </div>
            <div class="follow">
                <a href="javascript:" class="btn-follow">点击关注公众号，随时随地掌握拼车动态</a>
             </div>
             <div class="follow-mp d-none">
                <div class="weui-mask"></div>
                <div class="weui-dialog">
                    <div class="weui-dialog__bd">
                        <img src="{{$config['follow']}}" width="200px" height="200px">
                        <p>长按图片识别二维码</p>
                    </div>
                    <div class="weui-dialog__ft">
                        <a href="javascript:" class="weui-dialog__btn weui-dialog__btn_primary btn-follow-ok">知道了</a>
                    </div>
                </div>
            </div>
            <div class="pinche-search">
                <div class="search-bar weui-flex">
                    <div class="weui-flex__item"><input type="text" name="direction_from" placeholder="出发地"></div>
                    <div class="change"></div>
                    <div class="weui-flex__item"><input type="text" name="direction_to" placeholder="目的地"></div>
                    <div><button type="button" class="btn-search">查询</button></div>
                </div>
                <div class="hot-way">
                    热门线路：
                    @foreach($config['hotways'] as $hotway)
                    <a href="/pinche?direction_from={{$hotway['from']}}&direction_to={{$hotway['to']}}">{{$hotway['from']}}->{{$hotway['to']}}</a>
                    @endforeach
                </div>
            </div>
            <div class="pinche-list">
                <div class="weui-flex pinche-list__hd">
                <div class="weui-flex__item">
                    @if ($direction_from && $direction_to)
                    <span class="direction">{{$direction_from}}->{{$direction_to}}</span>
                    @endif
                    共{{$carpools->count()}}条信息</div>
                    <div class="weui-flex__item pinche-list__sort"><a href="/pinche?sort=start" class="sort-start d-none" data-sort="start">按出发时间排序</a><a href="/pinche?sort=created" class="sort-created d-none" data-sort="create">按发布时间排序</a></div>
                </div>
                <div class="pinche-list-content">
                    @if (!$carpools->count())
                    <div class="nothing">
                        暂时没有找到符合条件的信息
                    </div>
                    @endif
                    @foreach ($carpools as $carpool)
                    <div class="weui-flex carpool">
                        <div class="weui-flex__item content">
                            <a href="/pinche/show/{{$carpool->id}}">
                                <div class="title">
                                    @if ($carpool->sticky)
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
                                <div class="description"><b>备注: </b>{{$carpool->description ?? '无'}}</div>
                                <div class="weui-flex">
                                    <div class="created weui-flex__item">发布时间:{{substr($carpool->created_at, 5, 11)}}</div>
                                    <div class="carpool-call" data-tel="{{$carpool->phone}}" data-id="{{$carpool->id}}">立即联系</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @if ($loop->index == 5 && isset($config['index']['list-img'][0]))
                    <div>
                        <img src="{{$config['index']['list-img'][0]}}" alt="" width="100%">
                    </div>
                    @endif
                    @if ($loop->index == 10 && isset($config['index']['list-img'][1]))
                    <div>
                        <img src="{{$config['index']['list-img'][1]}}" alt="" width="100%">
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="weui-footer footer">
                @if (isset($config['index']['kefu']))
                <p>客服：<a href="tel:{{$config['index']['kefu']['phone']}}">{{$config['index']['kefu']['text']}}</a> </p>
                @endif
                <p>{{$config['copyright'] ?? ''}}</p>
            </div>
        </div>
    </div>
    <div class="weui-tabbar">
        <a href="javascript:;" class="weui-tabbar__item weui-bar__item_on">
            <img src="/images/pinche/home_on.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">主页</p>
        </a>
        <a href="/pinche/post" class="weui-tabbar__item">
            <img src="/images/pinche/create.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">发布</p>
        </a>
        <a href="/pinche/user" class="weui-tabbar__item">
            <img src="/images/pinche/profile.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">我</p>
        </a>
    </div>
</div>
<div class="d-none">
{!! $config['tongji'] ?? '' !!}
</div>
<div class="d-none">
    
</div>
@endsection

@section('extend_js')
<script>
    $(function(){
        var reg = new RegExp("(^|&)sort=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) {
            var sort = unescape(r[2])
            sort = (sort == 'start') ? 'created' : 'start'
            $('.sort-'+sort).removeClass('d-none')
        } else {
            $('.sort-start').removeClass('d-none')
        }

        $('.time').each(function(i, e) {
            var ele = $(e)
            var date = LWDate.formatDateTime(ele.data('date'))
            ele.html('<span class="datetime-'+ date.type+'">'+date.day+' ' + date.hours+':'+date.minutes+'</span>')
        })

        $('.btn-follow-ok').click(function(){
            $('.follow-mp').addClass('d-none');
            return false
        })

        $('.btn-follow').click(function(){
            $('.follow-mp').removeClass('d-none');
            return false
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
        $('.btn-search').click(function (){
           var direction_from = $('input[name=direction_from]').val();
           var direction_to = $('input[name=direction_to]').val();
           window.location.href = '/pinche?direction_from='+encodeURIComponent(direction_from)+'&direction_to='+encodeURIComponent(direction_to)
        })
        $('.pinche-list__sort a').click(function (e) {
            e.preventDefault();
            if (window.location.search.length > 1) {
                var search = window.location.search.substr(1)
                search = search.replace(/sort=[^&]*/gi, '')
                if (search.length) {
                    if (search[0] != '&') {
                        search = '&'+search
                    }
                }
                window.location.href = e.target.href + search
            }else {
                window.location.href = e.target.href
            }
        })
        $.ajax({
            url: '/config/share',
            success: function (res) {
                wx.config(res.json)
                wx.ready(function () {
                    wx.updateAppMessageShareData({ 
                        title: '{{$config['share_title'] ?? ''}}',
                        desc: '{{$config['share_desc'] ?? ''}}',
                        link: '{{$config['share_link'] ?? ''}}',
                        imgUrl: '{{$config['share_image'] ?? ''}}',
                        success: function () {
                        }
                    })
                    wx.updateTimelineShareData({  
                        title: '{{$config['share_title'] ?? ''}}',
                        link: '{{$config['share_link'] ?? ''}}',
                        imgUrl: '{{$config['share_image'] ?? ''}}',
                        success: function () {
                        }
                    })
                });
            }
        })

        $('.location').click(function(){
            weui.picker([{
                label: '信阳',
                value: 0,
                children: [
                    {
                        label: '息县拼车网',
                        value: 'https://www.zaixixian.com/pinche'
                    },
                    {
                        label: '淮滨拼车网',
                        value: 'https://www.huaibin360.com/pinche'
                    }
                ]
            }], 
            {
                title: '切换到其他城市拼车网',
                onConfirm: function (result) {
                    window.location.href = result[1].value
                },
            });
        })
    })

</script>
@endsection