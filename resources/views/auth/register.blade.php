@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default box">
				<div class="panel-heading t-center"><b>注册</b></div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">手机</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="mobile" placeholder="mobile" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">验证码</label>
							<div class="col-md-3">
								<input type="number" class="form-control" name="verify_code">
							</div>
              <div class="col-md-3">
                <button class="btn btn-default" type="button">重发短信</button>
              </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">昵称</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" placeholder="name">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">邮箱</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" placeholder="email">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">密码</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password" placeholder="password">
							</div>
						</div>


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									提交
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
