@extends('mobile/mobile')

@include('mobile/head')

@section('content')

<div data-role="page">
  <div data-role="header">
    @yield('header')
  </div>
  @yield('step')
  <div data-role="content" style="padding-left:0;padding-right:0">
    
    <!-- 商品信息 -->
    <div class="ui-content inner_white" style="background:white;border:1px solid #eee">
      订单号：{{$order->code}}
    </div>
    <div class="ui-content" style="background:white">
      <div id="test_code"></div>
      <div style="float:left;padding:5px;"> 
        <img  class="m_g_pic inline float-left" src="{{asset($good->tiny_good)}}"> 
        <div class="float-left" style="padding-left:10px;">
          <h4 style="font-weight:normal;margin:5px">{{$good->name}}</h4>
          <h4 style="font-weight:normal;color:#ff8800;margin:5px;">¥ {{$orderPrice->final_price}}</h4>
        </div>
      </div>
      <div class="float-right" style="padding-right:10px;float:right">
        <h4  style="font-weight:normal;margin:6px;text-align:right">x {{$order->num}}</h4>
        <h4  style="font-weight:normal;margin:5px;color:#d9534f">优惠：{{$orderPrice->cut_fee}}</h4>
      </div>
      <div class="clear"></div>
    </div>
    <form data-ajax="false" data-role="none" action="/order/mobilepay" method="get" style="margin-top:20px;">
        <label class="no-radius" style="background:white" for="wechat">
          <img src="/imgs/weixinpay_tiny.png" style="float:left;width:40px;font-size:18px;">
          <div style="float:left;padding:2px;">微信支付</div>
          <div class="clear"></div>
        </label>
        <input type="radio" name="pay" id="wechat" value="wechat" style="display:none" checked> 
        <fieldset>
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="order_code" value="{{$order->code}}">
        </fieldset>
        <div style="padding:20px;margin-top:40px;">
          <button type="submit" class="blue_full_btn">立即支付</button>
        </div>
    </form>
  </div>
</div>

@endsection


