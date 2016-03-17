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
      <!--
      <a href="/miniorder/buy?car_hand=2" data-ajax="false" style="margin-top:5%" class="ui-btn  ui-shadow ui-corner-all " >二手车</a>
      -->
    </div>    
  </div>
  <!--
  <div data-role="footer" style="position:fixed;bottom:0px">
    <h1>www.51linpai.com</h1>
  </div>
  -->
</div>

@endsection


