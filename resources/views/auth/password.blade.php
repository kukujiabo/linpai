@extends('app')

@section('content')
<div class="padding-20"></div>
<div class="container-fluid">
<div class="col-xs-8 col-xs-offset-2">
<div class="panel panel-default">
  <div class="panel-body">
    <h3 class="text-center">重置密码</h3>
    <hr>
    @if (!empty($nouser))

     <div class="alert alert-danger">
       您输入的手机号还没有注册，您可以 <a href="{{asset('auth/register')}}">马上注册</a>
     </div>

    @endif 
    <div class="padding-5"></div>
		<form class="form-horizontal" id="verify_form" role="form" method="POST" action="{{ url('/user/resetverify') }}">
      <input type="hidden" name="reset_form_token" value="{{$form_token}}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
				<label class="control-label col-xs-2 col-xs-offset-1">手机号码</label>
				<div class="col-xs-6">
					<input type="text" class="form-control mobile-input" id="verify_mobile" name="mobile" value="{{ old('email') }}" placeholder="请输入注册手机号">
				</div>
			</div>
      <div class="padding-20"></div>
			<div class="form-group">
				<div class="col-xs-4 col-xs-offset-4">
					<button type="submit" class="btn btn-info btn-group-justified" id="verify_submit">
            重置密码
					</button>
				</div>
			</div>
		</form>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
   window.onload = function () { $('body').css({background: "#eee"}); };
</script>
@endsection
