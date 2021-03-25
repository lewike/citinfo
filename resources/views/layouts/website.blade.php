<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <title>{{$config['index_seo_title'] ?? ''}}</title>
    <meta name="description"
        content="{{$config['index_seo_desc']}}">
    <meta name="keywords" content="{{$config['index_seo_keywords']}}">
    <meta name="author" content="daidongsheng">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{mix("/css/website.css")}}">
</head>
<body class="container-lg">
    @include('common.website.header')
    @yield('content')
    @include('common.website.footer')
    <div class="d-none">
        {!!$config['tongji']!!}
      </div>
    <script src="{{mix("/js/website.js")}}"></script>
    @yield('extend_js')
</body>
</html>