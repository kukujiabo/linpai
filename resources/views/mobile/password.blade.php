@extends('mobile/mobile')

@section('content')
  
<div data-role="page">
  <div data-role="header" data-position="fixed">
    <h1>忘记密码 - 51临牌</h1>
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
          <input type="text" name="mobile" placeholder="请输入手机号">
        </div>
        <div class="form-group">
          <div class="ui-input-text ui-body-inherit no-margin ui-corner-all ui-shadow-inset" data-inline="true" style="width:60%;float:left">
            <input data-role="none"  type="text" name="reset_code" placeholder="请输入验证码"> 
          </div>
          <div class="ui-btn ui-input-btn ui-corner-all ui-shadow no-margin ui-btn-inline ui-mini" style="margin-left:1px;float:left;">
            <a href="#" id="reset_sms" style="margin-top:3px;" data-url="{{asset('/user/ajaxresetsms')}}">发送验证码</a>
          </div>
          <div class="clear"></div>
        </div>
        <div class="form-group">
          <input type="password" name="newpassword" placeholder="请输入新密码">
        </div>
        <div class="form-group">
          <input type="password" name="confirmpassword" placeholder="确认新密码">
        </div>
        <div class="form-group margin-top-50">
          <button type="submit" id="submit_form">修改密码</button>
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
