@extends('app')

@include('area_select')

@include('modal-box')

@section('content')
  <div class="top-50"></div>
  <div class="box" style="background: #fff; padding-top: 0px;">
    <img width="100%" src="/imgs/coope.jpg">
    <div class="cooperation-content"> 
      <p class="intro">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;51临牌是基于互联网的车辆临时牌照服务平台，我们致力于给众多需要临时牌照的车主提供更专业，更超值，更便捷，更高效的服务。
      </p>
      <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我们欢迎全国各地的车辆临时牌照服务商（全国车管所均可）加入我们的平台，享受［51临牌］带来的优质订单与丰厚的佣金以及完善的利益保障。
      </p>
      <div class="padding-5"></div>
      <p style="color: #31b0d5">
        如果您希望和［51临牌］进行深度合作，请填写以下信息，我们的工作人员会在2个工作日内与您取得联系。 
      </p>
    </div>
    <div class="padding-20" style="width: 90%">
      <form class="form-horizontal" id="coop-form" action="{{asset('communitcate/addcooperator')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <fieldset>
          <div class="form-group">
            <label class="control-label col-xs-2" for="contact"><span class="require">*</span>联系人</label>
            <div class="col-xs-5">
              <input class="form-control" type="text" name="contact" id="contact">
            </div>
            <div class="col-xs-5">
              <p class="alert alert-danger no-margin p-5 hide" notice="contact"></p>
            </div>
          </div>
        </fieldset> 
        <fieldset>
          <div class="form-group">
            <label class="control-label col-xs-2" for="company">公司</label>
            <div class="col-xs-5">
              <input class="form-control" type="text" name="company" id="company">
            </div>
          </div>
        </fieldset> 
        <fieldset>
          <div class="form-group">
            <label class="control-label col-xs-2" for="mobile"><span class="require">*</span>手机号码</label>
            <div class="col-xs-5">
              <input class="form-control mobile-input" type="text" name="mobile" id="mobile">
            </div>
            <div class="col-xs-5">
              <p class="alert alert-danger no-margin p-5 hide" notice="mobile"></p>
            </div>
          </div>
        </fieldset> 
        <fieldset>
          <div class="form-group">
            <label class="control-label col-xs-2" for="telephone"><span class="require">*</span>固定电话</label>
            <div class="col-xs-5">
              <input class="form-control" type="text" name="telephone" id="telephone" placeholder="eg: 010-66336633">
            </div>
          </div>
        </fieldset> 
        <fieldset>
          <div class="form-group">
            <label class="control-label col-xs-2" for="contact"><span class="require">*</span>所属区域</label>
            <div class="col-xs-5">
              @yield('area')
            </div>
            <div class="col-xs-5">
              <p class="alert alert-danger no-margin p-5 hide" notice="location"></p>
            </div>
          </div>
          <input type="hidden" name="province" id="post-province">
          <input type="hidden" name="city" id="post-city">
          <input type="hidden" name="district" id="post-district">
        </fieldset> 
        <fieldset>
          <div class="form-group">
            <label class="control-label col-xs-2" for="email"><span class="require">*</span>电子邮箱</label>
            <div class="col-xs-5">
              <input class="form-control" type="email" name="email" id="email">
            </div>
            <div class="col-xs-5">
              <p class="alert alert-danger no-margin p-5 hide" notice="email"></p>
            </div>
          </div>
        </fieldset> 
        <div class="padding-5"></div>
        <div class="form-group">
          <div class="col-xs-2">
          </div>
          <div class="col-xs-3">
            <button class="btn btn-info btn-group-justified" role="button" type="submit" id="coop-submit">提交信息</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- modal -->

  @yield('modal-box')

  
<script type="text/javascript">
  window.onload = function () {$('body').css({background: "#eee"});};
</script>

@endsection
