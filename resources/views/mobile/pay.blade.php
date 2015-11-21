@extends('mobile/mobile')

@include('mobile/step')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>订单支付 － 51临牌</h1>
  </div>
  @yield('step') 
  <div data-role="content" style="padding-left:0px;padding-right:0px;">
    <!-- 商品信息 -->
    <div style="background:#fff;">
      <h4 class="no_weight" style="margin:5px 0px;padding:15px;border-bottom:1px solid #eee">
        订单号：{{$order->code}}
      </h4>
      <div style="padding:15px"> 
        <img  class="m_g_pic inline float-left" src="{{asset($good->tiny_good)}}"> 
        <div class="float-left" style="padding-left:10px;">
          <h4 style="font-weight:normal;margin:0px 0px 5px 5px">{{$good->name}}</h4>
          <h4 style="font-weight:normal;color:#ff8800;margin:5px;font-size:12px;">¥ {{$orderPrice->orig_price}}</h4>
          <h4 style="font-weight:normal;margin:5px;font-size:12px;">x {{$order->num}}</h4>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    
    <!-- 车辆信息 -->
    
    <div style="background:#fff;margin-top:10px;">
      <h4 class="no_weight" style="margin:5px 0px;padding:15px;border-bottom:1px solid #eee">
        车辆信息
      </h4>
      <div style="padding:15px">
        <p>所有人：{{$car->owner}}</p>
        <p>厂牌型号：{{$car->factory_code}}</p>
        <p>识别代码：{{$car->reco_code}}</p>
      </div>
    </div>
    <!-- 收件人信息 -->
    <div style="background:#fff;margin-top:5px;">
      <h4 class="no_weight" style="margin:5px 0px;padding:15px;border-bottom:1px solid #eee">
       收货信息
      </h4>
      <div style="padding:15px">
        <p>收货人：{{$receiver->receiver}}</p>
        <p>收货地址：{{$receiver->province}}{{$receiver->city}}{{$receiver->district}}</p>
        <p>联系号码：{{$receiver->mobile}}</p>
        <p>邮箱地址：{{$receiver->email}}</p>
      </div>
    </div>

    <!-- 优惠券 -->
    <div style="background:#fff;margin-top:10px;padding:15px;">
      <h4 class="no_weight" style="float:left;margin:0px;">
        <img src="/imgs/mini_youhuiquan.png" height="16px">&nbsp;优惠券
      </h4>
      <div style="float:right;color:#d9534f">减免 ¥ {{$reduction}} </div>
      <div class="clear"></div>
    </div>
      
    <!-- 备注内容 -->
    <div style="background:#fff;margin-top:10px;padding:15px;">
      <h4 class="no_weight" style="float:left;margin:0px;">
        备注：
      </h4>
      <p class="end_ellipse" style="float:right;margin:0px;">
        {{$order->comment}}
      </p>
      <div class="clear"></div>
    </div>
    <div style="background:#fff;margin-top:10px;padding:15px;">
      <form data-role="none" action="" method="post">
        <fieldset class="text-center" data-role="controlgroup" data-type="horizontal">
          <h4 style="margin:10px;">请选择支付方式</h4>
          <label for="zhifubao" style="width:100px;text-align:center;">
            <img src="/imgs/zhifubao.png" width="30px">
            支付宝
          </label>
          <input type="radio" data-inset="false" name="pay" id="zhifubao" value="zhifubao">
          <label for="wechat" style="width:100px;text-align:center;">
            <img src="/imgs/weixinpay_tiny.png" width="30px">
            微信
          </label>
          <input type="radio" name="pay" data-inset="false" id="wechat" value="wechat"> 
        </fieldset>
        <fieldset>
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="pay_code" value="">
          <input type="hidden" name="order_code" value="{{$order->code}}">
        </fieldset>
      </form>
    </div>
  </div>
  <div style="margin:10px 0px 0px 0px;padding:0px;width:100%;height:50px;">
    <div style="float:left;margin:0px;padding:17px 0px;background:#666;color:#fff;text-align:center;width:50%;font-size:15px;font-weight:normal;text-shadow:none">
      实付：¥{{$orderPrice->final_price}}
    </div>
    <div style="float:right;margin:0px;padding:15px 0px;background:#d9534f;color:#fff;text-align:center;width:50%;font-size:18px;font-weight:normal;text-shadow:none">
      下一步
    </div>
    <div class="clear"></div>
  </div>
</div>

@endsection
