@section('process')
<div id="process-bar" style="margin-top:50px;">
  <ul class="process">
    <li class="process-icon">
      @if (empty($is_select))
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/select-inactive.png') }}"></i>
      @else 
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/select-active.png') }}"></i>
      @endif
    </li>
    <li class="process-line"></li>
    <li class="process-icon">
      @if (empty($is_upload))
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/upload-inactive.png') }}"></i>
      @else
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/upload-active.png') }}"></i>
      @endif
    </li>
    <li class="process-line"></li>
    <li class="process-icon">
      @if (empty($is_pay))
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/pay-inactive.png') }}"></i>
      @else
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/pay-active.png') }}"></i>
      @endif
    </li>
    <li class="process-line"></li>
    <li class="process-icon">
      @if (empty($is_deliver))
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/deliver-inactive.png') }}"></i>
      @else
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/deliver-active.png') }}"></i>
      @endif
    </li>
    <div style="clear:both"></div>
  </ul>
  <div style="clear:both;"></div>
</div>
@endsection
