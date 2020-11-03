<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>登录-乐微Citinfo系统</title>
    <meta name="msapplication-TileColor" content="#206bc4"/>
    <meta name="theme-color" content="#206bc4"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="mobile-web-app-capable" content="yes"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="MobileOptimized" content="320"/>
    <meta name="robots" content="noindex,nofollow,noarchive"/>
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
    <!-- CSS files -->
    <link href="{{mix('css/admin.css')}}" rel="stylesheet"/>
    <style>
      body {
      	display: none;
      }
    </style>
  </head>
  <body class=" border-top-wide border-primary d-flex flex-column">
    <div class="flex-fill d-flex flex-column justify-content-center">
      <div class="container-tight py-6">
        <div class="text-center mb-6">
          <img src="/images/lewike-admin-logo.svg" height="36" alt="">
        </div>
        <form class="card card-md" method="post">
          <div class="card-body">
            <h2 class="mb-3 text-center">后台登录</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
              <label class="form-label">邮箱</label>
              <input type="email" name="email" class="form-control" placeholder="请输入邮箱" autocomplete="off">
            </div>
            <div class="mb-2">
              <label class="form-label">
                密码
              </label>
              <div class="input-group input-group-flat">
                <input type="password" name="password" class="form-control"  placeholder="请输入密码" >
              </div>
              @csrf
            </div>
            <div class="form-footer mb-3">
              <button type="submit" class="btn btn-primary btn-block">点击登录</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script>
      document.body.style.display = "block"
    </script>
  </body>
</html>