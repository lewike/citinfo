<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>相亲网</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <link href="https://res.wx.qq.com/open/libs/weui/2.4.0/weui.min.css" rel="stylesheet">
    <link href="{{mix('css/wed.css')}}" rel="stylesheet">
</head>

<body>
    <div class="page-loading">
        <i class="weui-loading"></i>
    </div>
    <div class="container">
        <div class="page">
            <div style="height: 100%;">
                <div class="weui-tab">
                    <div class="weui-tab__panel">
                        <div class="content">
                            @yield('content')
                        </div>
                    </div>
                    @section('tabbar')
                    <div class="weui-tabbar">
                        <div class="weui-tabbar__item @if ($page == 'home') weui-bar__item_on @endif" data-url="/wed">
                            <div style="display: inline-block; position: relative;">
                                @if ($page == 'home')
                                <img src="/images/wed/nav_icons/find_on.png" alt="" class="weui-tabbar__icon">
                                @else
                                <img src="/images/wed/nav_icons/find.png" alt="" class="weui-tabbar__icon">
                                @endif
                                
                            </div>
                            <p class="weui-tabbar__label">推荐</p>
                        </div>
                        
                        <div class="weui-tabbar__item @if ($page == 'activity') weui-bar__item_on @endif" data-url="/wed/activity">
                            <div style="display: inline-block; position: relative;">
                                @if ($page == 'activity')
                                <img src="/images/wed/nav_icons/party_on.png" alt="" class="weui-tabbar__icon">
                                @else
                                <img src="/images/wed/nav_icons/party.png" alt="" class="weui-tabbar__icon">
                                @endif
                            </div>
                            <p class="weui-tabbar__label">活动</p>
                        </div>
                        
                        <div class="weui-tabbar__item @if ($page == 'qianxian') weui-bar__item_on @endif" data-url="/wed/qianxian">
                            <div style="display: inline-block; position: relative;">
                                @if ($page == 'qianxian')
                                <img src="/images/wed/nav_icons/qianxian_on.png" alt="" class="weui-tabbar__icon">
                                @else
                                <img src="/images/wed/nav_icons/qianxian.png" alt="" class="weui-tabbar__icon">
                                @endif
                            </div>
                            <p class="weui-tabbar__label">牵线</p>
                        </div>
                        
                        <div class="weui-tabbar__item  @if ($page == 'profile') weui-bar__item_on @endif" data-url="/wed/profile">
                            <div style="display: inline-block; position: relative;">
                                @if ($page == 'profile')
                                <img src="/images/wed/nav_icons/user_on.png" class="weui-tabbar__icon">
                                @else
                                <img src="/images/wed/nav_icons/user.png" class="weui-tabbar__icon">
                                @endif
                            </div>
                            <p class="weui-tabbar__label">我</p>
                        </div>

                    </div>
                    @show
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/wed.js') }}"></script>
    <script type="text/javascript" src="https://res.wx.qq.com/open/libs/weuijs/1.2.1/weui.min.js"></script>
    @yield('extend_js')
</body>
</html>