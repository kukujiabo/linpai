@section('step')

<div style="height:50px;background:#eee;padding:0px 10%;">
 <div style="height:2px;background:#00bbff;position:relative;top:25px;width:100%"></div>

@if (!empty($step) && $step == 1)
  <div style="width:24px;height:24px;background:#00bbff;position:relative;top:12px;left:0px;border-radius:12px;float:left;text-align:center;color:white;font-size:15px;vertical-align:middle;line-height:21px;">1</div>
@else 
  <div style="width:20px;height:20px;background:#00bbff;position:relative;top:14px;left:0px;border-radius:10px;float:left;text-align:center;color:white;font-size:12px;line-height:22px;">1</div>
@endif

@if (!empty($step) && $step == 2)
  <div style="width:24px;height:24px;background:#00bbff;position:relative;top:12px;left:26%;border-radius:12px;float:left;text-align:center;color:white;font-size:15px;line-height:20px;">2</div>
@else
  <div style="width:20px;height:20px;background:#00bbff;position:relative;top:14px;left:27%;border-radius:10px;float:left;text-align:center;color:white;font-size:12px;line-height:22px;">2</div>
@endif

@if (!empty($step) && $step == 3)
  <div style="width:24px;height:24px;background:#00bbff;position:relative;top:12px;left:53%;border-radius:12px;float:left;text-align:center;color:white;font-size:15px;line-height:20px;">3</div>
@else
  <div style="width:20px;height:20px;background:#00bbff;position:relative;top:14px;border-radius:10px;float:left;left:54%;text-align:center;color:white;font-size:12px;line-height:22px;">3</div>
@endif


@if (!empty($step) && $step == 4)
  <div style="width:24px;height:24px;background:#00bbff;position:relative;top:12px;border-radius:12px;float:right;text-align:center;color:white;font-size:15px;line-height:20px;">4</div>
@else
  <div style="width:20px;height:20px;background:#00bbff;position:relative;top:14px;border-radius:10px;float:right;text-align:center;color:white;font-size:12px;line-height:22px;">4</div>

@endif

</div>

@endsection
