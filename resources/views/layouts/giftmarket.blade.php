<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>活动名称</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <link href="{{mix('css/app.css')}}" rel="stylesheet">
</head>

<body>
    <div class="loading d-none">
        <div class="spinner-grow"></div>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('extend_js')
</body>

</html>