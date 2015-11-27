@extends('mobile/mobile')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>支付－51临牌</h1>
  </div>
  <div data-role="content">
    <div class="ui-btn">
      <button onclick="callpay();">立即支付</button>
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

        alert(res.err_code+res.err_desc+res.err_msg);

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

  var addressParameters = {!!$editAddress!!};
  /*
   * 获取共享地址
   */
  function editAddress() {

    WeixinJSBridge.invoke(
      'editAddress',
      addressParameters,
      function(res){
        var value1 = res.proviceFirstStageName;
        var value2 = res.addressCitySecondStageName;
        var value3 = res.addressCountiesThirdStageName;
        var value4 = res.addressDetailInfo;
        var tel = res.telNumber;
        alert(value1 + value2 + value3 + value4 + ":" + tel);
      }
    );
  }

  window.onload = function(){

    if (typeof WeixinJSBridge == "undefined"){

      if( document.addEventListener ){

        document.addEventListener('WeixinJSBridgeReady', editAddress, false);

      }else if (document.attachEvent){

        document.attachEvent('WeixinJSBridgeReady', editAddress); 

        document.attachEvent('onWeixinJSBridgeReady', editAddress);

      }
    } else {

      editAddress();

    }
  };

</script>



@endsection
