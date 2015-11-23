@extends('mobile/mobile')


@section('content')


<div data-role="page">
  <div data-role="header">
    <h1>订单支付错误</h1>  
  </div>
  <div data-role="content">
    <p style="text-align:center;padding:30px">
      订单：{{$order->code}} 已完成支付，请勿重复支付！
    </p>
  </div>
</div>

@endsection
