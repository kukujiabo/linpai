@extends('profile/profile')

@section('subcontent')


<div class="row order-head text-center">
  <div class="col-md-4">商品名称</div>
  <div class="col-md-2">单价（元）</div>
  <div class="col-md-2">数量</div>
  <div class="col-md-2">优惠减免</div>
  <div class="col-md-2">实付款</div>
</div>
<div class="row padding-5">
  <div class="col-md-4">
    <div class="col-xs-5 padding-5">
      <img src="{{$order->good_tiny_pic}}" width="100%">
    </div>
    <div class="col-xs-7  order-col">
      {{$order->good_name}}
    </div> 
  </div>
  <div class="col-md-2 order-col">
    {{$order->sum/$order->num}}
  </div>
  <div class="col-md-2 order-col">
    {{$order->num}}
  </div>
  <div class="col-md-2 order-col">
    {{$order->cut_fee}}
  </div>
  <div class="col-md-2 order-col">
    {{$order->final_price}}
  </div>
</div>
<hr class="no-margin">
<div class="padding-20">
  <div class="row">
  <div class="col-xs-6 no-padding">
  <h4>订单状态：
    @if ($order->status == 0)
      未付款
    @elseif ($order->status == 1)
      已付款
    @elseif ($order->status == 2)
      已发货
    @else
      已取消
    @endif
  </h4>
  </div>
  <div class="col-xs-2 col-xs-offset-4">
  <a href="/profile/myorder" class="btn btn-primary theme-back-blue">查看所有订单</a>
  </div>
  </div>
  <div class="padding-5"></div>
  <p class="theme">
    订&nbsp;&nbsp;单&nbsp;&nbsp;号：<span class="theme-orig">{{$order->order_code}}</span>
  </p>
  <p>
    下单时间：{{$order->created_at}}
  </p>
  <p>
    收&nbsp;&nbsp;件&nbsp;&nbsp;人：{{$order->receiver}}
  </p>
  <p>
    手机号码：{{$order->mobile}}
  </p>
  <p>
    收货地址：{{$order->province}}{{$order->city}}{{$order->district}}{{$order->address}}
  </p>
  <p>
    @if (!empty($deliver->id))
      物流信息：<img src="/imgs/shunfeng_icon.png" style="width:36px;height:36px;">&nbsp;顺丰速运
    @else
      物流信息：暂无物流信息
    @endif
  </p>
  <p>
    @if (!empty($deliver->id))
      运&nbsp;&nbsp;单&nbsp;&nbsp;号：{{$deliver->code}}
    @else
      运&nbsp;&nbsp;单&nbsp;&nbsp;号：暂无
    @endif
  <p>
    @if (!empty($deliver->id))
      物流查询网站：<a target="_blank" href="http://sf-express.com">www.sf-express.com</a>
    @else
      物流查询网站：暂无信息
    @endif
  </p>
</div>

@endsection
