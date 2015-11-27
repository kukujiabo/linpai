@extends('mobile/mobile')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>支付－51临牌</h1>
  </div>
  <div data-role="content">
    <div style="background:#fff;width:100%;height:320px;text-align:center;padding:20px 0">
      <img src="/imgs/weixinpay.png" >
      <div style="color:#138ed1;font-size:18px;" id="pay_title">
        跳转支付...
      </div>
      <div style="color:#ff8800;font-size:16px;padding:10px;" id="pay_price">
        {{$price}}
      </div>
      <hr>
      <div style="width:100%;text-align:left">
        <p style="color:#ccc">订单号：<span style="color:#138ed1">{{$order_code}}</span></p>
        <p style="color:#ccc">收货地址：<span style="color:#138ed1">{{$order_code}}</span></p>
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

        switch (res.err_msg) {
        
          case 'fail':

            break;
          case 'ok':

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
