@extends('mobile/mobile')

@section('content')

<div data-role="page">
  <div data-role="header" data-position="fixed">
    <h1>会员注册 - 51临牌</h1>
  </div>
  <div data-role="popup" id="err_popup" data-position-to="window" class="ui-content" data-overlay-theme="b">
    <p id="err_msg"></p>
  </div>
  <a href="#err_popup" data-rel="popup" id="trigger_popup"></a>
  <div data-role="content" class="text-center ui-content" id="register-board">
    <img src="{{asset('/imgs/logo-linpai-mobile.png')}}" class="logo"> 
    <div class="form-block">
      <form class="form" data-ajax="false" action="{{asset('auth/register')}}" method="post" id="register_form">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
          <input type="text" name="mobile" placeholder="请输入手机号"> 
          <div class="clear"></div>
        </div>
        <div class="form-group">
          <div class="ui-input-text ui-body-inherit no-margin ui-corner-all ui-shadow-inset" data-inline="true" style="width:60%;float:left">
            <input data-role="none"  type="text" name="verify_code" placeholder="请输入验证码"> 
          </div>
          <div class="ui-btn ui-input-btn ui-corner-all ui-shadow no-margin ui-btn-inline ui-mini" style="margin-left:1px;float:left;">
            <a href="{{asset('/verify/regsms')}}" id="send_code" style="margin-top:3px;">发送验证码</a>
          </div>
          <div class="clear"></div>
        </div>
        <div class="form-group">
          <input type="text" name="name" placeholder="请输入用户名">
          <div class="clear"></div>
        </div>
        <div class="form-group">
          <input type="email" name="email" placeholder="请输入邮箱">
          <div class="clear"></div>
        </div>
        <div class="form-group">
          <input type="password" name="password" placeholder="请输入密码">
          <div class="clear"></div>
        </div>
        <div class="form-group">
          <label class="form-label" for="readed">
            <input type="checkbox" id="readed" name="readed_license" checked>
            <span>我已阅读且同意</span>
            <a href="#">《51临牌使用协议》</a>
          </label> 
        </div>
        <div class="form-group" style="margin: 20px 0px;">
          <button role="button" id="reg_submit">提交</button>
        </div>
      </form>
    </div>
  </div>
  <div data-role="footer">
    <h2>www.51linpai.com</h2>
  </div>
</div>
<script type="text/javascript">

  $(document).on('pageinit', function (event) {
  
    var regForm = $('#register_form');
  
    var regSubmit = $('#reg_submit');
  
    var popupBtn = $('#trigger_popup');
  
    var errcontent = $('#err_msg');

    var _token = $('input[name=_token]').val();
  
    regForm.ajaxForm();
  
    var registerOptions = {
    
      'dataType': 'json',
  
      success: function (data) {

        console.log(data);

        if (data.code == 1) {

          console.log(data);
        
          errcontent.html('注册成功！');
  
          popupBtn.click();
        
        } else {
        
          var msg = data.msg;

          console.log(msg);
        
        }
  
      },
      
      error: function (err) {
      
        console.log(err);
      
      }
    
    };
  
    regSubmit.on('tap', function (e) {
    
      e.preventDefault();
  
      var mobile = $('input[name=mobile]').val();
  
      var verifyCode = $('input[name=verify_code]').val();

      var username = $('input[name=name]').val();

      var email = $('input[name=email]').val();

      var password = $('input[name=password]').val();

      if (verifyCode == undefined || verifyCode.length != 6) {

        errcontent.html('请输入6位有效验证码！');

        popupBtn.click();

        return;
      
      }

      if (username == undefined || username.length < 4) {

        errcontent.html('昵称至少为4个英文字符或2个汉字。');

        popupBtn.click();

        return;
      
      }

      if (email == undefined || email.length == 0) {
      
        errcontent.html('请输入有效邮箱！');

        popupBtn.click();

        return;
      
      }

      if (password == undefined || password.length < 6 || password.length > 18) {
      
        errcontent.html('请输入6-18位密码！');

        popupBtn.click();
      
        return;

      }
  
      regForm.ajaxSubmit(registerOptions);
    
    });
  
    var sendVerify = $('#send_code');

    sendVerify.on('tap', function (event) {
    
      event.preventDefault();

      var that = $(this);

      var dataUrl = that.attr('href');

      var mobile = $('input[name=mobile]').val();

      if (mobile == undefined || mobile.length != 11) {

        errcontent.html('请输入11位有效手机号！');
      
        popupBtn.click();

        return;
      
      }

      $.post(dataUrl, {
      
        mobile: mobile,

        _token: _token
      
      }, function (data) {
      
        if (data.code = 1) {
        
          var res = data.res[0].status;

          if (res == 'success') {
          
            errcontent.html('验证短信已发送！');
          
          } else {

            errcontent.html('短信发送失败，请联系管理员！');
          
          }
        
          popupBtn.click();

        }
      
      }, 'json');
    
    });
  
  });

</script>

@endsection
