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
    <div class="margin-5" style="width:100%;padding:0px 10px;">
      <div class="navbar-header theme-font-blue">
        <!-- <img src="/imgs/logo-linpai.png" width="100px"> -->
        <h3>51临牌管理后台</h3>
      </div>
      <div class="nav navbar-nav navbar-right hidden-sm">
        <form class="form" method="post" action="/{{$route}}/logout" style="margin-top:20px;padding:0 30px;">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="btn-group">
            <button type="button" id="message_btn" class="btn btn-info btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:50px;">
              <span class="glyphicon glyphicon-envelope"></span>
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="#">合作商户&nbsp; <span id="unread_coop">0</span></a></li>
              <li><a href="#">订单&nbsp<span id="unread_order">0</span></a></li>
            </ul>
          </div>
          <button class="btn btn-warning btn-sm" style="width:50px;" role="button" type="submit">退出</button>
        </form>
      </div>
      <div style="clear:both;"></div>
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
          <a href="/{{$route}}">
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
  <audio id="bb" src="/media/6124.wav"></audio>
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/jquery.form.js')}}"></script>
<script src="{{ asset('js/jquery.ui.widget.js')}}"></script>
<script src="{{ asset('js/jquery.fileupload.js') }}"></script>
<script src="{{ asset('js/administrator.js')}}"></script>
</body>
</html>
