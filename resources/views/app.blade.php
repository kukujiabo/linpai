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
<body>
<header id="header" class="header header--fixed hide-from-print animated flipInX" role="banner">
  <nav class="navbar" style="background:#fff;">
    <div class="padding-5">

    </div>
  	<div class="container-fluid">
  		<div class="navbar-header">
  			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
  				<span class="sr-only">Toggle Navigation</span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  			</button>
        <a class="navbar-brand" href="#">
          <img alt="Brand" src="{{ asset('/imgs/51.png') }}" style="width: 70px;"> 
        </a>
        <div style="clear:both;"></div>
  		</div>
  		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" id="drop-selected" class="dropdown-toggle" data-toggle="dropdown">
              上海
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="drop-selected">
              <li role="presentation" class="dropdown-header">华北</li>
              <li role="presentation" class="divider"></li>
              <li><a tabindex="-1" href="#">北京</a></li>
              <li><a tabindex="-1"  href="#">天津</a></li>
              <li role="presentation" class="divider"></li>
              <li role="presentation" class="dropdown-header">华中</li>
              <li role="presentation" class="divider"></li>
              <li><a tabindex="-1"  href="#" role="menuitem" >上海</a></li>
              <li><a tabindex="-1"  href="#" role="menuitem" >南京</a></li>
            </ul>
          </li>
        </ul>
  		  <ul class="nav navbar-nav navbar-right">
  				<li><a href="{{ url('/') }}">首页</a></li>
  				<li><a href="{{ url('/profile/myorder') }}">我的订单</a></li>
          <li><a href="{{ url('/') }}">办理材料指南</a></a>  
  				@if (Auth::guest())
  					<li><a href="{{ url('/auth/login') }}">登陆</a></li>
  					<li><a href="{{ url('/auth/register') }}">注册</a></li>
  				@else
  					<li class="dropdown">
  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Hi,&nbsp;{{ Auth::user()->name }} <span class="caret"></span></a>
  						<ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('/profile') }}">个人设置</a></li>
  							<li><a href="{{ url('/auth/logout') }}">登出</a></li>
  						</ul>
  					</li>
  				@endif
  			</ul>
  		</div>
  	</div>
  </nav>
</header>
@yield('banner')

<div class="container top-100 content-body">

  <div class="wrapper">

    <div class="process">
      @yield('process')
    </div>

	  @yield('content')

  </div>
<div id="b-top">
  <a href="javascript:void();">
    <span class="glyphicon glyphicon-triangle-top"></span> TOP
  </a>
</div>
</div>
<footer class="footer foot-bar">
  <div class="footer-top">
    <p>
        <span>4006937465</span>
    </p>
    <div class="t-center footer-link row">
      <div class="col-md-2">
      </div>
      <div class="col-md-1">
        <a class="c" href="#">联系我们</a>
      </div>
      <div class="col-md-2">
        <a href="#">成为服务商</a>
      </div>
      <div class="col-md-2">
        <a href="#">常见问题与解答</a>
      </div>
      <div class="col-md-1">
        <a href="#">
          <img class="contact-icon" src="{{ asset('imgs/qq.png') }}">
          QQ</a>
      </div>
      <div class="col-md-1">
        <a href="#">
          <img class="contact-icon" src="{{ asset('imgs/wechat.png') }}">
           微信</a>
      </div>
      <div class="col-md-1">
        <a href="#">
          <img class="contact-icon" src="{{ asset('imgs/weibo.png') }}">
          新浪微博</a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    @2015 51LINP AI ALL rights reserved 沪ICP备 14020180
  </div>
</footer>
	<!-- Scripts -->
  <script src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script>
  <!--
  <script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="http://cdn.bootcss.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery.ui.widget.js') }}"></script>
  <script src="{{ asset('js/jquery.fileupload.js') }}"></script>
  <script src="{{ asset('js/site.js') }}"></script>

</body>
</html>
