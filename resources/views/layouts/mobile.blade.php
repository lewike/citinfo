<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$config['index_seo_title'] ?? ''}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="{{$config['index_seo_desc']}}">
    <meta name="keywords" content="{{$config['index_seo_keywords']}}">
    <meta name="author" content="daidongsheng">
    <link href="https://res.wx.qq.com/open/libs/weui/2.4.0/weui.min.css" rel="stylesheet">
    <link href="{{mix('css/wx.css')}}" rel="stylesheet">
</head>
<body>
    <div class="page-loading">
        <span><i class="weui-loading"></i> 页面加载中...</span>
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
                    <div class="weui-tabbar">
                        <div class="weui-tabbar__item" data-page="/">
                            <div style="display: inline-block; position: relative;">
                                <img src="/images/wx-tabbar/a_home.svg" data-onit="/images/wx-tabbar/a_fill-home.svg" alt="" class="weui-tabbar__icon">
                            </div>
                            <p class="weui-tabbar__label">首页</p>
                        </div>
                        <div class="weui-tabbar__item" data-page="/post/create">
                            <div style="display: inline-block; position: relative;">
                                <img src="/images/wx-tabbar/a_square-add.svg" data-onit="/images/wx-tabbar/a_fill-square-add.svg" alt="" class="weui-tabbar__icon">
                            </div>
                            <p class="weui-tabbar__label">免费发布</p>
                        </div>
                        <div class="weui-tabbar__item" data-page="/user">
                            <div style="display: inline-block; position: relative;">
                                <img src="/images/wx-tabbar/a_user.svg" data-onit="/images/wx-tabbar/a_fill-user.svg" alt="" class="weui-tabbar__icon">
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