@extends('profile/profile')

@include('tables.receiver_info')

@include('forms.edit_receiver')

@include('modal-box')

@section('subcontent')
<div class="sub-wrapper">
  <h3>收货信息</h3>
</div>
<hr class="no-margin">
<div class="padding-5">
  
  @yield('receiver_info')

</div>
<hr class="no-margin">
<div class="padding-5">

  @yield('edit_receiver')

</div>
<div>

  @yield('modal-box')

</div>
<script type="text/javascript">
  window.onload = function () {
  
    $('#new-address-info').fadeIn();
  
  };
</script>
@endsection

