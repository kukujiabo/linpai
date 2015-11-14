@extends('mobile/mobile')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>我的订单 - 51临牌</h1>  
  </div>
  <div data-role="content">
  
    <ul data-role="listview">

    @foreach ($orders as $order)

      <li class="order-list-itm" style="padding:10px;margin:5px;border:1px solid #ddd;border-radius:5px;">
        <div class="oli-header">
            <span class="float-left" style="margin-top:5px;font-size:12px">订单号：{{$order->order_code}}</span>
            <span class="float-right" style="margin-top:5px;font-size:12px">{{$order->created_at}}</span>
          <div class="clear"></div>
        </div>
        <div class="oli-content">
          <img  class="m_g_pic inline float-left" src="{{asset($order->good_tiny_pic)}}"> 
          <div class="inline float-left" style="padding-left:10px">
            <h2 class="margin-5">{{$order->good_name}}</h2>
          </div>
          <div class="inline float-right text-right" style="padding-right:10px;">
            <h3 class="margin-5">{{$order->orig_price}}</h3>
            <h4 class="margin-5">x {{$order->num}}</h4>
          </div>
          <div class="clear"></div>
        </div>
        <div class="oli-footer">
          <div class="inline float-right" style="padding-right:10px">
            <span class="margin-5 inline float-right" style="font-size:12px;">实付：{{$order->final_price}}</span>
            <span class="margin-5 inline float-right" style="font-size:12px;">减免：{{$order->cut_fee}} | </span> 
          </div>
          <div class="clear"></div>
        </div>
        <div class="oli-operator text-right">
            <a class="float-left ui-btn ui-btn-inline ui-shadow ui-corner-all ui-mini" href="/mobile/orderinfo?order_code={{$order->order_code}}">查看详情</a>
          @if ($order->status == 0)
            <a class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-mini" role="button">马上支付</a>
          @elseif ($order->status == 1)
            <a class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-mini" role="button">等待发货</a>
          @elseif ($order->status == 2)
            <a class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-mini" role="button">查看物流</a>
          @endif
            <a class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-mini"  role="button" >再次购买</a> 
        </div>
      </li>

    @endforeach

    </ul>
      
  </div>
  <div data-role="footer">
    <h2>www.51linpai.com</h2>
  </div>
</div>

@endsection
