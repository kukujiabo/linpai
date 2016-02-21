@extends('app')

@include('modal-box')

@section('content')
	<div class="box" id="register-box">
		<div class="col-md-6 padding-20 text-center">
      <a href="/text/bouninfo">
        <img width=80% style="margin-top:20%" src="/imgs/guanggao.png">
      </a>
    </div>
		<div class="col-md-6" style="border-left: 1px solid #eee;">
			@if (count($errors) > 0)
        <!--
				<div class="alert alert-danger hide">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
        -->
			@endif
      <div class="text-center login-logo">
        <img src="{{asset('/imgs/logo-linpai.png')}}" class="logo">
      </div>
      <div class="padding-5"></div>
			<form data-ajax="false" class="form-horizontal" role="form" id="reg-form" method="POST" action="{{ url('/auth/register') }}">
        <input type="hidden" name="_rtype" value="web">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label class="control-label sr-only">手机</label>
					<div class="col-xs-10 col-xs-offset-1">
						<input type="text" class="form-control mobile-input mobile-unique" name="mobile" placeholder="手机号码"  tips="手机号码">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label sr-only">验证码</label>
					<div class="col-xs-6 col-xs-offset-1">
						<input type="text" class="form-control" name="verify_code" placeholder="验证码" tips="验证码">
					</div>
          <div class="col-xs-4 no-padding-left">
            <button class="btn btn-info btn-group-justified theme-back-blue" width="100%" type="button" role="button" id="check_send">发送验证码</button>
          </div>
				</div>
				<div class="form-group">
					<label class="control-label sr-only">昵称</label>
					<div class="col-xs-10 col-xs-offset-1">
						<input type="text" class="form-control" name="name" placeholder="用户名" tips="用户名">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label sr-only">邮箱</label>
					<div class="col-xs-10 col-xs-offset-1">
						<input type="email" class="form-control" name="email" placeholder="邮箱 eg: yourmail@domain.com" tips="邮箱">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label sr-only">密码</label>
					<div class="col-xs-10 col-xs-offset-1">
						<input type="password" class="form-control" name="password" placeholder="密码" tips="密码">
					</div>
				</div>

        <div class="form-group">
          <div class="col-xs-10 col-xs-offset-1 register-issue">
            <label for="agree">
              <input type="checkbox" name="agree" id="agree" checked> 我已经阅读且同意
            </label> 
            <a href="#" class="text-agreement links theme-font-blue" data-url="useagreement">《51临牌网站使用协议》</a>
          </div>
        </div>

				<div class="form-group">
					<div class="col-xs-10 col-xs-offset-1">
						<button type="submit" id="register-submit" class="btn btn-info btn-group-justified theme-back-blue">
							提交
						</button>
					</div>
				</div>
        <div class="form-group">
          <div class="col-xs-10 col-xs-offset-1">
            已有51临牌账号？  
            <a class="links theme-font-blue" href="{{asset('auth/login')}}" style="display:inline;">直接登录</a>
          </div>
        </div>
			</form>
		</div>
    <div style="clear:both"></div>
	</div>

  @yield('modal-box')
  
  <script type="text/javascript">
    window.onload = function () {
    
      $('#agree').change(function (e) {      

        var that = $(this);

        if (that.is(':checked')) {
        
          $('#register-submit').enable();

        } else {
        
          $('#register-submit').enable(false);
        
        }
      
      });

      var timer, countTime;

      var ckBtn = $('#check_send');

      ckBtn.click(function (e) {

        e.preventDefault();

        var mInput = $('input[name=mobile]');

        var mobile = mInput.val();

        if (mobile == '' || mobile == undefined || mobile == '') {
        
          mInput.css({'background': '#f2dede'});

          mInput.attr('placeholder', '请先填写手机号码！');

          return;
        
        }

        $(this).html('发送中...');

        $.post('/verify/regsms', {

          'mobile': mobile,

          '_token': $('input[name=_token]').val()
        
        }, function (data) {

          if (data.code) {
        
            countTime = 60;
      
            e.preventDefault();

            ckBtn.attr('disabled', 'disabled');

            timer = window.setInterval(setTime, 1000);

          } else {
          

          }
        
        }, 'json');

      
      });

      function setTime() {
      
        if (!countTime) {
        
          window.clearInterval(timer);

          ckBtn.removeAttr('disabled');

          ckBtn.html('发送验证码');
        
        } else {
        
          countTime--;
        
          ckBtn.html('重新获取(' + countTime + ')');
        
        }
      
      }

      $('body').css({background: "#eee"});
    
    };

  </script>
@endsection
