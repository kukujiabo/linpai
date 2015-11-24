@extends('mobile/mobile')

@yield('mobile/head')

@section('content')

<div data-role="page">
  <div data-role="header">
    @yield('header')
  </div>
  <div data-role="content" style="padding-left:0px;padding-right:0px;">
    <div style="padding:5px 10px;margin:5px 0px;border:0px;background:#fff">
      <div class="old-header">
        <span class="float-left" style="margin-top:5px;font-size:14px">订单号：{{$order->order_code}}</span>
        <span class="float-right" style="margin-top:5px;font-size:14px">{{$order->created_at}}</span>
        <div class="clear"></div>
      </div>
      <div style="padding:15px 8px;">
        <img src="{{asset($order->good_tiny_pic)}}" class="float-left" style="width:90px" >
        <div class="float-left" style="margin-left:10px;">
          <h3 class="float-left normal-weight" style="margin:5px 0px;">{{$order->good_name}}</h3>
          <h3 class="normal-weight" style="margin:5px 0px;">x {{$order->num}}</h3>
        </div>
        <div class="float-right">
          <h3 class="normal-weight" style="margin:5px 0px;"> ¥ {{$order->orig_price}}</h3>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    <div style="background:#fff;padding:10px;margin-top:10px;font-size:16px;">
      <p style="margin:5px 0px;border:0px;padding:5px;">
        订单号：{{$order->order_code}}
      </p>
      <p style="margin:5px 0px;border:0px;padding:5px;">
        下单时间：{{$order->created_at}}
      </p>
      <p style="margin:5px 0px;border:0px;padding:5px;">
        收件人：{{$order->receiver}}
      </p>
      <p style="margin:5px 0px;border:0px;padding:5px;">
        手机号码：{{$order->mobile}}
      </p>
      <p style="margin:5px 0px;border:0px;padding:5px;">
        收货地址：{{$order->province}}  {{$order->city}} {{$order->district}} {{$order->address}}
      </p>
      <p style="margin:5px 0px;border:0px;padding:5px;">
        物流信息：@if(empty($order->order_deliver_company)) 暂无物流信息 @else {{$order->order_deliver_company}} @endif
      </p>
      <p style="margin:5px 0px;border:0px;padding:5px;">
        运单号：@if(empty($order->deliver_code)) 暂无运单号 @else {{$order->deliver_code}} @endif
      </p>
      <p style="margin:5px 0px;border:0px;padding:5px;">
        物流查询网站： <a href="http://www.sf-express.com" class="normal-weight" style="background:#138ed1;color:#fff;padding:3px;border-radius:1px;text-shadow:none">顺丰速递</a>
      </p>
    </div>
    <div style="padding:10px;background:#fff;margin-top:10px;">
      <p style="margin:5px 0px;border:0px;padding:5px;font-size:18px;">
        实付：<span style="color:#ff8800" >¥ {{$order->final_price}}</span>&nbsp;&nbsp;|&nbsp;&nbsp;已优惠：{{$order->cut_fee}}
      </p>
    </div>
    
    <div style="padding:0px 15%;margin-top:50px;">
      @if ($order->status > 0)

        <a class="ui-btn orange_btn">再次购买</a>

      @else 
      
        <a class="ui-btn blue_full_btn">立即支付</a>

      @endif
    </div>
  </div>
</div>

@endsection
