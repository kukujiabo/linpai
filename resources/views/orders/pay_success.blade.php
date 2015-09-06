@extends('app') 

@extends('processbar')

@section('content')

<div class="box">
  <div class="block-wrapper-10">
    <h4 class="page-header no-margin">
      <div class="col-xs-1"><i id="payed-done"></i></div>
      <div class="col-xs-3" style="padding-top:25px;">"订单支付成功！</div>
      <div style="clear:both"></div>
    </h4>
    <div class="padding-5"></div>
    <div class="row padding-5">
      <p class="col-xs-5">
        <b class="theme-orig">订单编号：{{$order->code}}</b>
      </p>
    </div>
    <div class="row padding-5">
      <p class="help col-md-7">
        您所购买的商品将送至：
        <span class="province">
          {{$receiverInfos->province}}
        </span>
        <span class="city">
          {{$receiverInfos->city}}
        </span>
        <span class="district">
          {{$receiverInfos->district}}
        </span>
        <span class="road">
          {{$receiverInfos->address}}
        </span>
        <span class="name">
          收件人：<b>{{$receiverInfos->receiver}}</b>
        </span>
      </p>
    </div>
  </div>
</div>

@endsection
