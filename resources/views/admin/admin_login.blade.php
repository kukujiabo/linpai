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
    <form class="form" method="post" action="#">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <fieldset>
      <div class="form-group">
        <label for="username" class="control-label"> 
          用户名
        </label>
        <input class="form-control" type="text" name="username" id="username">
      </div>
      <div class="form-group">
        <label for="password" class="control-label">
          密码
        </label>
        <input class="form-control" type="password" name="password" id="password">
      </div>
      <p>
        <button type="submit" role="button">登录</button>
      </p>
      </fieldset>
    </form>
    <div style="clear:both"></div>
  </div>
</div>
</body>
</html>
