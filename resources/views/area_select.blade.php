@section('area')
<div class="btn-group" role="group" id="v-province">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="selected-province">选择省份</span>
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" id="province-menu" role="menu" style="width:600px;">

    <!-- js load data -->

  </ul>
</div>
<div class="btn-group" role="group" id="v-city">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span id="selected-city">选择城市</span>
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" id="city-menu" role="menu">
    <li  style="padding: 0 5px;">请先选择省份</li>

    <!-- js load data -->

  </ul>
</div>
<div class="btn-group" role="group" id="v-district">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span id="selected-district">选择区域</span>
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" id="district-menu" role="menu">
    <li style="padding: 0 5px;">请先选择城市</li>

    <!-- js load data -->

  </ul>
</div>

@endsection
