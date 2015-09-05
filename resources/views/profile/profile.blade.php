@extends('app')

@include('navs.pathnav')

@section('content')
<div class="top-50">

</div>
<div class="row padding-5">
  @yield('path-nav')
</div>
<div class="row">
  <div class="col-md-2 col-lg-2">
    <div class="well sidebar-nav profile-wrapper box no-padding" role="navigation">  
      <ul class="nav nav-list profile-menu">

        @if (!empty($orderActive))

        <li class="profile-active">

        @else

        <li>
        
        @endif

          <a href="{{ asset('profile/myorder') }}">
          <span class="glyphicon glyphicon-shopping-cart"></span>
          我的订单</a>
        </li>
        <hr class="no-margin"></hr>

        @if (!empty($accountActive))

        <li class="profile-active">

        @else

        <li> 
            
        @endif

          <a href="account">
          <span class="glyphicon glyphicon-wrench"></span>
          帐号设置</a>
        </li>
        <hr class="no-margin"></hr> 

        @if (!empty($carActive))

        <li class="profile-active">

        @else

        <li>

        @endif

          <a href="{{ asset('profile/carinfo') }}">
          <span class="glyphicon glyphicon-file"></span>
          车辆信息</a>
        </li>
        <hr class="no-margin"></hr>

        @if (!empty($receiverActive))

        <li class="profile-active">

        @else 

        <li>

        @endif
        
          <a href="{{ asset('profile/receiverinfo')}}">
          <span class="glyphicon glyphicon-pencil"></span>
          收货信息</a>
        </li>
        <hr class="no-margin"></hr>

        @if (!empty($bounsActive))

          <li class="profile-active">

        @else 

          <li>

        @endif
          <a href="{{ asset('profile/mybouns') }}">
          <span class="glyphicon glyphicon-tag"></span>
          优&nbsp;&nbsp;惠&nbsp;&nbsp;券</a>
        </li>
      </ul>
    </div>
  </div>
  <div class="col-md-10 col-lg-10">
    <div class="profile-wrapper box no-padding" style="min-height: 400px;">
      <div class="profile-head"></div>
      @yield('subcontent')
    </div>
  </div>
</div>
@endsection
