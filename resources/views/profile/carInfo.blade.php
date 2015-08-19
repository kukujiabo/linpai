@extends('profile/profile')

@include('forms.edit_car')

@include('tables.car_info')

@section('subcontent')
<div class="sub-wrapper">
  <h3>车辆信息</h3> 
</div>
<hr class="no-margin">
<div class="padding-5">

  @yield('car_info')

</div>

<hr class="no-margin">

<div class="padding-5">
  @yield('edit_car')
</div>

<script type="text/javascript">
  (function () {
  
    window.onload = function () {
    
      $('#car-info-edit').fadeIn('fast');
    
    };
  
  })();
</script>
@endsection
