<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>51临牌</title>
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/jquery.fileupload.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/site.css') }}" rel="stylesheet">
</head>
@if (empty($auth)) 
<body>
@else
<body style="background: #eee">
@endif
@yield('model-box')
<header id="header" class="header header--fixed hide-from-print animated flipInX" role="banner">
  <nav class="navbar no-margin" style="background:#fff;">
    <div class="padding-5">
      <div class="col-md-offset-9" style="color: #999">
        周一至周日 10:00 － 18:00 
        &nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #FF8800"><span class="glyphicon glyphicon-earphone"></span>&nbsp;&nbsp;4006937465</b>
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
        <a class="" href="/home">
          <img alt="Brand" src="{{ asset('/imgs/51.png') }}" style="width: 150px;">
        </a>
        <div style="clear:both;"></div>
  		</div>
  		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  		  <ul class="nav navbar-nav navbar-right" style="font-family:微软雅黑;">
          <li><a href="{{ url('/') }}" class="font-black">办理材料指南</a></a>  
  				@if (Auth::guest())
  					<li><a href="{{ url('/auth/login') }}" class="font-black">登录</a></li>
  					<li><a href="{{ url('/auth/register') }}" class="font-black">注册</a></li>
  				@else
  					<li class="dropdown">
  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Hi,&nbsp;{{ Auth::user()->name }} <span class="caret"></span></a>
  						<ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('/profile/myorder') }}" class="font-black">个人设置</a></li>
  							<li><a href="{{ url('/auth/logout') }}" class="font-black">登出</a></li>
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
  			</ul>
  		</div>
  	</div>
  </nav>
</header>
@yield('banner')

@if (empty($home))
<div class="container top-100 content-body">
  <div class="wrapper">
    <div class="process">
      @yield('process')
    </div>
	  @yield('content')
  </div>
@else

<div class="top-100 content-body">
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
        <i style="color: #FF8800;font-size: 24px;">
          <span class="glyphicon glyphicon-earphone"></span>
          4006937465</i>
        &nbsp;&nbsp;&nbsp;&nbsp;周一到周日 10:00 － 18:00
      </b>
    </p>
    <hr style="border-top: #ddd 1px solid;">
    <div class="t-center footer-link row">
      <div class="col-md-3">
      </div>
      <div class="col-xs-2 col-md-1">
        <a class="c" href="#">联系我们</a>
      </div>
      <div class="col-xs-3 col-md-2">
        <a href="{{asset('communitcate/cooperation')}}">成为服务商</a>
      </div>
      <div class="col-xs-3 col-md-2">
        <a href="#">常见问题与解答</a>
      </div>
      <div class="col-xs-2 col-md-1">
        <a href="#" id="wechat-qrcode" class="i-img" data-disclass="tiny-flow-img">
          <img class="contact-icon" src="{{ asset('imgs/wechat.png') }}">
           微信</a>
      </div>
      <div class="col-xs-2 col-md-1 no-border">
        <a href="#">
          <img class="contact-icon" src="{{ asset('imgs/weibo.png') }}">
          新浪微博</a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="col-xs-offset-2 col-md-offset-4">
      @2015 51LinPai all rights reserved 沪ICP备 15037577
    </div>
  </div>
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

</body>
</html>
