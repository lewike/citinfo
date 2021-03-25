<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <title>在息县网 - 息县免费发布便民生活信息平台 | www.zaixixian.com</title>
    <meta name="description"
        content="在息县网，致力于打造息县最全面的本地便民信息服务平台，覆盖息县招聘求职，二手房信息，租房信息，房产信息，房屋出租信息，供求信息，二手车信息，招生信息，服务信息，本地商家活动推广等，永久免费发布便民信息！">
    <meta name="keywords" content="息县，息县网，在息县网，息县租房，息县招聘，息县房产，息县房屋出租，息县求职，息县二手房，息县二手车">
    <meta name="author" content="daidongsheng">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{mix("/css/website.css")}}">
</head>
<body class="container-lg">
    @include('common.website.header')
    @yield('content')
    @include('common.website.footer')
    </div>
    <script src="{{mix("/js/website.js")}}"></script>
    @yield('extend_js')
</body>
</html>