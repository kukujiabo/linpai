@extends('profile/profile')

@include('forms.edit_car')

@include('tables.car_info')

@include('scripts.moreinfo')

@section('subcontent')
<div class="sub-wrapper">
  <h4>车辆信息</h4> 
</div>
<hr class="no-margin">
<div class="sub-wrapper">
<div class="padding-5"></div>

  @yield('car_info')

</div>
<div class="sub-wrapper" id="car-info-toggle">
  @if (count($cars) < 2)

  <button role="button" class="hide btn btn-default more-info" id="more-car-info" data-target="car-list-table" data-mode="hide">

  @else 

  <button role="button" class="btn btn-default more-info" id="more-car-info" data-target="car-list-table" data-mode="hide">

  @endif
    <span class="glyphicon glyphicon-chevron-down"></span>
    <span class="m-i-value">更多车辆信息</span>
  </button>
  &nbsp;&nbsp;
  <button role="button" class="btn btn-default hide" id="car-info-add" data-status="show" disabled>
    <span class="glyphicon glyphicon-plus"></span>
    <span id="c-i-a-content" data-close="新增车辆信息" data-open="取消编辑信息">新增车辆信息</span>
  </button>
</div>
<div class="padding-5">
  @yield('edit_car')
</div>

<!--
<script type="text/javascript">
  (function () {
  
    window.onload = function () {
    
      $('#car-info-edit').fadeIn('fast');
    
    };
  
  })();
</script>
-->
@yield('more-info')
@endsection
