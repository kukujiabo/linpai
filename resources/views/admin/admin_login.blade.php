<!doctype html>
<html>
  <meta charset="utf-8">
  <link href="{{asset('/css/site.css')}}" rel="stylesheet">
  <link href="{{asset('/css/app.css')}}" rel="stylesheet">
<head>
</head>
<body style="background: #eee;">
<div id="admin-login">
  <div class="a-login-block">
    <h2><span class="glyphicon glyphicon-lock"></span> 运营后台登录</h2>
    
    <form class="form" method="post" action="/admin/login" id="admin_login_form">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <fieldset>
      <div class="alert alert-danger text-left hide" id="login-tips"></div>
      <div class="form-group">
        <label for="username" class="control-label"> 
          用户名
        </label>
        <input class="form-control" type="text" name="admin_name" id="username" title="用户名">
      </div>
      <div class="form-group">
        <label for="password" class="control-label">
          密码
        </label>
        <input class="form-control" type="password" name="password" id="password" title="密码">
      </div>
      <p>
        <button type="submit" role="button" id="log-submit">登录</button>
      </p>
      </fieldset>
    </form>
    <div style="clear:both"></div>
  </div>
</div>
</body>
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.form.js') }}"></script>
<script type="text/javascript" src="{{asset('js/administrator.js')}}"></script>
</html>
