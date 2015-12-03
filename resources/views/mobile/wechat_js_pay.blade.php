@extends('mobile/mobile')

@include('mobile/step')

@include('mobile/head')

@section('content')

<div data-role="page">
  <div data-role="header">
    @yield('header')
  </div>
    @yield('step')
  <div data-role="content">
    <div style="background:#fff;width:100%;height:320px;text-align:center;padding:20px 0;border-radius:5px;">
      <img src="/imgs/weixinpay.png" style="margin-top:20px;" >
      <div style="color:#138ed1;font-size:18px;font-weight:bold;margin-top:8px;" id="pay_title">
        跳转支付...
      </div>
      <div style="color:#ff8800;font-size:22px;padding:10px;font-weight:bold" id="pay_price">
        {{$price}} 元
      </div>
      <hr style="background:#ddd">
      <div style="width:100%;text-align:left;padding:10px">
        <p style="color:#ccc">订单号：<span style="color:#138ed1">{{$order_code}}</span></p>
        <p style="color:#ccc">收货地址：<span style="color:#333">{{$address}}</span></p>
      </div>
    </div>
  </div>
<script type="text/javascript">

  var jsParameters = {!!$jsApiParameters!!};

  //调用微信jsapi支付
  function jsApiCall()
  {
    WeixinJSBridge.invoke(

      'getBrandWCPayRequest',

      jsParameters,

      function(res){

        WeixinJSBridge.log(res.err_msg);

        switch (res.err_msg.trim()) {
        
          case 'get_brand_wcpay_request:fail':

            $('#pay_title').html('支付失败，请重新尝试或联系管理员.');

            $('#pay_title').css({ color: '#d9534f'});

            break;

          case 'get_brand_wcpay_request:ok':

            $('#pay_title').html('支付成功！');

            break; 
        
        }

      }

    );

  }

  function callpay()
  {
    /*
     * 微信js桥
     */
    if (typeof WeixinJSBridge == "undefined"){
        if( document.addEventListener ){
            document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
        }else if (document.attachEvent){
            document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
            document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
        }
    }else{
        jsApiCall();
    }
  }

  window.onload = function() {

    callpay();

  };

</script>
</div>

@endsection
