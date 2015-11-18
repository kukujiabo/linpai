<!doctype html>
<html>
<head>
  <title>微信支付 － 51临牌</title>
	<meta charset="utf-8">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/site.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="/favicon.ico"/>
</head>
<body>
  <div class="container" style="padding:5%">
    <div class="jumbotron row text-center" style="width:100%;height:100%">
      <h3 class="page-header" style="color:#aaa"><img src="/imgs/weixinpay.png" width=40px>&nbsp;&nbsp;请使用微信扫描下方二维码并支付</h3>
      <div class="col-sm-4 col-sm-offset-4">
        <div class="thumbnail">
          <img src="{{$qrcode}}" style="width:100%">
          <div class="caption theme-orig">
            <h4>{{$good->name}}</h4> 
            <p>
              ¥ {{$price}}
            </p>
          </div>
        </div>
        <hr>
        <h4 style="color:#aaa">www.51linpai.com</h4>
      </div>
    </div>
  </div>
</body>
</html>
