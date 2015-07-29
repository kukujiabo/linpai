@extends('app')

@section('content')
<div class="row">
  <div class="col-md-2 col-lg-2">
    <div class="well sidebar-nav profile-wrapper box" role="navigation">  
      <ul class="nav nav-list profile-menu">
        <li class="">
          <a href="{{ asset('profile/myorder') }}">
          <span class="glyphicon glyphicon-shopping-cart"></span>
          我的订单</a>
        </li>
        <li class="">
          <a href="account">
          <span class="glyphicon glyphicon-wrench"></span>
          帐号设置</a>
        </li>
        <li class="">
          <a href="{{ asset('profile/carinfo') }}">
          <span class="glyphicon glyphicon-file"></span>
          车辆信息</a>
        </li>
        <li class="">
          <a href="#">
          <span class="glyphicon glyphicon-pencil"></span>
          收货信息</a>
        </li>
        <li class="">
          <a href="#">
          <span class="glyphicon glyphicon-tag"></span>
          优&nbsp;&nbsp;惠&nbsp;&nbsp;券</a>
        </li>
      </ul>
    </div>
  </div>
  <div class="col-md-10 col-lg-10">
    <div class="profile-wrapper box">
      <div class="profile-head"></div>
      @yield('subcontent')

    </div>
  </div>
</div>
@endsection
