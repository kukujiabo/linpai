@extends('mobile/mobile')

@include('mobile/step')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>填写资料 - 51临牌</h1>
  </div>
    @yield('step')
  <div data-role="content" style="padding-left:0px;padding-right:0px;">
    <div class="ui-content">
        <div style="float:left;padding:5px;"> 
          <img  class="m_g_pic inline float-left" src="{{asset($good->tiny_good)}}"> 
          <div class="float-left" style="padding-left:10px;">
            <h4 style="font-weight:normal;margin:5px">{{$good->name}}</h4>
            <h4 style="font-weight:normal;color:#ff8800;margin:5px;">¥ {{$goodInfo->value}}</h4>
          </div>
        </div>
        <div style="float:right;padding:5px">
          <div data-role="controlgroup" data-type="horizontal">
            <a href="#" class="ui-btn ui-mini">-</a>
            <a href="#" class="ui-btn ui-mini">1</a>
            <a href="#" class="ui-btn ui-mini">+</a>
          </div>
        </div>
        <div class="clear"></div>
    </div>
    <div data-role="collapsibleset">
      <div data-iconpos="right"  data-role="collapsible" class="no-radius" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
        <h1 class="itm-title">车辆信息
          <!--
          <span id="selected_car">
            @if (!empty($defaultCar))
              {{$defaultCar->owner}}&nbsp;&nbsp;{{$defaultCar->brand}}&nbsp;&nbsp;{{$defaultCar->reco_code}}
            @endif
          </span>
          -->
        </h1>
        <p style="no-margin">
          <ul data-role="listview">

            @foreach($cars as $car)
              @if ($car->last_used == 1)
                <li class="selected-itm info_itm" data-target="" data-type="car" data-id="{{$car->id}}">
              @else
                <li class="select-itm info_itm" data-target="" data-type="car" data-id="{{$car->id}}">
              @endif
                  {{$car->owner}}&nbsp;&nbsp;{{$car->brand}}&nbsp;&nbsp;{{$car->reco_code}}
                </li>
            @endforeach
          
              <li data-icon="carat-r" class="add_itm">
                <a href="/mobile/addcar" id="add_car" class="add_itm">添加车辆信息</a>
              </li>

          </ul>
        </p>
      </div>
      <div data-iconpos="right"  data-role="collapsible"  data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
        <h1 class="itm-title">收件地址
            <!--
            <span id="selected_receiver">
              @if (!empty($defaultReceiver))
                {{$defaultReceiver->receiver}}&nbsp;&nbsp;{{$defaultReceiver->mobile}}&nbsp;&nbsp;{{$defaultReceiver->address}}
              @endif
            </span>
            -->
        </h1>
        <p class="no-margin">
          <ul data-role="listview">
          
            @foreach($receivers as $receiver)
              @if ($receiver->last_used == 1)
                <li class="selected-itm info_itm" data-target="" data-type="receiver" data-id="{{$receiver->id}}">
              @else
                <li class="select-itm info_itm" data-target="" data-type="receiver" data-id="{{$receiver->id}}">
              @endif
                {{$receiver->receiver}}&nbsp;&nbsp;{{$receiver->mobile}}&nbsp;&nbsp;{{$receiver->province}}&nbsp;{{$receiver->city}}&nbsp;{{$receiver->address}}
                </li>
            @endforeach

            <li  data-icon="carat-r" class="add_itm">
              <a id="add_receiver" class="add_itm" href="#">添加新的收件人</a>
            </li>
          </ul>
        </p> 
      </div>
      <div data-iconpos="right" data-inset="true" data-role="collapsible" class="no-margin" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
        <h1 class="itm-title"><img src="/imgs/mini_youhuiquan.png" height="18px">
          &nbsp;优惠减免
          <span id="selected_boun"></span>
        </h1>
        <p style="">
          @if (!count($bouns))
            <div style="color:#">
              您当前还没有优惠券！
            </div>
          @else
            <div class="ui-grid-c">
              @foreach($bouns as $boun)
                <div class="ui-block-b">
                  <a class="blue_white_btn margin-1 ui-btn ui-mini boun_btn" href="#" id="boun_{{$boun->id}}" data-id="{{$boun->id}}">{{$boun->code}}</a>
                </div>
              @endforeach
            </div>
          @endif 

        </p>
      </div>
      
      <div  class="no-radius"  data-iconpos="right" data-inset="true" data-role="collapsible" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
        <h1 class="itm-title">添加备注<span id="selected_boun"></span></h1>
        <p style="">
          <textarea class="no-margin" name="addinfo" id="user_comment"></textarea>
        </p>
      </div>
    </div>
    <div class="ui-content" style="margin-top:30px;">
      <form data-role="none" id="order_form" action="{{asset('order/pay')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        @if (!empty($defaultCar)) 
          <input type="hidden" name="car" value="{{$defaultCar->id}}">
        @else 
          <input type="hidden" name="car" value="">
        @endif
        @if (!empty($defaultReceiver))
          <input type="hidden" name="receiver" value="{{$defaultReceiver->id}}">
        @else
          <input type="hidden" name="receiver" value="">
        @endif
        <input type="hidden" name="good" value="{{$good->id}}">
        <input type="hidden" name="good" value="1">
        <input type="hidden" name="car_hand" value="{{$car_hand}}">
        <input type="hidden" name="good_code" value="{{$good->code}}">
        <input type="hidden" name="form_cod" value="{{$formCode}}">
        <input type="hidden" name="comment">
        <input type="hidden" class="youhui" name="youhui_1">
        <input type="hidden" class="youhui" name="youhui_2">
        <input type="hidden" class="youhui" name="youhui_3">
        <input type="hidden" name="mb" value="true">

        @if (empty($defaultCar) || empty($defaultReceiver))

        <button type="submit"  class="ui-btn grap_white_btn" id="commit">资料未完成</button>
        @else 
        <button type="submit"  class="ui-btn red_white_btn" id="commit">资料未完成</button>

        @endif
      </form>
    </div>
  </div>
  <div data-role="popup" data-theme="b" data-position-to="window" id="alert_pop" class="ui-content">
    <a href="#" data-rel="back" class="ui-btn ui-btn-a ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
    <h4>提示</h4>
    <p id="alert_content"></p>
  </div>
  <a href="#alert_pop" data-rel="popup" id="trigger_pop"></a>
