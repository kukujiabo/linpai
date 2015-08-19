@section('edit_receiver')
  <div class="gray-light edit-info" id="new-address-info">
    <form class="form-inline" method="post" action="{{ asset('receiver/add') }}" id="new-receiver-form">
      <div class="alert alert-danger hide" id="address-alert"></div>
      <h4>使用新地址</h4>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label">
            <span class="require">*</span>
            &nbsp;收&nbsp;货&nbsp;人&nbsp;&nbsp;
          </label>
          <input class="form-control" id="v-receiver" type="text" name="receiver">
        </div>
      </fieldset>
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label">
            <span class="require">*</span>
            收货地址&nbsp;
          </label>
          <div class="btn-group" role="group" id="v-city">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span id="selected-city">选择城市</span>
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" id="city-menu" role="menu">
            @foreach ($cities as $city)
              <li >
                <a href="#" class="cities-item" id="{{$city->code}}">{{$city->cname}}</a>
              </li>
            @endforeach
            </ul>
          </div>
          <div class="btn-group" role="group" id="v-district">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span id="selected-district">选择区域</span>
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" id="district-menu" role="menu">
            @foreach ($districts as $district)
              <li>
                <a href="#" class="districts-item" id="{{$district->code}}">{{$district->cname}}</a>
              </li>
            @endforeach
            </ul>
          </div>
          <input class="form-control" type="hidden" name="city" id="post-city">
          <input class="form-control" type="hidden" name="district" id="post-district">
        </div>
      </fieldset> 
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label">
            <span class="require">*</span>
            详细地址&nbsp;
          </label>
          <input class="form-control width-50" type="text" name="address" id="v-address">
        </div>
      </fieldset> 
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label">
            <span class="require">*</span>
            手机号码&nbsp;
          </label>
          <input class="form-control" type="text" name="mobile" id="v-mobile">
        </div>
        <div class="form-group">
          <label class="control-label">
            &nbsp;&nbsp;固定电话&nbsp;
          </label>
          <input class="form-control" type="text" name="phone">
        </div>
      </fieldset> 
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label">
            <span class="require">*</span>
            &nbsp;邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;编&nbsp;
          </label>
          <input class="form-control" type="text" name="post_code" id="v-post_code">
        </div>
      </fieldset> 
      <div class="form-group padding-5">
        <button class="btn btn-primary" id="receiver-submit" role="button" type="submit">保存收货人信息</button>
      </div>
    </form>
  </div>

@endsection
