@extends('mobile/mobile')

@include('mobile/head')

@section('content')
  
<div data-role="page">
  <div data-role="header" data-position="fixed">
    @yield('header')
  </div>
  <div data-role="content" class="center-board text-center" >
    <div data-role="popup" id="err_popup" data-position-to="window" class="ui-content" data-overlay-theme="b">
      <p id="popup_msg">请输入11位有效手机号！</p>
    </div>
    <a href="#err_popup" data-rel="popup" id="popup_err"></a>
    <div class="form-block">
      <form action="{{asset('/user/passwdreset')}}" data-ajax="false" method="post" id="reset_pass_form">
        <input type="hidden" value="{{csrf_token()}}" name="_token">
        <div class="form-group">
          <div class="ui-input-text ui-body-inherit " data-inline="true">
            <input data-role="none" type="text" name="mobile" placeholder="请输入手机号">
          </div>
        </div>
        <div class="form-group">
          <div class="ui-input-text ui-body-inherit no-margin" data-inline="true" style="width:57%;float:left">
            <input data-role="none"  type="text" name="reset_code" placeholder="请输入验证码"> 
          </div>
          <div style="padding:8px 5px;" class="ui-btn  no-margin ui-mini blue_full_btn" style="margin-left:1px;float:left;width:31%" data-inline="true">
            <a href="#" id="reset_sms" class="ui-mini blue_full_btn" data-url="{{asset('/user/ajaxresetsms')}}">发送验证码</a>
          </div>
          <div class="clear"></div>
        </div>
        <div class="form-group">
          <div class="ui-input-text ui-body-inherit " data-inline="true">
            <input data-role="none" type="password" name="newpassword" placeholder="请输入新密码">
          </div>
        </div>
        <div class="form-group">
          <div class="ui-input-text ui-body-inherit " data-inline="true">
            <input data-role="none" type="password" name="confirmpassword" placeholder="确认新密码">
          </div>
        </div>
        <div class="form-group margin-top-50">
          <button type="submit" id="submit_form" class="blue_white_btn no-radius" style="font-size:16px;" >确认</button>
        </div>
      </form>
    </div>
  </div>

<script type="text/javascript">

  $(document).on("pagecreate", function (event) {

    var form = $('#reset_pass_form');

    var resetBtn = $('#reset_sms');

    var dataUrl = resetBtn.data('url');

    var submit = $('#submit_form');

    var popupMsg = $('#popup_msg');

    var popupbtn = $('#popup_err');

    var countTime, timer;

    var setTime = function() {
    
      if (!countTime) {
      
        window.clearInterval(timer);

        resetBtn.on('tap', tapVerify);

        resetBtn.html('发送验证码');
      
      } else {
      
        countTime--;
      
        resetBtn.html('重新获取(' + countTime + ')');
      
      }
    
    };
  
    resetBtn.on('tap', tapVerify);
    
    var tapVerify = function (e) {

      e.preventDefault();

      var mobile = $('input[name=mobile]').val();

      var _token = $('input[name=_token]').val();

      if (mobile == undefined || mobile.length < 11) {

        alert('请输入11位有效手机号!');

        return;
      
      }

      $.post(dataUrl, {
      
        _token: _token,

        mobile: mobile
      
      }, function (data) {

        if (data.code == 1) {
        
          var smsres = data.result[0].status; 

          if (smsres == 'success') {
          
            alert('短信已发送！');

            resetBtn.unbind('tap');

            countTime = 30;

            timer = setInterval(setTime, 1000);
          
          } else {

            alert('短信发送失败，请联系管理员！');
          
          }

        }
      
      }, 'json');

    };

    resetBtn.on('tap', tapVerify);

    form.ajaxForm();

    var ajaxOptions = {

      'dataType': 'json',

      'success': function (data) {

        if (data.code == 1) {

          alert('密码已修改，请重新登录！');

          form[0].reset();

          setTimeout("$.mobile.changePage('/mobile/login')", 1500);
        
        } else {

          console.log(msg);
        
        }
      
      },
    
      'error': function (err) {
      
        console.log(err);
      
      }
    
    };

    submit.on('tap', function (event) {
 
      event.preventDefault();

      var mobile = $('input[name=mobile]').val();

      if (mobile == undefined || mobile == '') {
      
        alert('请输入11位有效手机号!');

        return;
      
      }

      var verify = $('input[name=reset_code]').val();

      if (verify == undefined || verify == '') {
      
        alert('请输入验证码！');

        return;
      
      }

      var newpassword = $('input[name=newpassword]').val();

      var confirmpassword = $('input[name=confirmpassword]').val();

      if (newpassword == undefined || newpassword.lenght <6 || newpassword.length > 18) {
      
        alert('请输入6-18位新密码！');

        return;
      
      }

      if (confirmpassword == undefined || confirmpassword == '') {
      
        alert('请确认新密码！');

        return;
      
      }

      if (newpassword != confirmpassword) {
      
        alert('新密码和旧密码不一致，请重新输入！');

        return;
      
      }

      form.ajaxSubmit(ajaxOptions);
    
    });
  });

</script>
</div>
@endsection
