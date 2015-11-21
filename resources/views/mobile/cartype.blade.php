@extends('mobile/mobile')

@include('mobile/step')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>购买临牌 - 51临牌</h1>
  </div>
  @yield('step')
  <div data-role="content">
    <h3>请选择车辆类型：</h3>
    <div style="margin-top:10%;">
      <a href="/miniorder/buy?car_hand=1" role="button" class="ui-btn  ui-shadow ui-corner-all " >新车</a>
      <a href="/miniorder/buy?car_hand=2" style="margin-top:5%" role="button" class="ui-btn  ui-shadow ui-corner-all " >二手车</a>
    </div>    
  </div>
  <!--
  <div data-role="footer" style="position:fixed;bottom:0px">
    <h1>www.51linpai.com</h1>
  </div>
  -->
</div>

@endsection


