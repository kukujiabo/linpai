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
          <div class="ui-btn  no-margin ui-mini blue_white" style="margin-left:1px;float:left;width:31%" data-inline="true">
            <a href="#" id="reset_sms" class="blue_white_btn" data-url="{{asset('/user/ajaxresetsms')}}">发送验证码</a>
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
          <div class="ui-btn blue_white" >
            <a type="submit" id="submit_form" class="blue_white" style="font-size:16px;" >确认</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">

  $(document).on("pageinit", function (event) {

    var form = $('#reset_pass_form');

    var resetBtn = $('#reset_sms');

    var dataUrl = resetBtn.data('url');

    var submit = $('#submit_form');

    var popupMsg = $('#popup_msg');

    var popupbtn = $('#popup_err');

    resetBtn.on('tap', function (e) {

      e.preventDefault();

      var mobile = $('input[name=mobile]').val();

      var _token = $('input[name=_token]').val();

      if (mobile == undefined || mobile.length < 11) {

        $('#popup_msg').html('请输入11位有效手机号!');

        popupbtn.click();

        return;
      
      }

      $.post(dataUrl, {
      
        _token: _token,

        mobile: mobile
      
      }, function (data) {

        if (data.code == 1) {
        
          var smsres = data.result[0].status; 

          if (smsres == 'success') {
          
            popupMsg.html('短信已发送！');
          
          } else {

            popupMsg.html('短信发送失败，请联系管理员！');
          
          }

          popupbtn.click();
        
        }
      
      }, 'json');

    });

    form.ajaxForm();

    var ajaxOptions = {

      'dataType': 'json',

      'success': function (data) {

        if (data.code == 1) {

          popupMsg.html('密码已修改，请重新登录！');

          form[0].reset();

          popupbtn.click();

          setTimeout("$.mobile.changePage('/mobile/login')", 1500);
        
        }
      
      },
    
      'error': function (err) {
      
        console.log(err);
      
      }
    
    };

    submit.on('tap', function (event) {
 
      event.preventDefault();

      console.log(1);

      form.ajaxSubmit(ajaxOptions);
    
    });

  });


</script>

@endsection
