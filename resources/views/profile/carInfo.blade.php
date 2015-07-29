@extends('profile/profile')

@section('subcontent')
<div class="sub-wrapper">
  <div class="person-info table-responsive">
    <table class="table">
      <thead class="gray-light">
        <tr>
          <th>所有人</th>
          <th>车辆型号</th>
          <th>临牌号</th>
          <th>操作</th>
        </tr>
      </thead> 
      <tbody>
        <tr>
          <td>刘德华</td>
          <td>保时捷</td>
          <td>askldwo</td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="sub-wrapper t-left" id="car-info-toggle">
  <div class="padding-5"> </div>
  <button class="btn btn-default" role="button" id="car-info-add" data-status="show">
    <span class="glyphicon glyphicon-plus"></span>
    <span id="c-i-a-content">新增车辆</span>
  </button>
</div>
<div class="edit-info" id="car-info-edit">
  <div class="padding-5"> </div>
  <form class="form-inline" method="post" action="#">
    <fieldset>
      <div class="form-group col-md-6 t-left">
        <label class="col-md-4 control-label" role="label" for="ownername">
          <span class="require">*</span>
          车辆所有人姓名
        </label>
        <input class="form-control width-100" type="text" name="ownername" >
      </div>
      <div class="form-group col-md-6 t-left">
        <label class="col-md-4 control-label"  role="label" for="carbrand">
          <span class="require">*</span>
          车辆品牌
        </label>
        <input class="form-control " type="text" name="carbrand">
      </div>
    </fieldset>
    <div class="padding-5"></div>
    <fieldset>
      <div class="form-group col-md-6 t-left">
        <label class="col-md-4 control-label"  role="label" for="ownername">
          <span class="require">*</span>
          车辆厂牌型号
        </label>
        <input class="form-control width-100" type="text" name="ownername" >
      </div>
      <div class="form-group col-md-6 t-left">
        <label class="col-md-4 control-label"  role="label" for="carbrand">
          <span class="require">*</span>
          识别代码(车架号)
        </label>
        <input class="form-control " type="text" name="carbrand">
      </div>
    </fieldset>
    <div class="padding-5"></div>
    <fieldset>
      <div class="form-group col-md-12 t-left">
        <label class="control-label col-md-4">
          <span class="require">*</span>
          车辆相关文件
        </label>
        <div class="jum"  >


        </div>
      </div>
    </fieldset>
    <fieldset>
      <div class="padding-20 width-100 t-left">
        <button class="btn btn-primary" role="submit" type="submit">保存车辆信息</button>
      </div>
    </fieldset>
  </form>
</div>
@endsection
