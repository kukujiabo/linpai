<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="临牌,牌照,号牌,临时牌照,车辆牌照,汽车,车牌号">
	<title>51临牌 临时牌照 号牌 服务商</title>
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/jquery.fileupload.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/animate.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/site.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="/favicon.ico"/>
</head>
@if (empty($auth)) 
<body>
@else
<body style="background: #eee">
@endif
@yield('model-box')
<!--<header id="header" class="header header--fixed hide-from-print animated flipInX" role="banner"> -->
<header id="" class="header" role="banner" style="border-bottom:1px solid #eee;">
  <nav class="navbar no-margin" style="background:#fff;">
    <div class="padding-5">
      <div style="color: #999;margin-left:70%">
        周一至周日 10:30 － 18:00&nbsp; 
        <b style="color: #FF8800"><i><span class="glyphicon glyphicon-earphone"></span>&nbsp;&nbsp;4000602620</i></b>
      </div> 
    </div>
    <hr style="margin:0px;">
  	<div class="container-fluid margin-wide padding-15">
  		<div class="navbar-header">
  			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
  				<span class="sr-only">Toggle Navigation</span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  			</button>
        <a class="padding-5" href="/home">
          <img alt="Brand" src="{{ asset('/imgs/logo-linpai.png') }}" class="logo">
        </a>
        <div class="dropdown" style="display:inline;">
          <button class="btn btn-default dropdown-toggle no-border" type="button" id="nav-province" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          <span class="selected-province">上海市</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="caret"></span>
          </button>
          <!-- id="nav-province-list" -->
          <ul class="dropdown-menu"  aria-labelledby="nav-province" style="width:400px;margin:20px;">
            <li style=""><a href="#">目前仅对上海地区开放</a></li>
          </ul>
          <img src="/imgs/slogan.png">
        </div>
        <div style="clear:both;"></div>
  		</div>
  		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  		  <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url('/text/metaguide') }}" class="font-black"><span class="glyphicon glyphicon-file" style="color:#138ed1;"></span>&nbsp;办理材料指南</a></a>  
  				@if (Auth::guest())
  					<li><a href="{{ url('/auth/login') }}" class="font-black">登录</a></li>
  					<li><a href="{{ url('/auth/register') }}" class="font-black">注册</a></li>
  				@else
  					<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="glyphicon glyphicon-user theme-font-blue"></span>
                  &nbsp;&nbsp;Hi,&nbsp;{{ Auth::user()->name }}
                <span class="caret"></span></a>
  						<ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('/profile/myorder') }}" class="font-black">个人设置</a></li>
  							<li><a href="{{ url('/auth/logout') }}" class="font-black">退出</a></li>
  						</ul>
  					</li>
  				@endif
          <li>
            <div class="menu-gray">
              <img src="/imgs/select-good.png">
              <a href="{{ url('/profile/myorder') }}" class="font-black">
                <b>我的订单</b>
              </a>
            </div>
          </li>
          <!--
          <li>
            <a href="{{ asset('news')}}" class="font-black">&nbsp;&nbsp;新闻</a>
          </li>
          -->
  			</ul>
  		</div>
  	</div>
  </nav>
</header>
@yield('banner')

@if (empty($home))
<div class="container content-body">
  <div class="wrapper">
    <div class="process">
      @yield('process')
    </div>
	  @yield('content')
  </div>
@else

<div class="top-50 content-body">
	  @yield('content')
</div>
@endif
<div id="b-top" class="hide">
  <a href="javascript:void();">
    <span class="glyphicon glyphicon-triangle-top"></span> TOP
  </a>
</div>
</div>
<footer class="footer foot-bar">
  <div class="footer-top">
    <p>
      <b>
        <i style="color: #FF8800;font-size: 24px;"><span class="glyphicon glyphicon-earphone"></span>4000602620</i>
      </b>
    </p>
    <p>周一到周日 10:30 － 18:00</p>
    <hr style="border-top: #ddd 1px solid;">
    <div class="t-center footer-link">
      <div class="col-md-6 col-md-offset-3 text-center">
        <a class="bottom-link" href="{{asset('text/contact')}}">联系我们</a> |
        <a class="bottom-link" href="{{asset('communitcate/cooperation')}}">成为服务商</a> |
        <a class="bottom-link" href="{{asset('text/problems')}}">常见问题与解答</a> |
        <a class="bottom-link i-img" href="#" id="wechat-qrcode" data-disclass="tiny-flow-img" data-flow-pos="above" data-url="{{asset('imgs/wechat-code.jpg')}}">
          <img class="contact-icon" src="{{ asset('imgs/wechat.png') }}">
           微信</a> |
        <a class="bottom-link" target="_blank" href="http://weibo.com/51linpai">
          <img class="contact-icon" src="{{ asset('imgs/weibo.png') }}">
          新浪微博</a>
      </div>
      <div style="clear:both"></div>
    </div>
  </div>
  <br>
  <div class="footer-bottom">
    <div class="col-md-offset-3 col-md-6 text-center">
      @2015 51LinPai all rights reserved 沪ICP备 15037577
    </div>
    <div style="clear:both"></div>
  </div>
  <br>
</footer>
	<!-- Scripts -->
  <!--
  <script src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
	<script src="http://cdn.bootcss.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  -->
  <script src="{{ asset('js/jquery.min.js')}}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery.form.js') }}"></script>
  <script src="{{ asset('js/jquery.ui.widget.js') }}"></script>
  <script src="{{ asset('js/jquery.fileupload.js') }}"></script>
  <script src="{{ asset('js/site.js') }}"></script>
<script type="text/javascript">
  with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>
</body>
</html>
