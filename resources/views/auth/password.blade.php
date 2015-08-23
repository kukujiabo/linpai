@extends('app')

@section('content')
	<div class="row box" id="retrieve-box">
		<div class="col-md-8 col-md-offset-2">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					@if (count($errors) > 0)
          <!--
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
          -->
					@endif
          <div class="text-center login-logo">
            <img src="{{asset('/imgs/51.png')}}">
          </div>
					<form class="form-horizontal top-50" role="form" method="POST" action="{{ url('/password/email') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="control-label sr-only">手机号码</label>
							<div class="col-xs-8 col-xs-offset-2">
								<input type="text" class="form-control" name="mobile" value="{{ old('email') }}" placeholder="请输入注册手机号">
							</div>
						</div>
            <div class="padding-20"></div>
						<div class="form-group">
							<div class="col-xs-4 col-xs-offset-4">
								<button type="submit" class="btn btn-info btn-group-justified">
                  发送验证短信
								</button>
							</div>
						</div>
					</form>
		</div>
	</div>
<script type="text/javascript">
   window.onload = function () { $('body').css({background: "#eee"}); };
</script>
@endsection
