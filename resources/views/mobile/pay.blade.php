@extends('mobile/mobile')

@include('mobile/step')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>订单支付 － 51临牌</h1>
  </div>
  @yield('step') 
  <div data-role="content" style="padding-left:0px;padding-right:0px;padding-bottom:0px;">
    <!-- 商品信息 -->
    <div class="ui-content" style="background:white">
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
    
    <!-- 车辆信息 -->
    
    @if (!empty($defaultCar))
    <div style="background:#fff;margin-top:10px;">
      <div class="inner_white no-radius" data-role="collapsibleset">
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
      <div style="padding:15px">
        <p>所有人：{{$defaultCar->owner}}</p>
        <p>厂牌型号：{{$defaultCar->factory_code}}</p>
        <p>识别代码：{{$defaultCar->reco_code}}</p>
      </div>
    </div>
  </div>
    @endif
    <!-- 收件人信息 -->

    @if (!empty($defaultReceiver))
    <div style="background:#fff;margin-top:5px;">
      <div class="no-radius inner_white" data-iconpos="right"  data-role="collapsible"  data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
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
      <div style="padding:15px">
        <p>收货人：{{$defaultReceiver->receiver}}</p>
        <p>收货地址：{{$defaultReceiver->province}}{{$defaultReceiver->city}}{{$defaultReceiver->district}}</p>
        <p>联系号码：{{$defaultReceiver->mobile}}</p>
        <p>邮箱地址：{{$defaultReceiver->email}}</p>
      </div>
    </div>
    @endif

    <!-- 优惠券 -->
    <div data-iconpos="right" class="no-radius inner_white" data-role="collapsible" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
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

    <!-- 备注 -->
    <div class="no-radius inner_white"  data-iconpos="right" data-role="collapsible" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
      <h1 class="itm-title">添加备注<span id="selected_boun"></span></h1>
      <p style="">
        <textarea class="no-margin" name="addinfo" id="user_comment"></textarea>
      </p>
    </div>

    <div style="margin:10px 0px 0px 0px;padding:0px;width:100%;height:50px;">
      <div style="float:left;margin:0px;padding:17px 0px;background:#666;color:#fff;text-align:center;width:50%;font-size:15px;font-weight:normal;text-shadow:none">
        实付：¥ {{$goodInfo->value}}
      </div>
      <div style="float:right;margin:0px;padding:15px 0px;background:#d9534f;color:#fff;text-align:center;width:50%;font-size:18px;font-weight:normal;text-shadow:none">
       <input type="submit" data-role="none" style="border:0px;background:none;font-size:18px;padding:0px;margin:0px;color:white" value="立即支付">
      </div>
      <div class="clear"></div>
    </div>
  </div>
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
