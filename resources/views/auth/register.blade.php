@extends('app')

@include('modal-box')

@section('content')
	<div class="row box" id="register-box">
		<div class="col-xs-6 padding-20">
    </div>
		<div class="col-xs-6" style="border-left: 1px solid #eee;">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
      <div class="text-center login-logo">
        <img src="{{asset('/imgs/51.png')}}">
      </div>
      <div class="padding-5"></div>
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label class="control-label sr-only">手机</label>
					<div class="col-xs-10 col-xs-offset-1">
						<input type="text" class="form-control" name="mobile" placeholder="手机号码" >
					</div>
				</div>
				<div class="form-group">
					<label class="control-label sr-only">验证码</label>
					<div class="col-xs-6 col-xs-offset-1">
						<input type="number" class="form-control" name="verify_code" placeholder="验证码">
					</div>
          <div class="col-xs-4">
            <button class="btn btn-info bt-group-justified" type="button">重发短信</button>
          </div>
				</div>
				<div class="form-group">
					<label class="control-label sr-only">昵称</label>
					<div class="col-xs-10 col-xs-offset-1">
						<input type="text" class="form-control" name="name" placeholder="用户名">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label sr-only">邮箱</label>
					<div class="col-xs-10 col-xs-offset-1">
						<input type="email" class="form-control" name="email" placeholder="邮箱">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label sr-only">密码</label>
					<div class="col-xs-10 col-xs-offset-1">
						<input type="password" class="form-control" name="password" placeholder="密码">
					</div>
				</div>

        <div class="form-group">
          <div class="col-xs-10 col-xs-offset-1 register-issue">
            <label for="agree">
              <input type="checkbox" name="agree" id="agree"> 我已经阅读且同意
            </label> 
            <a href="#" class="text-agreement" data-url="useagreement">《51临牌网站使用协议》</a>
          </div>
        </div>

				<div class="form-group">
					<div class="col-xs-10 col-xs-offset-1">
						<button type="submit" id="register-submit" class="btn btn-info btn-group-justified" disabled>
							提交
						</button>
					</div>
				</div>
        <div class="form-group">
          <div class="col-xs-5 col-xs-offset-1">
            已有51临牌账号？  
          </div>
          <div class="col-xs-3 no-padding">
            <a href="{{asset('auth/login')}}">直接登陆</a>
          </div>
        </div>
			</form>
		</div>
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

      $('body').css({background: "#eee"});
    
    };
  </script>
@endsection
