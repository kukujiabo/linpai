<!Doctype html>
<html>
<head>
  @if (!empty($wTitle))
    <title> {{$wTitle}} - 51临牌</title>
  @else
    <title>51临牌</title>
  @endif
  <meta name="keywords" content="临牌 车牌" />     
  <meta name="description" content="首页描述" />     
  <meta http-equiv="Content-Type" content="charset=utf-8" />     
  <meta http-equiv="Cache-Control" content="no-cache" />     
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
  <meta name="apple-mobile-web-app-capable" content="yes" />     
  <link rel="stylesheet" href="{{asset('css/jquery.mobile-1.4.5.min.css')}}" >
  <link rel="stylesheet" href="{{asset('css/mobile.css')}}">
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/xmlObject.js')}}"></script>
  <script src="{{asset('js/jquery.mobile-1.4.5.min.js')}}"></script>
  <script src="{{asset('js/jquery.form.js')}}"></script>
  <script src="{{asset('js/minisite.js')}}"></script>
  <script src="{{asset('js/jquery.fileupload.js')}}"></script>
  <script src="{{asset('js/jweixin.js')}}"></script>
  <script type="text/javascript">
    wx.config({
      debug: false,
      appId: 'wx893e94beb01b53fc',
      nonceStr: '',
      signature: '', 
      jsApiList: []
    });
  </script>
</head>
<body>

  @yield('content') 

</body>
</html>
