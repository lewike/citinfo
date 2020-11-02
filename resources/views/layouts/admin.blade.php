<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>后台管理</title>
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
    <link href="{{mix('css/admin.css')}}" rel="stylesheet"/>
  </head>
  <body class="antialiased">
    @include('common.admin.aside')
    <div class="page">
      <div class="content">
        @yield('content')
        <footer class="footer footer-transparent">
          <div class="container-fluid">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ml-lg-auto">
                Copyright © 2020
                <a href="." class="link-secondary">citinfo</a>.
                All rights reserved.
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                当前版本: v0.1
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="{{mix('js/admin.js')}}"></script>
    @yield('extend_js')
  </body>
</html>
