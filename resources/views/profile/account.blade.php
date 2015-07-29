@extends('profile/profile')

@section('subcontent')
<div class="sub-wrapper">
  <div class="padding-5"></div>
  <form class="form-inline">
    <fieldset>
    <div class="form-group col-md-10">
      <label class="control-label col-md-2 padding-top-3">
        手机号码
      </label>
      <div class="info padding-top-3" id="edit-phone">
        <div class="col-md-9">
          13928372819
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
      <div class="info padding-top-3" id="edit-username">
        <div class="col-md-9">
          Ryan
        </div>
        <div class="col-md-1">
          <a href="#">
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
      <div class="info padding-top-3" id="info-mail">
        <div class="col-md-9">
          Ryan@hotmail.com
        </div>
        <div class="col-md-1">
          <a href="#" data-target="" class="profile-info-edit">
            <span class="glyphicon glyphicon-edit"></span>
          </a>
        </div>
      </div>
      <div class="hidden" id="edit-mail">
        <input type="text" class="form-control" >
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
