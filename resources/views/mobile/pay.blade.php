@extends('mobile/mobile')

@include('mobile/step')

@include('mobile/head')

@section('content')

<div data-role="page">
  <div data-role="header">
    @yield('header')
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
    
    <div style="background:#fff;margin-top:10px;">
      <div class="inner_white no-radius" data-role="collapsibleset">
       <div data-iconpos="right"  data-role="collapsible" class="no-radius no-shadow" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
         <h1 class="itm-title no-shadow">车辆信息
         </h1>
         <p style="no-margin">
           <ul data-role="listview">

             @foreach($cars as $car)
               @if ($car->last_used == 1)
                 <li class="selected-itm info_itm" data-target="" data-type="car" data-id="{{$car->id}}" data-owner="{{$car->owner}}" data-factory_code="{{$car->factory_code}}" data-reco_code="{{$car->reco_code}}">
               @else
                 <li class="select-itm info_itm" data-target="" data-type="car" data-id="{{$car->id}}" data-owner="{{$car->owner}}" data-factory_code="{{$car->factory_code}}" data-reco_code="{{$car->reco_code}}">
               @endif
                   {{$car->owner}}&nbsp;&nbsp;{{$car->brand}}&nbsp;&nbsp;{{$car->reco_code}}
                 </li>
             @endforeach
           
               <li data-icon="carat-r" class="add_itm no-shadow">
                 <a href="/mobile/addcar?car_hand={{$car_hand}}&good_code={{$good->code}}" id="add_car" class="add_itm">添加车辆信息</a>
               </li>

           </ul>
         </p>
       </div>
       <div style="padding:12px">
        @if (!empty($defaultCar))
            <p id="default_owner">所有人：{{$defaultCar->owner}}</p>
            <p id="default_factory_code">厂牌型号：{{$defaultCar->factory_code}}</p>
            <p id="default_reco_code">识别代码：{{$defaultCar->reco_code}}</p>
        @else
            <p id="default_owner"></p>
            <p id="default_factory_code"></p>
            <p id="default_reco_code"></p>
        @endif
       </div>
    </div>
  </div>
    <!-- 收件人信息 -->

    @if (!empty($defaultReceiver))
    <div style="background:#fff;margin-top:5px;">
      <div class="no-radius inner_white" data-iconpos="right"  data-role="collapsible"  data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
        <h1 class="itm-title no-shadow">收件地址 </h1>
        <p class="no-margin">
          <ul data-role="listview">
          
            @foreach($receivers as $receiver)
              @if ($receiver->last_used == 1)
                <li class="selected-itm info_itm" data-target="" data-type="receiver" data-id="{{$receiver->id}}" data-receiver_txt="{{$receiver->receiver}}" data-receiver_address="{{$receiver->province}}{{$receiver->city}}{{$receiver->district}}" data-receiver_mobile="{{$receiver->mobile}}" data-receiver_mail="{{$receiver->email}}">
              @else
                <li class="select-itm info_itm" data-target="" data-type="receiver" data-id="{{$receiver->id}}" data-receiver_txt="{{$receiver->receiver}}" data-receiver_address="{{$receiver->province}}{{$receiver->city}}{{$receiver->district}}" data-receiver_mobile="{{$receiver->mobile}}" data-receiver_mail="{{$receiver->email}}">
              @endif
                {{$receiver->receiver}}&nbsp;&nbsp;{{$receiver->mobile}}&nbsp;&nbsp;{{$receiver->province}}&nbsp;{{$receiver->city}}&nbsp;{{$receiver->address}}
                </li>
            @endforeach

            <li  data-icon="carat-r" class="add_itm no-shadow">
              <a id="add_receiver" class="add_itm" href="/mobile/addreceiver?car_hand={{$car_hand}}">添加新的收件人</a>
            </li>
          </ul>
        </p> 
      </div>
      <div style="padding:15px">
        @if (!empty($defaultReceiver))
          <p id="receiver_txt">收货人：{{$defaultReceiver->receiver}}</p>
          <p id="receiver_address">收货地址：{{$defaultReceiver->province}}{{$defaultReceiver->city}}{{$defaultReceiver->district}}</p>
          <p id="receiver_mobile">联系号码：{{$defaultReceiver->mobile}}</p>
          <p id="receiver_email">邮箱地址：{{$defaultReceiver->email}}</p>
        @else
          <p id="receiver_txt"></p>
          <p id="receiver_address"></p>
          <p id="receiver_mobile"></p>
          <p id="receiver_email"></p>
        @endif
      </div>
    </div>
    @endif

    <!-- 优惠券 -->
    <div data-iconpos="right" class="no-radius inner_white" data-role="collapsible" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
      <h1 class="itm-title no-shadow"><img src="/imgs/mini_youhuiquan.png" height="18px">
        &nbsp;优惠减免
        <span id="selected_boun"></span>
      </h1>
      <p style="">
        <input type="text" name="youhui" placeholder="输入邀请码" id="invite_boun">
        <hr>
        @if (!count($bouns))
          <div style="color:#">
            您当前还没有优惠券！
          </div>
        @else
          <h4>可用优惠券：</h4>
          <div class="ui-grid-c">
            @foreach($bouns as $boun)
              <div class="ui-block-b">
                <a class="blue_white_btn margin-1 ui-btn ui-mini boun_btn" href="#" id="boun_{{$boun->id}}" data-id="{{$boun->code}}">{{$boun->code}}</a>
              </div>
            @endforeach
          </div>
        @endif 

      </p>
    </div>

    <!-- 备注 -->
    <div class="no-radius inner_white"  data-iconpos="right" data-role="collapsible" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
      <h1 class="itm-title no-shadow">添加备注<span id="selected_boun"></span></h1>
      <p style="">
        <textarea class="no-margin" name="addinfo" id="user_comment"></textarea>
      </p>
    </div>

    <div style="margin:10px 0px 0px 0px;padding:0px;width:100%;height:50px;">
      <form data-role="none" action="/order/pay" method="post">
        <fieldset>
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
          <input type="hidden" name="car_hand" value="{{$car_hand}}">
          <input type="hidden" name="good_code" value="{{$good->code}}">
          <input type="hidden" name="form_code" value="{{$formCode}}">
          <input type="hidden" name="comment">
          <input type="hidden" class="youhui" name="youhui_1">
          <input type="hidden" class="youhui" name="youhui_2">
          <input type="hidden" class="youhui" name="youhui_3">
          <input type="hidden" name="num" value="1">
          <input type="hidden" name="mb" value="true">
        </fieldset>
        <div style="float:left;margin:0px;padding:17px 0px;background:#666;color:#fff;text-align:center;width:50%;font-size:15px;font-weight:normal;text-shadow:none">
          实付：¥ {{$goodInfo->value}}
        </div>
        <div style="float:right;margin:0px;padding:15px 0px;background:#d9534f;color:#fff;text-align:center;width:50%;font-size:18px;font-weight:normal;text-shadow:none">
         <input type="submit" data-role="none" style="border:0px;background:none;font-size:18px;padding:0px;margin:0px;color:white" value="立即支付">
        </div>
        <div class="clear"></div>
      </form>
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

      if (type == 'car') {
      
        $('#default_owner').html('所有者：' + that.data('owner'));
        $('#default_factory_code').html('厂牌型号：' + that.data('factory_code'));
        $('#default_reco_code').html('识别代码：' + that.data('reco_code'));
      
      } else if (type == 'receiver') {

        $('#receiver_txt').html('收货人：' + that.data('receiver_txt'));
        $('#receiver_address').html('收货地址：' + that.data('receiver_address'));
        $('#receiver_mobile').html('联系号码：' + that.data('receiver_mobile'));
        $('#receiver_email').html('邮箱地址：' + that.data('receiver_email') == undefined ? '' : that.data('receiver_email'));
      
      }

      checkInfoComplete();
    
    });

    var inviteItm = $('#invite_boun');

    inviteItm.change(function (e) {

      var that = $(this);

      var value = that.val();

      var youhui = $('input.youhui');

      if (value == undefined || value == '') {
       
        youhui.each(function(i, t) {
        
          $(t).val('');
        
        });
        
        return;

      }

      if (value.length != 5) {
      
        alert('邀请码是5位字母＋数字，请正确输入');

        return;
      
      }

      for (var i = 0; i < youhui.length; i++) {
      
        var y = youhui[i];

        if (y.value == undefined || y.value == '') {

          y.value = that.val();

          break;
        
        }

        if (i == 2) {

          $('#alert_content').html('最多使用3张优惠券/邀请码！');

          $('#trigger_pop').click();

          return;
        
        }
      
      }
      
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

          if (y.value == undefined || y.value == '') {

            y.value = that.data('id');

            break;
          
          }

          if (i == 2) {

            $('#alert_content').html('最多使用3张优惠券/邀请码！');

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
