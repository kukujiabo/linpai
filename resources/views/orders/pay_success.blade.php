@extends('app')

@extends('processbar')

@section('content')

<div class="box alert alert-success">
  <div class="block-wrapper-10">
    <h4 class="page-header">
      <div class="col-xs-1"><i id="payed-done"></i></div>
      <div class="col-xs-3" style="padding-top:25px;">"订单支付成功！</div>
      <div style="clear:both"></div>
    </h4>
    <div class="padding-5"></div>
    <div class="row">
      <p class="col-xs-5">
        订单编号：{{$order->code}}
      </p>
    </div>
    <div class="padding-5"></div>
    <div class="row">
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
      </p>
      <p class="col-md-2">
        <span class="name">
          收件人：<b>{{$receiverInfos->receiver}}</b>
        </span>
      </p>
      <p class="col-md-3">
        <span class="name">
          手机号：<b>{{$receiverInfos->mobile}}</b>
        </span>
      </p>
    </div>
  </div>
</div>

@endsection
