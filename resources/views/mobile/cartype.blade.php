@extends('mobile/mobile')

@include('mobile/step')

@include('mobile/head')

@section('content')

<div data-role="page">
  <div data-role="header">
   @yield('header') 
  </div>
  @yield('step')
  <div data-role="content">
    <h3>请选择车辆类型：</h3>
    <div style="margin-top:10%;">
      <a href="/miniorder/buy?car_hand=1" data-ajax="false" class="ui-btn  ui-shadow ui-corner-all " >新车</a>
      <a href="/miniorder/buy?car_hand=2" data-ajax="false" style="margin-top:5%" class="ui-btn  ui-shadow ui-corner-all " >二手车</a>
    </div>    
  </div>
  <!--
  <div data-role="footer" style="position:fixed;bottom:0px">
    <h1>www.51linpai.com</h1>
  </div>
  -->
</div>
<div style="position:fixed;width:100%;height:100%;background:#000;opacity:0.5;z-index:1000">
</div>
<div style="padding:20px;text-align:center;position:fixed;width:50%;left:22%;background:#d9534f;color:white;font-size:24px;z-index:1001"> 即将上线，敬请期待！ 
</div>

@endsection


