<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>抢购活动</title>
  <link rel="stylesheet" href="{{ mix('css/app.css')}}">
</head>
<body>
  <div class="container">
    <div class="page tabbar js_show">
      <div class="page__bd" style="height: 100vh">
        <div class="weui-tab">
          <div class="weui-tab__panel market-list">
            <ul>
              <li><a href="/market/single/1"><img src="https://iph.href.lu/750x400?fg=666666&bg=ffffff" alt=""></a></li>
              <li><img src="https://iph.href.lu/750x400?fg=666666&bg=ffffff" alt=""></li>
            </ul>
          </div>
          <div class="weui-tabbar">
            <div class="weui-tabbar__item">
              <img src="/images/home.svg" alt="" class="weui-tabbar__icon">
              <p class="weui-tabbar__label">最新活动</p>
            </div>
            <div class="weui-tabbar__item">
              <a href="/market/orders">
                <img src="/images/user.svg" alt="" class="weui-tabbar__icon">
                <p class="weui-tabbar__label">我的订单</p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>