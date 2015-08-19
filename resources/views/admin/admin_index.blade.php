<!doctype html>
<html>
<head>
  <meta charset="utf8">
  <link href="{{asset('/css/app.css')}}" rel="stylesheet">
  <link href="{{asset('/css/site.css')}}" rel="stylesheet">
</head>
<body style="width:100%;height:100%;">
  <header class="navbar navbar-static-top no-margin" id="top" role="banner">
    <div class="container">
      <div class="navbar-header">
      </div>
    </div>
  </header>
  </nav>
  <div class="row">
    <div class="col-md-1 nav-vertical sidebar">
      <ul class="nav nav-sidebar">
        <li role="presentation" style="font-size:50px;color:#f95252;">
          <span class="glyphicon glyphicon-cd"></span>
        </li>
        <li role="presentation">
          <a href="#">
            <span class="glyphicon glyphicon-home"></span>
          </a>
        </li>
        <li role="presentation">
          <a href="#">
            <span class="glyphicon glyphicon-user"></span>
          </a>
        </li>
        <li role="presentation">
          <a href="#">
            <span class="glyphicon glyphicon-list"></span>
          </a>
        </li>
        <li role="presentation">
          <a href="#">
            <span class="glyphicon glyphicon-hdd"></span>
          </a>
        </li>
      </ul>
    </div>
    <div class="col-md-11">
      <div class="admin-content">
        <h4 class="page-header">{{$pageName}}</h4>
        @yield('content')
      </div>
    </div>
  </div>
</body>
</html>