</div>
<script type="text/javascript">

  function checkInfoComplete () {
  
    var btnSubmit = $('#commit');

    var sCar = $('input[name=car]').val();

    var sReceiver = $('input[name=receiver]').val();

    if (sCar != undefined && sCar.length > 0 && sReceiver != undefined && sReceiver.length >0) {
    
      btnSubmit.addClass('red_white_btn').removeClass('gray_white_btn');

      btnSubmit.html('提交');
     
    } else {
    
      btnSubmit.addClass('gray_white_btn').removeClass('red_white_btn');
    
      btnSubmit.html('资料未完成');
    }
  
  }

  checkInfoComplete();

  $(document).on('pageinit', function (e) {

    var btnSubmit = $('#commit');

    var bouns = [];

    btnSubmit.on('tap', function (e) {
    
      e.preventDefault();

      var car = $('input[name=car]').val();

      if (car == undefined || car.length == 0) {

        $('#trigger_pop').click();

        $('#alert_content').html('请选择车辆!');

        return;
      
      } 

      var receiver = $('input[name=receiver]').val();

      if (receiver == undefined || receiver.length == 0) {
      
        $('#trigger_pop').click();

        $('#alert_content').html('请选择收件人!');

        return;
      
      }

      $('input[name=comment]').val($('#user_comment').val());

      $('#order_form')[0].submit();
    
    });

    var infoItms = $('.info_itm');
    
    infoItms.on('tap', function (e) {
    
      var that = $(this);

      var type = that.data('type');

      var id = that.data('id');
    
      infoItms.removeClass('selected-itm').addClass('select-itm');

      that.removeClass('select-itm').addClass('selected-itm');

      $('input[name=' + type + ']').val(id);

      checkInfoComplete();
    
    });

    var bounItms = $('.boun_btn');

    bounItms.on('tap', function (e) {
    
      var that = $(this);

      var youhui = $('input.youhui');

      if (that.data('selected') == true) {
      
        that.data('selected', false); 

        that.addClass('blue_white_btn').removeClass('red_white_btn');
      
        for (var i = 0; i < youhui.length; i++) {
        
          var y = youhui[i];

          if (y.value == that.data('id')) {

            y.value = "";

            break;
          
          }
        
        }

      } else {

        for (var i = 0; i < youhui.length; i++) {
        
          var y = youhui[i];

          console.log(y.value);

          if (y.value == undefined || y.value == '') {

            y.value = that.data('id');

            break;
          
          }

          if (i == 2) {

            $('#alert_content').html('最多使用3张优惠券！');

            $('#trigger_pop').click();

            return;
          
          }
        
        }

        bouns.push(that.data('id'));

        that.data('selected', true);

        that.addClass('red_white_btn').removeClass('blue_white_btn');
      
      }
    
    });

  });


</script>

@endsection
