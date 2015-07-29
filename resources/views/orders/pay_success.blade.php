@extends('app')

@extends('processbar')

@section('content')

<div class="box alert alert-success">
  <div class="block-wrapper-10">
    <h4 class="page-header">订单支付成功！</h4>
    <p class="help">
      订单编号：JSNKW2923819283
    </p>
    <p class="help">
      您所购买的商品将送至：
      <span class="city">
        上海市
      </span>
      <span class="district">
        静安区
      </span>
      <span class="road">
        陕西南路34号2楼206
      </span>
      <span class="name">
        刘德华
      </span>
    </p>
  </div>
</div>

@endsection
