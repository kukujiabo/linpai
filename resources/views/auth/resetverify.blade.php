@extends('app')

@section('content')
<div class="padding-20"></div>
<div class="container-fluid">
  <div class="col-xs-8 col-xs-offset-2">
    <div class="panel panel-default"> 
      <div class="panel-body">
        <h3 class="text-center no-padding">重设密码</h3>
        <hr>
        <div class="padding-5">
          <div class="alert alert-danger hide" id="reset-notice"></div>
        </div>
        <form class="form-horizontal" method="post" id="passwd_reset_form" action="/user/passwdreset">
          <input type="hidden" name="_token" value={{csrf_token()}}>
          <fieldset>
            <div class="form-group">
              <label class="control-label col-xs-3">您的手机号</label>
              <div class="col-xs-5">
                <input type="text" value={{$mobile}} disabled class="no-border form-control no-shadow" style="background:#fff">
                <input type="hidden" value={{$mobile}} name="mobile">
              </div> 
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group">
              <label class="control-label col-xs-3">短信验证码</label>
              <div class="col-xs-5">
                <input type="text" class="form-control" name="reset_code" title="短信验证码">
              </div> 
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group">
              <label class="control-label col-xs-3">创建密码</label>
              <div class="col-xs-5">
                <input type="password" class="form-control" name="newpassword" title="新密码">
              </div> 
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group">
              <label class="control-label col-xs-3">确认密码</label>
              <div class="col-xs-5">
                <input type="password" class="form-control" name="confirmpassword" title="确认密码">
              </div> 
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group padding-20">
              <div class="col-xs-offset-3">
                <button class="btn btn-primary" type="submit" id="passwd_reset_submit" role="button">重设密码</button>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  window.onload = function () {
  
    $('body').css({background: '#eee'});

  };
</script>
@endsection
