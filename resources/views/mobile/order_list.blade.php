@extends('mobile/mobile')

@include('mobile/head')

@section('content')

<div data-role="page">
  <div data-role="header">
    @yield('header')
  </div>
  <div data-role="content">

    @if (count($orders) == 0)

      <div style="padding:30px;font-size:20px;border-radius:5px;background:#fff;text-shadow:none;font-weight:none;">
        <p>
          您还没有下过订单哦~
        <p>
        <a href="/miniorder/cartype" class="orange_btn">立即购买临牌</a> 
      </div>

    @else
  
      <ul data-role="listview">

      @foreach ($orders as $order)

        <li class="order-list-itm" style="padding:10px;margin:5px;border:1px solid #ddd;border-radius:5px;">
          <div class="oli-header">
              <span class="float-left" style="margin-top:5px;font-size:12px">订单号：{{$order->order_code}}</span>
              <span class="float-right" style="margin-top:5px;font-size:12px">{{$order->created_at}}</span>
            <div class="clear"></div>
          </div>
          <div class="oli-content">
            <img  class="m_g_pic inline float-left" src="{{asset($order->good_tiny_pic)}}"> 
            <div class="inline float-left" style="padding-left:10px">
              <h2 class="margin-5">{{$order->good_name}}</h2>
              <h5 class="margin-5">x {{$order->num}}</h5>
            </div>
            <div class="inline float-right text-right" style="padding-right:10px;">
              <h3 class="margin-5"> ¥ {{$order->orig_price}}</h3>
            </div>
            <div class="clear"></div>
          </div>
          <div class="oli-footer">
            <div class="inline float-right" style="padding-right:10px">
              <span class="margin-5 inline float-right" style="font-size:12px;">实付：<strong style="font-size:16px;">¥ {{$order->final_price}}</strong></span>
              <span class="margin-5 inline float-right" style="font-size:12px;">优惠券：<span style="color:#d9534f;font-size:16px;font-weight:normal">减免 ¥ {{$order->cut_fee}} </span> | </span> 
            </div>
            <div class="clear"></div>
          </div>
          <div class="oli-operator text-right">
              <a class="ui-btn ui-btn-inline ui-shadow ui-mini blue_white_btn" href="/mobile/orderinfo?order={{$order->order_code}}">订单详情</a>
            @if ($order->status == 0)
              <a href="/order/pay?mb=true&order={{$order->order_code}}" class="ui-btn ui-btn-inline ui-shadow ui-mini blue_full_btn" role="button">马上支付</a>
            @elseif ($order->status == 1)
              <a class="ui-btn ui-btn-inline ui-shadow ui-mini gray_white_btn" role="button">等待发货</a>
            @elseif ($order->status == 2)
              @if (!empty($order->order_deliver_company))

                <a class="ui-btn ui-btn-inline ui-shadow ui-mini blue_white_btn logistic_info" href="#" role="button" data-company="{{$order->order_deliver_company}}" data-deliver_code={{$order->deliver_code}}>查看物流</a>

              @endif
            @endif
            
            @if ($order->status > 0) 
              <a href="/order/rebuy?order_code={{$order->order_code}}&mb=true" class="orange_btn ui-btn ui-btn-inline ui-mini"  role="button" >再次购买</a> 
            @endif 
          </div>
        </li>

      @endforeach

      </ul>

    @endif
      
  </div>
  <div data-role="popup" data-position-to="window" class="ui-content" id="order_info_popup" style="border:1px #ff8800 solid;padding:30px 50px;text-shadow:none;box-shadow:none" data-overlay-theme="a">
    <p id="popup_content"></p>
  </div>
  <a href="#order_info_popup" id="trigger_order" data-rel="popup"  data-transition="slide"></a>
</div>
<script type="text/javascript">
  $(document).on('pageinit', function () {
  
    $('a.logistic_info').on('tap', function (e) {

      e.preventDefault();

      var that = $(this);

      var company = that.data('company');

      var code = that.data('deliver_code');

      var str = '<p>快递公司：' + company + '</p>';

      str += '<p>快递单号：' + code + '</p>';

      str += '<p>查询网站：' + "<a href=\"http://www.sf-express.com\" style=\"color:#d9534f\">顺丰速递</a> " + '</p>';
      $('#popup_content').html(str);

      $('#trigger_order').click();

    }); 

  });
  
</script>

@endsection
