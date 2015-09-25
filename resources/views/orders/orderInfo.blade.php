@extends('app')

@extends('processbar')

@extends('modal-box')

@include('tables.car_info')

@include('forms.edit_car')

@include('tables.receiver_info')

@include('forms.edit_receiver')

@include('scripts.moreinfo')

@section('content')

<div class="process">
  @yield('process')
</div>
<p>确认订单信息</p>
<div class="box" >
  <div class="sub-wrapper">
    <div class="media">
      <div class="media-left">
        <a href="#" class="gray-light" style="display:block">
          <img class="media-object" src="{{$good->tiny_good}}" alt="" width=80px>
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">{{ $good->name }}</h4>
        <div><span class="total-price">{{$price}}</span>元</div>
        <div>数量：{{$num}} &nbsp;张</div>
      </div>
    </div>
  </div>
</div>
<p>临牌车辆所有人信息</p>
<div class="box" id="car-info">
  <div class="sub-wrapper">
    @yield('car_info')
  </div>
  <div class="sub-wrapper" id="car-info-toggle">
    @if (count($cars) < 3)
    <button role="button" class="hide btn btn-default more-info" id="more-car-info" data-target="car-list-table" data-mode="hide">
    @else
    <button role="button" class="btn btn-default more-info" id="more-car-info" data-target="car-list-table" data-mode="hide">

    @endif
      <span class="glyphicon glyphicon-chevron-down"></span>
      <span class="m-i-value">更多车辆信息</span> 
    </button>
    &nbsp;&nbsp;
    <button role="button" class="btn btn-default" id="car-info-add" data-status="show">
      <span class="glyphicon glyphicon-plus"></span> 
      <span id="c-i-a-content" data-close="新增车辆信息" data-open="取消编辑信息">新增车辆信息</span>
    </button>
  </div>
  <div class="padding-5">
  </div>

  <!-- 车辆信息编辑 -->
  @yield('edit_car')

</div>
<p>收货人信息</p>
<div class="box" id="customer-info">
  <div class="sub-wrapper">

    <!-- 收件人列表 -->
    @yield('receiver_info')

    <div class="wrapper" id="new-address-toggle">
      @if (count($receiverInfos) < 2)
      <button role="button" class="hide btn btn-default more-info" id="more-receiver-info" data-target="receiver-list-table" data-mode="hide">

      @else

      <button role="button" class="btn btn-default more-info" id="more-receiver-info" data-target="receiver-list-table" data-mode="hide">
      @endif
        <span class="glyphicon glyphicon-chevron-down"></span>
        <span class="m-i-value">更多收货地址</span>
      </button>
      &nbsp;&nbsp;
      <button class="btn btn-default" id="new-address-add" data-status="show">
      <span class="glyphicon glyphicon-plus"></span> 
      <span id="n-a-content">新增收货地址</span>
      </button>
    </div>
  </div>

  <div class="padding-5">
  </div>
    
    <!-- 编辑收件人 -->

    @yield('edit_receiver')

</div>
<p>优惠码</p>
<div class="box" id="quan">
  <div class="sub-wrapper">
    <p>请输入 优惠码 / 推荐码</p>
    <form class="form-inline" id="selected-bouns">
      <div class="form-group padding-5">
        <label class="sr-only" for=""></label>
        <input type="text" name="youhui_1" id="youhui_1" class="form-control" placeholder="优惠码">
      </div>
      <div class="form-group padding-5">
        <label class="sr-only" for=""></label>
        <input type="text" name="youhui_2" id="youhui_2" class="form-control" placeholder="优惠码">
      </div>
      <div class="form-group padding-5">
        <label class="sr-only" for=""></label>
        <input type="text" name="youhui_3" id="youhui_3" class="form-control" placeholder="优惠码">
      </div>
      <div class="form-group padding-5">
        <div class="alert alert-danger no-margin" id="youhui-alert"></div>
      </div>
      <div class="form-group padding-5">
        <a class="theme-font-blue" id="quan-view"  role="button" data-status="show">查看可用优惠码</a>
      </div>
      <div class="padding-5">
        <a class="links theme-font-blue" href="/profile/mybouns?type=discount" target="_blank">什么是优惠券?</a>
      </div>
    </form>
    <p>
    </p>
  </div>
  <div class="edit-info gray-light" id="quan-box">    
      @if (!count($bouns))
        <div class="alert alert-warning text-center">
          <h4>您的帐户中暂时还没有优惠券，<a class="theme-font-blue" href="/profile/mybouns?type=discount" target="_blank">点此查看</a>&nbsp;如何获取</h4>
        </div>
      @else 
        <ul class="row quan-list">

        @foreach ($bouns as $boun) 

          <li class="col-md-3 bouns" >
            <a class="bouns" href="#" data-code="{{$boun->code}}" id="b-{{$boun->code}}" data-value="{{$boun->note}}">
              <div class="quan-itm r-trans">
                <b class="q-price">{{$boun->note}}RMB</b>
                <b>CODE:{{$boun->code}}</b>
              </div>
            </a>
          </li>

        @endforeach
        </ul>
      @endif
  </div>
