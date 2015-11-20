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
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
  
  var source = new EventSource('http://localhost:8000/order/wxorder');

  var jumpUrl = "http://localhost:8000/order/paysuccess?order_code={{$order_code}}";

  source.onopen = function () {
  
    console.log('connected.');

  };

  source.onmessage = function (evnet) {

    var notice = evnet.data;

    console.log(notice);

    if (notice == 'yes') {
    
      window.location.href=jumpUrl;
    
    }
  
  };

  source.onerror = function (evnet) {

  };

</script>
</html>

