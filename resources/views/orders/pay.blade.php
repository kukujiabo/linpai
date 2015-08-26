@extends('app')

@extends('processbar')

@section('content')

<div class="alert alert-warning" role="alert">
  <div class="wrapper">
    <h4>订单号：{{$order->code}}</h4>
    <h4>购买商品：{{$good->name}} * {{$order->num}}</h4>
    <p>
      感谢您的购买，请在<span class="require">48小时内支付</span>以便于我们开办临牌，48小时后您的订单将自动取消。
    </p>
  </div>
</div>
<div id="order-info" class="box">
  <div class="block-head">
    <h4>订单信息</h4>
  </div>
  <div class="wrapper padding-20">
    <div class="media">
      <div class="media-left">
        <a href="#" class="gray-light" style="display:block">
          <img class="media-object" src="{{ asset('imgs/blip-64.png') }}" alt="">
        </a>
      </div>
      <div class="media-body">
        <p class="v-middle"> 
          <span class="line-info"><b>寄送地址：</b></span>
          <span class="line-info">{{$receiver->province}}</span>
          <span class="line-info" role="city">{{$receiver->city}}</span>
          <span class="line-info" role="district">{{$receiver->district}}</span>
          <span class="line-info" role="route">{{$receiver->address}}</span>
          <span class="line-info" role="customer">{{$receiver->receiver}}</span>
          <span class="line-info" role="mobile">{{$receiver->mobile}}</span>
        </p>
        <p class="v-middle">
          @if (!empty($order->comment))
            <span class="line-info"><b>备注：</b></span>
            <span style="color:#8a6d3b">{{$order->comment}}</span>
          @endif
        </p>
      </div>
      <div class="media-right">
        <p class="">
          <span class="line-info">实付金额</span>
          <span class="total-price">{{$orderPrice->final_price}}元</span>
        </p>
      </div>
    </div>
  </div>
</div>
<div class="padding-5">
</div>
<div id="deliver" class="box">
  <div class="block-head">
    <h4>支付方式</h4>
  </div>
  <div class="padding-20">
    <form class="form" role="form" action="{{asset('order/payed')}}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <input type="hidden" name="order_code" value="{{$order->code}}"/>
      <div class="radio padding-5">
        <label class="control-label" for="zhifubao">
          <input type="radio" id="zhifubao" name="pay" value="zhifubao"> 支付宝
        </label>
      </div>
      <div class="radio padding-5">
        <label class="control-label" for="credit">
          <input type="radio" id="credit" name="pay" value="union">网银或信用卡
        </label>
      </div>
      <div class="radio padding-5">
        <label class="control-label" for="wechat">
          <input type="radio" id="wechat" name="pay" value="wechat"> 微信支付
        </label>
      </div>
      <div class="radio padding-5">
        <label class="control-label" for="zhifubao-code">
          <input type="radio" id="zhifubao-code" name="pay" value="qrcode">支付宝二维码
        </label>
      </div>
      <div class="form-group padding-5">
        <button role="button" class="btn btn-danger " type="submit">立即支付</button>
      </div>
    </form>
  </div>
</div>
<div class="padding-5">
</div>
<div class="box no-padding">
  <div class="block-head">
    <h4>支付帮助</h4>
  </div>
  <div class="sub-wrapper">
    <p>
      <div class="help padding-5">
        1.点击支付按钮，页面没有跳转
        <p class="padding-5">
          <span class="solve-title">解决方案</span>建议您更换一个浏览器后重新尝试，如不奏效，建议您尝试更换网络环境或到另一台设备上重新操作。
        </p>
      </div>
      <div class="help padding-5">
        2.快捷支付提示“支付失败，当前交易有风险”
        <p class="padding-5">
          <span class="solve-title">解决方案</span>您的交易存在风险，建议您先在支付宝网站上绑定手机再进行操作。
        </p>
      </div>
    </p>
  </div>
</div>
@endsection
