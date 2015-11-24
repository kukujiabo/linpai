@extends('mobile/mobile')

@include('mobile/head')

@section('content')

<div data-role="page">
  <div data-role="header" data-position="fixed">
    @yield('header')
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
          <div class="ui-input-text ui-body-inherit " data-inline="true">
            <input type="text" data-role="none" name="mobile" placeholder="请输入手机号"> 
            <div class="clear"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="ui-input-text ui-body-inherit no-margin" data-inline="true" style="width:57%;float:left">
            <input data-role="none"  type="text" name="verify_code" placeholder="请输入验证码"> 
            <div class="clear"></div>
          </div>
          <div class="ui-btn ui-mini blue_white" style="margin:0px;float:right;width:31%;">
            <a href="{{asset('/verify/regsms')}}" class="blue_white_button no-shadow" id="send_code" style="margin-top:0px;">发送验证码</a>
          </div>
          <div class="clear"></div>
        </div>
        <div class="form-group">
          <div class="ui-input-text ui-body-inherit " data-inline="true">
          <input data-role="none" type="text" name="name" placeholder="请输入用户名">
          <div class="clear"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="ui-input-text ui-body-inherit " data-inline="true">
            <input data-role="none" type="email" name="email" placeholder="请输入邮箱">
            <div class="clear"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="ui-input-text ui-body-inherit " data-inline="true">
            <input data-role="none" type="password" name="password" placeholder="请输入密码">
            <div class="clear"></div>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label" for="readed">
              <input data-role="none" type="checkbox" id="readed" name="readed_license" checked>
              <span>我已阅读且同意</span>
              <a href="/mobile/items">《51临牌使用协议》</a>
          </label> 
        </div>
        <div class="form-group" style="margin: 20px 0px;">
          <div class="ui-btn ui-input-btn blue_full_btn" style="margin:0px;">
            <a role="button" type="submit" class="blue_full_btn" id="reg_submit">提交</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  </div>
</div>
<script type="text/javascript">

  $(document).on('pageinit', function (event) {
  
    var regForm = $('#register_form');
  
    var regSubmit = $('#reg_submit');
  
    var popupBtn = $('#trigger_popup');
  
    var errcontent = $('#err_msg');

    var _token = $('input[name=_token]').val();

    var sendVerify = $('#send_code');

    var countTime;

    var timer;

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

    var tapVerify =  function (event) {
  
      event.preventDefault();

      var that = $(this);

      var dataUrl = that.attr('href');

      var mobile = $('input[name=mobile]').val();

      if (mobile == undefined || mobile.length != 11) {

        errcontent.html('请输入11位有效手机号！');
      
        popupBtn.click();

        return;
      
      }

      $.ajax({

        url: dataUrl,

        type: 'post',

        data: {
      
          mobile: mobile,

          _token: _token

        },

        dataType: 'json',

        success: function (data) {

          if (data.code == 1) {
          
            var res = data.res[0].status;

            if (res == 'success') {

              countTime = 30;
            
              errcontent.html('验证短信已发送！');

              sendVerify.unbind('tap');

              sendVerify.on('tap', function (e) {

                e.preventDefault();
              
              });

              //timer = setInterval(setTime, 1000);

            } else {

              errcontent.html('短信发送失败，请联系管理员！');
            
            }
          
            popupBtn.click();

          } else {
          
            alert(data.msg);
          
          }
      
        },

        error: function (err) {
        
          alert(err);
        
        }
      
      });

    };

    var setTime = function() {
    
      if (!countTime) {
      
        window.clearInterval(timer);

        sendVerify.on('tap', tapVerify);

        sendVerify.html('发送验证码');
      
      } else {
      
        countTime--;
      
        sendVerify.html('重新获取(' + countTime + ')');
      
      }
    
    };
  
    sendVerify.on('tap', tapVerify);
    
  });


</script>

@endsection
