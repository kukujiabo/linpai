@extends('mobile/mobile')


@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>填写资料 - 51临牌</h1>
  </div>
  <div style="height:50px;background:#eee;padding:0px 10%;">
    <div style="height:2px;background:#00bbff;position:relative;top:25px;width:100%"></div>
    <div style="width:20px;height:20px;background:#00bbff;position:relative;top:15px;left:0px;border-radius:10px;float:left;text-align:center;color:white;font-size:12px;vertical-align:middle;line-height:20px;">1</div>
    <div style="width:22px;height:22px;background:#00bbff;position:relative;top:13px;left:27%;border-radius:12px;float:left;text-align:center;color:white;font-size:12px;line-height:22px;">2</div>
    <div style="width:20px;height:20px;background:#00bbff;position:relative;top:15px;left:54%;border-radius:10px;float:left;text-align:center;color:white;font-size:12px;line-height:20px;">3</div>
    <div style="width:20px;height:20px;background:#00bbff;position:relative;top:15px;left:80%;border-radius:10px;float:left;text-align:center;color:white;font-size:12px;line-height:20px;">4</div>
  </div>
  <div data-role="content">
    <ul data-role="listview">
      <li style="margin: 8px 0px;border:0px">
        <div style="padding:5px;"> 
          <img  class="m_g_pic inline float-left" src="{{asset($good->tiny_good)}}"> 
          <div class="float-left" style="padding-left:10px;">
            <h4>{{$good->name}}</h4>
          </div>
        </div>
      </li>
      <li style="padding:0px;border:0px">
        <div data-role="collapsible" class="no-margin">
          <h1>车辆信息 -- 
            <span id="selected_car">
              @if (!empty($defaultCar))
                {{$defaultCar->owner}}&nbsp;&nbsp;{{$defaultCar->brand}}&nbsp;&nbsp;{{$defaultCar->reco_code}}
              @endif
            </span>
          </h1>
          <p style="no-margin">
            <ul data-role="listview">

              @foreach($cars as $car)
                @if ($car->last_used == 1)
                  <li class="selected-itm" data-target="">
                @else
                  <li class="select-itm" data-target="">
                @endif
                    {{$car->owner}}&nbsp;&nbsp;{{$car->brand}}&nbsp;&nbsp;{{$car->reco_code}}
                  </li>
              @endforeach

            </ul>
          </p>
        </div>
        <div data-role="collapsible" class="no-margin">
          <h1>收件人 -- 
              <span id="selected_receiver">
                @if (!empty($defaultReceiver))
                  {{$defaultReceiver->receiver}}&nbsp;&nbsp;{{$defaultReceiver->mobile}}&nbsp;&nbsp;{{$defaultReceiver->address}}
                @endif
              </span>
          </h1>
          <p class="no-margin">
            <ul data-role="listview">
            
              @foreach($receivers as $receiver)
                @if ($receiver->last_used == 1)
                  <li class="selected-itm" data-target="">
                @else
                  <li class="select-itm" data-target="">
                @endif
                  {{$receiver->receiver}}&nbsp;&nbsp;{{$receiver->mobile}}&nbsp;&nbsp;{{$receiver->province}}&nbsp;{{$receiver->city}}&nbsp;{{$receiver->address}}
                </li>
              @endforeach

              <li data-icon="plus"><a href="#">添加新的收件人</a></li>
        
            </ul>
          </p> 
        </div>
        <div data-role="collapsible" class="no-margin">
          <h1>使用优惠券<span id="selected_boun"></span></h1>
          <p style="">

            @if (!count())


            @else
            <ul data-role="listview">
            @foreach($bouns as $boun)
              <li class="selected-itm">
                {{$boun->code}} 
              </li>
            @endforeach
            </ul>
            @end

          </p>
        </div>
        <div data-role="collapsible" class="no-margin">
          <h1>添加备注<span id="selected_boun"></span></h1>
          <p style="">
            <textarea class="no-margin" name="addinfo" id="info"></textarea>
          </p>
        </div>
      </li>
    </ul>
  </div>
  <div data-role="footer" style="width:100%;position:fixed;bottom:0px;">
    <h2>www.51linpai.com</h2>
  </div>

</div>

@endsection
