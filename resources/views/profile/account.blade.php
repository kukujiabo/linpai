@extends('profile/profile')

@section('subcontent')
<div class="sub-wrapper">
  <h4>账号设置</h4>
</div>
<hr class="no-margin">
<div class="padding-20">
  <form class="form-inline" id="person-form" action="{{ asset('profile/update') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>
    <div class="form-group col-md-10">
      <label class="control-label col-md-2 padding-top-3">
        手机号码
      </label>
      <div class="info padding-top-3" id="edit-phone">
        <div class="col-md-9">
          {{$user->mobile}}
        </div>
      </div> 
    </div>
    </fieldset>
    <div class="padding-5"></div>
    <fieldset>
    <div class="form-group col-md-10">
      <label class="control-label col-md-2 padding-top-3">
        用&nbsp;&nbsp;户&nbsp;&nbsp;名
      </label>
      <div class="info padding-top-3">
        <div class="col-md-9">
          <span id="display-name" data-value="{{$user->name}}">{{$user->name}}</span>
          <span class="hide" id="edit-name">
            <input class="form-control" type="text" id="username" name="name" value="{{$user->name}}" data-pre="">
          </span>
        </div>
        <div class="col-md-1">
          <a href="#" class="account-edit" state="edit" data-target="name">
            <span class="glyphicon glyphicon-edit"></span>
          </a>
        </div>
      </div>
      <div class="hidden" id="">
        <input type="text" class="form-control" >
      </div>
    </div>
    </fieldset>
    <div class="padding-5"></div>
    <fieldset>
    <div class="form-group col-md-10">
      <label class="control-label col-md-2 padding-top-3">
        邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱
      </label>
      <div class="info padding-top-3">
        <div class="col-md-9">
          <span id="display-email" data-value="{{$user->email}}">{{$user->email}}</span>
          <span id="edit-email" class="hide">
            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" data-pre="">
          </span>
        </div>
        <div class="col-md-1">
          <a href="#" data-target="email" state="edit" class="account-edit profile-info-edit">
            <span class="glyphicon glyphicon-edit"></span>
          </a>
        </div>
      </div>
    </div>
    </fieldset>
  </form>
</div>
<hr>
<div class="padding-20">
  <button class="btn btn-warning" id="password-modify">
    <span class="glyphicon glyphicon-lock"></span>
    修改密码
  </button>  
</div>
  <div class="hide" id="passwd-modify">
    <div class="over-all"></div>
    <div class="box padding-20" id="passwd-box">
      <span class="glyphicon glyphicon-remove" style="z-index:10004;position:absolute;right:5px;top:5px;cursor:pointer" id="modify_pass_remove"></span>
      <div class="alert alert-success margin-5 hide"></div>
      <div class="alert alert-danger margin-5 hide"></div>
      <div class="padding-20"></div>
      <form class="form-horizontal" method="post" id="passwd-form"  action="/profile/passwd">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <fieldset>
          <div class="form-group">
            <label class="control-label col-xs-3 text-right padding-5">旧密码：</label>
            <div class="col-xs-8">
              <input class="form-control" name="oldpassword" type="password" title="旧密码">
            </div>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="control-label col-xs-3 text-right padding-5">新密码：</label>
            <div class="col-xs-8">
              <input class="form-control col-xs-8" name="newpassword" type="password" title="新密码">
            </div>
          </div>
        </fieldset>
        <!--
        <fieldset>
          <div class="form-group">
            <label class="control-label col-xs-3 text-right padding-5">确认密码：</label>
            <div class="col-xs-8">
              <input class="form-control col-xs-8" name="confirmpassword" type="password" title="确认密码">
            </div>
          </div>
        </fieldset>
        -->
        <fieldset>
          <div class="padding-5 width-100">
            <label class="control-label sr-only">提交表单</label>
            <button class="btn btn-info col-xs-offset-3" id="pass-submit" role="button" type="submit">确认</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>
@endsection
