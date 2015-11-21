@extends('mobile/mobile')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>订单详情 - 51临牌</h1>
  </div>
  <div data-role="content">
    <ul data-role="listview">
      <li style="padding:5px 10px;margin:5px 0px;border:0px">
        <div class="old-header">
          <span class="float-left" style="margin-top:5px;font-size:12px">订单号：{{$order->order_code}}</span>
          <span class="float-right" style="margin-top:5px;font-size:12px">{{$order->created_at}}</span>
          <div class="clear"></div>
        </div>
        <div style="padding:8px;">
          <img src="{{asset($order->good_tiny_pic)}}" class="float-left" style="width:80px" >
          <h3 class="float-left" style="margin-left:5px;">{{$order->good_name}}</h3>
          <div class="float-right">
            <h3 class="no-margin"> ¥ {{$order->orig_price}}</h3>
            <h3 class="no-margin">x {{$order->num}}</h3>
          </div>
        </div>
      </li>
      <li style="margin:5px 0px;border:0px">
        收件人：{{$order->receiver}} {{$order->phone}}
      </li>
      <li style="margin:5px 0px;border:0px">
        收货地址：{{$order->province}}  {{$order->city}} {{$order->district}} {{$order->address}}
      </li>
      <li style="margin:5px 0px;border:0px">
        车辆信息：{{$order->car_type}} {{$order->car_brand}} {{$order->car_owner}}
      </li>
      <li style="margin:5px 0px;border:0px">
        实付：¥ {{$order->final_price}} | 已优惠：{{$order->cut_fee}}
      </li>

    </ul>
  </div>
</div>

@endsection