</div>
<div class="require">
    *每位用户每次最多仅可使用3个优惠码，每个优惠码仅可使用一次!
</div>
<div class="padding-5"></div>
<p>备注</p>
<form class="form" id="next-form" method="post" action="order/pay">
  <input type="hidden" name="form_code" value="{{$formCode}}" >
  <div class="well">
    <div class="row">
      <div class="col-md-7">
        <label class="sr-only">备注</label>
        <textarea class="form-control" name="comment" id="comment" value=""></textarea>
      </div>
      <div class="col-md-5">
        如果您有任何特别要求，请在此告诉我们，51linpai团队将尽量满足您的一切合理要求。
      </div>
    </div>
  </div>
  <p>
    <div class="alert alert-danger hide" id="order-sub-error"></div>
  <p>
  <div class="col-md-6" id="next-step">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <!--
    <div class="padding-5">
      <label  for="contract" class="checkbox">
        <b>请阅读</b>
        <a href="#" class="text-agreement" data-url="buyagreement">《51临牌商品购买协议》</a>
      </label>
    </div>
    -->
    <div class="">
    </div>
    <fieldset id="good-info-field">
      <input type="hidden" required="yes" data-name="商品" name="good" value="{{$good->id}}">
      <input type="hidden" required="yes" data-name="商品数量"  name="num" value="{{$num}}">
    </fieldset>
    <fieldset id="car-info-field">

      @if (!empty($defaultCar))

          <input type="hidden" required="yes" data-name="车辆信息" name="car" value="{{$defaultCar->id}}">

      @else 

          <input type="hidden" required="yes" data-name="车辆信息" name="car" value="">

      @endif

    </fieldset>
    <fieldset id="receiver-info-field">
      @if (!empty($defaultReceiver))

      <input type="hidden" required="yes"data-name="收货人信息" name="receiver" value="{{$defaultReceiver->id}}">

      @else 

      <input type="hidden" required="yes"data-name="收货人信息" name="receiver" value="">

      @endif
    </fieldset>
    <fieldset id="youhui-field">
      <input type="hidden" name="youhui_1" value="">
      <input type="hidden" name="youhui_2" value="">
      <input type="hidden" name="youhui_3" value="">
    </fieldset>
    <button role="button" type="submit" class="btn btn-info btn-lg theme-back-blue" role="button" id="to-pay">下一步</button>
  </div>
  </p>
</form>
<div id="price-pad">
  <img src="/imgs/price-pad.png" class="price-pad-bk">
  <div class="price-content padding-5 t-center" >
    <h4 class="no-margin">订单总计</h4>
    <br>
    <hr class="price-divider">
    <p class="no-margin">
      商品：&nbsp;&nbsp;<span style="color:red;">¥{{$single_price}}</span>
    </p>
    <hr class="price-divider">
    <p class="no-margin">
      数量：&nbsp;&nbsp;<span style="color:red">{{$num}}</span>
    </p>
    <hr class="price-divider">
    <p class="no-margin">
      减免：&nbsp;&nbsp;<span style="color:red" id="discount">0</span>
    </p>
    <hr class="price-divider">
    <p class="no-margin">
      <b style="margin-top:8px;">合计：</b>&nbsp;&nbsp;
      <span>
        ¥<b class="total-price">{{$price}}</b>
      </span>
    </p>
  </div>
</div>
@yield('more-info');

@endsection
