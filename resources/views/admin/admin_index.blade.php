<!doctype html>
<html>
<head>
  <meta charset="utf8">
  <link href="{{asset('/css/app.css')}}" rel="stylesheet">
  <link href="{{asset('/css/site.css')}}" rel="stylesheet">
  <link rel="shortcut icon" href="/favicon.ico"/>
</head>
<body style="width:100%;height:100%;">
  <header class="navbar navbar-static-top no-margin" id="top" role="banner">
    <div class="container margin-5">
      <div class="navbar-header theme-font-blue">
        <!-- <img src="/imgs/logo-linpai.png" width="100px"> -->
        <h3>51临牌管理后台</h3>
      </div>
    </div>
  </header>
  <hr class="no-margin no-padding">
  </nav>
  <div class="row">
    <div class="col-md-1 nav-vertical sidebar">
      <ul class="nav nav-sidebar">
        <li role="presentation" style="font-size:50px;color:#f95252;">
          <span class="glyphicon glyphicon-cd"></span>
        </li>
        <li role="presentation">
          <a href="/admin">
            <span class="glyphicon glyphicon-home theme-orig"></span>
          </a>
        </li>
        <li role="presentation">
          <a href="/userboard">
            <span class="glyphicon glyphicon-user theme-orig"></span>
          </a>
        </li>
        <li role="presentation">
          <a href="/orderboard">
            <span class="glyphicon glyphicon-list theme-orig"></span>
          </a>
        </li>
        <li role="presentation">
          <a href="/coopboard">
            <span class="glyphicon glyphicon-link theme-orig"></span>
          </a>
        </li>
        <li role="presentation">
          <a href="/adboard">
            <span class="glyphicon glyphicon-picture theme-orig"></span>
          </a>
        </li>
        <li role="presentation">
          <a href="#">
            <span class="glyphicon glyphicon-hdd theme-orig"></span>
          </a>
        </li>
      </ul>
    </div>
    <div class="col-md-11">
      <div class="admin-content">
        <h3 class="theme-orig">{{$pageName}}</h3>
        <hr>
        @yield('content')
      </div>
    </div>
  </div>
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/jquery.form.js')}}"></script>
<script src="{{ asset('js/jquery.ui.widget.js')}}"></script>
<script src="{{ asset('js/administrator.js')}}"></script>
</body>
</html>
