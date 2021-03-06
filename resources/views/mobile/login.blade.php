@extends('mobile/mobile')

@include('mobile/head')

@section('content')

<div data-role="page">
  <div data-role="header" data-position="fixed">
    @yield('header')
  </div>
  <div role="main">
    <div data-role="popup" id="err_popup" data-position-to="window" class="ui-content">
      <p id="err_msg"></p>
    </div>
    <a href="#err_popup" data-rel="popup" id="trigger_err"></a>
    <div class="text-center" id="login-board">
      <img style="margin-top:50px" src="{{asset('/imgs/logo-linpai-mobile.png')}}" class="logo" />
      <div class="form-block">
        <div class="" id="err-list">
        </div>
        <form class="form" data-role="none"  style="margin-top:80px;" id="login-form" data-ajax="false" action="{{asset('/user/ajaxlogin')}}" method="post">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group"> 
            <div class="ui-input-text ui-body-inherit " data-inline="true">
              <input data-role="none" type="text" name="mobile" placeholder="请输入手机号">
            </div>
          </div>
          <div class="form-group">
            <div class="ui-input-text ui-body-inherit " data-inline="true">
              <input type="password" data-role="none" name="password" placeholder="请输入密码">
            </div>
          </div>
          <div class="options-inline">
            <a href="{{asset('/mobile/password')}}"  data-ajax="false" style="float:left;color: #d9534f">忘记密码</a>    
            <a href="{{asset('/mobile/register')}}" data-ajax="false" style="float:right">点击注册</a>  
            <span style="float:right">没有51临牌账号？</span>
          </div>
          <div class="clear"></div>
          <div class="form-group" style="margin-top:90px">
            <button type="submit" data-ajax="false" id="login-submit" class="blue_full_btn no-radius no-shadow" >登录</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript">

  $(document).on('pagecreate', function (event) {

    var loginBtn = $('#login-submit');

    var loginForm = $('#login-form');

    var errMsg = $('#err_msg');

    var errPopup = $('#trigger_err');

    loginForm.ajaxForm();

    var loginOptions = {
    
      dataType: 'json',

      success: function (data) {
      
        if (data.code == 1) {

          @if (empty($pre_url))

           $.mobile.changePage('/mobile/profile');

          @else

            $.mobile.changePage('{{$pre_url}}');

          @endif
        
        } else {
        
          var msg = data.msg;

          switch (msg) {
          
            case 'invalid_mobile':

              errMsg.html('请输入11位有效手机号！');

              break;
            case 'invalid_password':

              errMsg.html('请输入6-18位密码！');

              break;
            case 'user_not_found':

              errMsg.html('用户不存在！');

              break;
            case 'attemp_fail':

              errMsg.html('账号或密码错误！');

              break;
          
          }

          errPopup.click();
        
        }
      
      },
    
      error: function (err) {
      
        console.log(err);
      
      }
    
    };

    loginBtn.on('tap', function (e) {

      e.preventDefault();

      var mobile = $('input[name=mobile]').val();

      var password = $('input[name=password]').val();

      if ($mini.isMobile(mobile) && password != undefined && password.length > 5) {
      
        loginForm.ajaxSubmit(loginOptions);
      
      } else {

        var err = '';

        if (!$mini.isMobile(mobile)) {
        
          errMsg.html('请输入11位有效手机号！');

          errPopup.click();

          return;
        }

        if (password == undefined || password == '' || (password.length < 6 || password.length > 18)) {
        
          errMsg.html('请输入6-18位密码！');

          errPopup.click();

          return;
        }

      
      }
    
    });

  });
</script>
</div>
@endsection

