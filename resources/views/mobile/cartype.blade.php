@extends('mobile/mobile')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>购买临牌 - 51临牌</h1>
  </div>
  <div style="height:50px;background:#eee;padding:0px 10%;">
    <div style="height:2px;background:#00bbff;position:relative;top:25px;width:100%"></div>
    <div style="width:24px;height:24px;background:#00bbff;position:relative;top:13px;left:0px;border-radius:12px;float:left;text-align:center;color:white;font-size:12px;vertical-align:middle;line-height:22px;">1</div>
    <div style="width:20px;height:20px;background:#00bbff;position:relative;top:15px;left:27%;border-radius:10px;float:left;text-align:center;color:white;font-size:12px;line-height:20px;">2</div>
    <div style="width:20px;height:20px;background:#00bbff;position:relative;top:15px;left:54%;border-radius:10px;float:left;text-align:center;color:white;font-size:12px;line-height:20px;">3</div>
    <div style="width:20px;height:20px;background:#00bbff;position:relative;top:15px;left:80%;border-radius:10px;float:left;text-align:center;color:white;font-size:12px;line-height:20px;">4</div>
  </div>
  <div data-role="content">
    <h3>请选择车辆类型：</h3>
    <div style="margin-top:10%;">
      <a href="/miniorder/buy?car_hand=1" role="button" class="ui-btn  ui-shadow ui-corner-all " >新车</a>
      <a href="/miniorder/buy?car_hand=2" style="margin-top:5%" role="button" class="ui-btn  ui-shadow ui-corner-all " >二手车</a>
    </div>    
  </div>
  <!--
  <div data-role="footer" style="position:fixed;bottom:0px">
    <h1>www.51linpai.com</h1>
  </div>
  -->
</div>

@endsection


