@extends('mobile/mobile')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>支付－51临牌</h1>
  </div>
  <!--
  <div data-role="content">
    <div class="ui-btn">
      <button onclick="callpay();">立即支付</button>
    </div>
  </div>
  -->
</div>
<script type="text/javascript">

  var jsParameters = {!!$jsApiParameters!!};

  function onBridgeReady(){
      
    WeixinJSBridge.invoke(

      'getBrandWCPayRequest', {
        "appId" ： "wx2421b1c4370ec43b",     //公众号名称，由商户传入     
        "timeStamp"：" 1395712654",         //时间戳，自1970年以来的秒数     
        "nonceStr" ： "e61463f8efa94090b1f366cccfbbb444", //随机串     
        "package" ： "prepay_id=u802345jgfjsdfgsdg888",     
        "signType" ： "MD5",         //微信签名方式：     
        "paySign" ： "70EA570631E4BB79628FBCA90534C63FF7FADD89" //微信签名 
      },

      function(res){     

        alert(res);

        if(res.err_msg == "get_brand_wcpay_request：ok" ) {
        
        
      }     // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。 

    }); 

  }

  if (typeof WeixinJSBridge == "undefined"){

    if( document.addEventListener ){

      document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);

    } else if (document.attachEvent) {
      
      document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 

      document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);

    }

  } else {

    onBridgeReady();

  }

  //调用微信jsapi支付
  /*
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
    /*
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
  */

  //var addressParameters = {!!$editAddress!!};
  /*
   * 获取共享地址
   */
  /*
  function editAddress() {

    WeixinJSBridge.invoke(
      'editAddress',
      addressParameters,
      function(res) {
        var value1 = res.proviceFirstStageName;
        var value2 = res.addressCitySecondStageName;
        var value3 = res.addressCountiesThirdStageName;
        var value4 = res.addressDetailInfo;
        var tel = res.telNumber;
        alert(value1 + value2 + value3 + value4 + ":" + tel);
      }
    );
  }
  */

  //window.onload = function() {

    /*
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
     */

   // callpay();

  //};

</script>

@endsection
