<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>@yield('title', '')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="icon" href="/favicon_pinche.ico">
    <link href="{{mix('css/pinche.css')}}" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <div class="page">
      <div class="page__bd" style="height: 100%;">
      @yield('content')
      </div>
    </div>
    </div>
    <script src="{{mix('js/pinche.js')}}"></script>
    <script src="//res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
    @yield('extend_js')
  </body>
</html>