<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>在息县网-免费发布分类信息</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="在息县网，是息县本地免费分类信息发布平台，覆盖房产、求职招聘、招生、二手车交易等等">
    <meta name="keywords" content="息县、息县分类信息、息县房产、息县人才、息县招聘、息县求职、息县二手车、息县商家推广" />
    <link href="https://res.wx.qq.com/open/libs/weui/2.4.0/weui.min.css" rel="stylesheet">
    <link href="{{mix('css/wx.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="page">
            <div style="height: 100%;">
                <div class="weui-tab">
                    <div class="weui-tab__panel">
                        <div class="content">
                            @yield('content')
                        </div>
                    </div>
                    <div class="weui-tabbar">
                        <div class="weui-tabbar__item" data-page="/wx">
                            <div style="display: inline-block; position: relative;">
                                <img src="/images/wx-tabbar/a_fill-home.svg" alt="" class="weui-tabbar__icon">
                            </div>
                            <p class="weui-tabbar__label">首页</p>
                        </div>
                        <div class="weui-tabbar__item" data-page="/wx/post/create">
                            <div style="display: inline-block; position: relative;">
                                <img src="/images/wx-tabbar/a_square-add.svg" alt="" class="weui-tabbar__icon">
                            </div>
                            <p class="weui-tabbar__label">免费发布</p>
                        </div>
                        <div class="weui-tabbar__item" data-page="/wx/user">
                            <div style="display: inline-block; position: relative;">
                                <img src="/images/wx-tabbar/a_user.svg" alt="" class="weui-tabbar__icon">
                            </div>
                            <p class="weui-tabbar__label">我的</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://res.wx.qq.com/open/libs/weuijs/1.2.1/weui.min.js"></script>
    <script src="https://res.wx.qq.com/open/libs/weuijs/1.2.1/weui.min.js"></script>
    <script src="{{ mix('js/wx.js') }}"></script>
    @yield('extend_js')
</body>
</html>