@section('area')
<div data-role="collapsible-set">
<div class="btn-group" role="group" id="v-province">
  <!--
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="selected-province">选择省份</span>
    <span class="caret"></span>
  </button>
  -->
  <div data-role="collapsible">
    <h1>选择省份</h1>
    <ul data-role="listview" id="province-menu">

      <!-- js load data -->

    </ul>
    <div class="clear"></div>
  </div>
</div>
<div class="btn-group" role="group" id="v-city">
<!--
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span id="selected-city">选择城市</span>
    <span class="caret"></span>
  </button>
-->
  <div data-role="collapsible">
    <h1>选择城市</h1>
    <ul data-role="listview" id="city-menu">
      <li  style="padding: 0 5px;">请先选择省份</li>

      <!-- js load data -->

    </ul>
    <div class="clear"></div>
  </div>
</div>
<div class="btn-group" role="group" id="v-district">
<!--
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span id="selected-district">选择区域</span>
    <span class="caret"></span>
  </button>
-->
  <div data-role="collapsible">
    <h1>选择区域</h1>
    <ul data-role="listview" id="district-menu">
      <li style="padding: 0 5px;">请先选择城市</li>

      <!-- js load data -->

    </ul>
    <div class="clear"></div>
  </div>
</div>
</div>

@endsection
