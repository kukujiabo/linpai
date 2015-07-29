@extends('app')

@extends('processbar')

@section('content')

<div class="alert alert-warning" role="alert">
  <div class="wrapper">
    <h4>订单号：maskldwoi123</h4>
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
          <span class="line-info" role="city">上海市</span>
          <span class="line-info" role="district">静安区</span>
          <span class="line-info" role="route">陕西南路45号2楼</span>
          <span class="line-info" role="customer">刘德华</span>
          <span class="line-info" role="mobile">13978022992</span>
        </p>
      </div>
      <div class="media-right">
        <p class="v-middle">
          <span class="line-info">实付</span>
          <span class="price">298元</span>
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
    <form class="form" role="form" action="#" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="radio padding-5">
        <label class="control-label" for="zhifubao">
          <input type="radio" id="zhifubao" name="pay"> 支付宝
        </label>
      </div>
      <div class="radio padding-5">
        <label class="control-label" for="credit">
          <input type="radio" id="credit" name="pay"> 网银或信用卡
        </label>
      </div>
      <div class="radio padding-5">
        <label class="control-label" for="wechat">
          <input type="radio" id="wechat" name="pay"> 微信支付
        </label>
      </div>
      <div class="radio padding-5">
        <label class="control-label" for="zhifubao-code">
          <input type="radio" id="zhifubao-code" name="pay"> 支付宝二维码
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
<div class="alert alert-info">
  <div class="wrapper">
    <h4>支付帮助</h4>
    <p>
      <div class="help">
        1.点击支付按钮，页面没有跳转
      </div>
      <div class="help">
        2.快捷支付提示“支付失败，当前交易有风险”
      </div>
    </p>
  </div>
</div>
@endsection
