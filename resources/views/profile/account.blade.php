@extends('profile/profile')

@section('subcontent')
<div class="sub-wrapper">
  <div class="padding-5">
    <h3>账号信息</h3>
    <hr>
  </div>
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
  <hr>
  <div class="padding-5">
    <button class="btn btn-warning">
      <span class="glyphicon glyphicon-lock"></span>
      修改密码
    </button>  
  </div>
</div>
@endsection
