@extends('app')

@section('content')
	<div class="row box" id="login-box">
    <div class="col-md-6 padding-20">
    </div>
		<div class="col-md-6"  style="border-left: 1px solid #eee;">
      <div class="text-center login-logo">
        <img src="{{asset('/imgs/logo-linpai.png')}}" class="logo">
      </div>
      <div class="row padding-5">
        <div class="col-xs-3 col-xs-offset-1">
          <hr>
        </div>
        <div class="col-xs-4">
          <p class="help-block text-center" style="padding: 5px 0px;">会员登录</p>
        </div>
        <div class="col-xs-3">
          <hr>
        </div>
      </div>
      <div>
            @if (count($errors))
						<div class="alert alert-danger">
            @else
						<div class="alert alert-danger hide">
            @endif
							<ul id="err-list">
                @if ($errors)
                  <li>手机号和密码不匹配，请重新输入！</li>
                @endif
							</ul>
						</div>

					<form class="form-horizontal" id="login-form" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>
						  <div class="form-group">
						  	<label class="control-label sr-only">手机：</label>
                <div class="col-xs-10 col-xs-offset-1">
						  	<input type="text" class="form-control mobile-input" name="mobile" value="{{ old('mobile') }}" placeholder="手机号">
                </div>
						  </div>
            </fieldset>
            <fieldset>
						<div class="form-group">
							<label class="control-label sr-only">密码：</label>
							<div class="col-xs-10 col-xs-offset-1">
								<input type="password" class="form-control" name="password" placeholder="密码">
							</div>
						</div>
            </fieldset>
            <!--
						<div class="form-group">
							<div class="col-xs-6 col-xs-offset-1">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> 记住我
									</label>
								</div>
							</div>
						</div>
            -->
						<div class="form-group">
							<div class="col-xs-10 col-xs-offset-1">
								<button type="submit" id="login-submit" class="btn btn-info btn-group-justified">登录</button>
							</div>
						</div>
            <div class="form-group">
              <div class="col-xs-2 col-xs-offset-1">
						    <a class="btn btn-link require links no-padding-left" href="{{ url('/user/password') }}">忘记密码？</a>
              </div>
              <div class="col-xs-8 col-xs-offset-1">
                还没有51临牌账号？
                <a class="btn btn-link links" style="padding-left:0px;padding-right:0px;" href="{{asset('auth/register')}}">
                点击注册</a>
              </div>
            </div>
					</form>
				</div>
			</div>
		</div>
    <script type="text/javascript">
      window.onload = function () { 

        $('body').css({background: "#eee"}); 
      
        $('#login-submit').click(function (e) {

          $('#err-list').parent().addClass('hide');

          e.preventDefault();

          var mobile = $('input[name=mobile]').val();

          var password = $('input[name=password]').val();

          if (isMobile(mobile) && password != undefined && password.length > 5) {
          
            $('#login-form').submit();
          
          } else {

            var err = '';

            if (!isMobile(mobile)) {
            
              err += '<li>手机号填写错误！</li>';
            
            }

            if (password == '' || password == undefined) {
            
              err += '<li>请填写密码！</li>';
            
            }

            $('#err-list').parent().removeClass('hide');

            $('#err-list').html(err);
          
          }
        
        });
      
      };
    </script>
@endsection
