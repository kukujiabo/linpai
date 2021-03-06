@include('area_select')

@section('edit_receiver')
  <div class="edit-info" id="new-address-info">
    <form class="form-horizontal" method="post" action="{{ asset('receiver/add') }}" data-addurl="{{asset('receiver/add')}}" data-editurl="{{asset('receiver/edit')}}" id="new-receiver-form" status="add">
      <div class="alert alert-danger hide" id="address-alert"></div>
      <h4 id="r-i-tit" class="hide">使用新地址</h4>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="rid" value="">
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label col-xs-2 no-padding-both-side">
            <span class="require">*</span>
            &nbsp;收&nbsp;货&nbsp;人&nbsp;&nbsp;
          </label>
          <div class="col-xs-3">
            <input class="form-control" id="v-receiver" type="text" name="receiver" placeholder="收件人">
          </div>
        </div>
      </fieldset>
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label col-xs-2 no-padding-both-side">
            <span class="require">*</span>
            收货地址&nbsp;
          </label>

          <div class="col-xs-10">
          @yield('area')
          </div>
          <input class="form-control" type="hidden" name="province" id="post-province">
          <input class="form-control" type="hidden" name="city" id="post-city">
          <input class="form-control" type="hidden" name="district" id="post-district">
        </div>
      </fieldset> 
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label col-xs-2 no-padding-both-side">
            <span class="require">*</span>
            详细地址&nbsp;
          </label>
          <div class="col-xs-7">
            <input class="form-control" type="text" name="address" id="v-address" placeholder="请填写详细的门牌号、房间号等">
          </div>
        </div>
      </fieldset> 
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label col-xs-2 no-padding-both-side">
            <span class="require">*</span>
            手机号码&nbsp;
          </label>
          <div class="col-xs-3">
            <input class="form-control mobile-input" type="text" name="mobile" id="v-mobile">
          </div>
      </fieldset>
      <fieldset class="padding-5">
        <div class="form-group">
          <label class="control-label col-xs-2 no-padding-both-side">
            <span>&nbsp;</span>
            固定电话&nbsp;
          </label>
          <div class="col-xs-3">
            <input class="form-control" type="text" name="phone">
          </div>
        </div>
      </fieldset> 
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label col-xs-2 no-padding-both-side">
            <span class="require">*</span>
            &nbsp;邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;编&nbsp;
          </label>
          <div class="col-xs-3">
            <input class="form-control" type="text" name="post_code" id="v-post_code">
          </div>
        </div>
      </fieldset> 
      <div class="form-group padding-20">
        <button class="btn btn-primary" id="receiver-submit" role="button" type="submit">保存收货人信息</button>
      </div>
    </form>
  </div>

@endsection
