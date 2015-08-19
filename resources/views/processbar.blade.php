@section('process')
<div id="process-bar" style="margin-top:50px;">
  <ul class="process">
    <li class="process-icon">
      @if (empty($is_select))
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/select-good-inactive.png') }}"></i>
      @else 
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/select-good.png') }}"></i>
      @endif
    </li>
    <li class="process-line"></li>
    <li class="process-icon">
      @if (empty($is_upload))
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/upload-files-inactive.png') }}"></i>
      @else
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/upload-files.png') }}"></i>
      @endif
    </li>
    <li class="process-line"></li>
    <li class="process-icon">
      @if (empty($is_pay))
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/pay-online-inactive.png') }}"></i>
      @else
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/pay-online.png') }}"></i>
      @endif
    </li>
    <li class="process-line"></li>
    <li class="process-icon">
      @if (empty($is_deliver))
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/deliver-inactive.png') }}"></i>
      @else
      <i><img class="p-i-img img-rounded" src="{{ asset('imgs/deliver.png') }}"></i>
      @endif
    </li>
    <div style="clear:both"></div>
  </ul>
  <div style="clear:both;"></div>
</div>
@endsection
