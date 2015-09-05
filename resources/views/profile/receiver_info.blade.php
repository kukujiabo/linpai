@extends('profile/profile')

@include('tables.receiver_info')

@include('forms.edit_receiver')

@include('modal-box')

@include('scripts.moreinfo')

@section('subcontent')
<div class="sub-wrapper">
  <h3>收货信息</h3>
</div>
<hr class="no-margin">
<div class="sub-wrapper">
  <div class="padding-5"></div>
  @yield('receiver_info')

</div>
<div class="sub-wrapper" id="new-address-toggle">

@if (!empty($receiverInfos))
  <button role="button" class="btn btn-default more-info" id="more-receiver-info" data-target="receiver-list-table" data-mode="hide">
    <span class="glyphicon glyphicon-chevron-down"></span>
    <span class="m-i-value">更多收货地址</span>
  </button>
  &nbsp;&nbsp;
@endif

  <button role="button" class="btn btn-default more-info" id="new-address-add" data-status="show">
    <span class="glyphicon glyphicon-plus"></span>
    <span class="n-a-content">新增收货地址</span>
  </button>
</div>
<div class="padding-5">

  @yield('edit_receiver')

</div>
<div>

  @yield('modal-box')

</div>
@yield('more-info')
@endsection

