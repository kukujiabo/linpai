@extends('app')

@extends('processbar')

@section('content')

<div class="alert alert-warning" role="alert">
  <div class="wrapper">
    <h5>订单号：{{$order->code}}</h5>
    <h5>购买商品：{{$good->name}}</h5>
    <p>
      感谢您的购买，请在48小时内支付以便于我们开办临牌，48小时后您的订单将自动取消。
    </p>
  </div>
</div>
<div id="order-info" class="box">
  <input type="hidden" id="o_code" value="{{$order->code}}">
  <div class="block-head">
    <h4>订单信息</h4>
  </div>
  <div class="wrapper padding-20">
    <div class="media">
      <div class="media-left">
        <a href="#" class="gray-light" style="display:block">
          <img class="media-object" src="{{asset($good->tiny_good)}}" alt="" width=80px>
        </a>
      </div>
      <div class="media-body">
        <p class="v-middle"> 
          <span class="line-info"><b>寄送地址：</b></span>
          <span class="line-info">{{$receiver->province}}</span>
          <span class="line-info" role="city">{{$receiver->city}}</span>
          <span class="line-info" role="district">{{$receiver->district}}</span>
          <span class="line-info" role="route">{{$receiver->address}}</span>
          <span class="line-info" role="customer">{{$receiver->receiver}}</span>
          <span class="line-info" role="mobile">{{$receiver->mobile}}</span>
        </p>
        <p class="v-middle">
          @if (!empty($order->comment))
            <span class="line-info"><b>备注：</b></span>
            <span style="color:#8a6d3b">{{$order->comment}}</span>
          @endif
        </p>
      </div>
      <div class="media-right">
        <p class="">
          <span class="line-info">实付金额</span>
          <span class="total-price theme-orig">{{$orderPrice->final_price}}元</span>
        </p>
      </div>
    </div>
  </div>
</div>
<div class="padding-5">
</div>
<div id="deliver" class="box">
  @if (!empty($pay_omit))

    <div class="alert alert-danger">
      请选择支付方式！
  @else
    <div class="alert alert-danger hide">

  @endif

  </div>
  <div class="block-head">
    <h4>支付方式</h4>
  </div>
  <div class="padding-20">
    <form class="form" role="form" id="pay_form" action="{{asset('order/paying')}}" method="post" target="_blank">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <input type="hidden" name="pay_token" value="{{$pay_token}}" />
      <input type="hidden" name="order_code" value="{{$order->code}}"/>
      <div class="radio padding-5">
        <label class="control-label" for="zhifubao">
          @if (!empty($bank_omit)) 
            <input type="radio" id="zhifubao" name="pay" value="zhifubao">
          @else
            <input type="radio" id="zhifubao" name="pay" value="zhifubao" checked>
          @endif
          <img src="/imgs/alipay.jpg" height="25px;" style="padding:3px;">
        </label>
      </div>
      <div class="radio padding-5">
        <label class="control-label" for="credit">
          @if (!empty($bank_omit))
            <input type="radio" id="credit" name="pay" value="union" checked>
          @else
            <input type="radio" id="credit" name="pay" value="union">
          @endif
          <img src="/imgs/union_pay.jpg" height="25px;" style="padding:3px;">
        </label>
          @if (!empty($bank_omit)) 

            <div class="box padding-5" id="bank-list">
              <div class="alert alert-danger" id="bank-alert">
              请选择支付银行!
          @else

            <div class="box hide" id="bank-list">
              <div class="alert alert-danger hide" id="bank-alert">

          @endif
  
          </div>
          <ul class="row">
            @foreach ($banks as $bank) 
              <li class="col-sm-3"> 
                <div class="padding-5">
                  <label class="control-label" for="bank_{{$bank->code}}">
                      <input type="radio" name="bank" id="bank_{{$bank->code}}" value="{{$bank->code}}">{{$bank->name}}
                  </label>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="radio padding-5">
        <label class="control-label" for="wechat">
          <input type="radio" id="wechat" name="pay" value="wechat">
          <img src="/imgs/wechat_pay.jpg" height="25px;" style="padding:3px"> （即将开通）
        </label>
      </div>
      <!--
      <div class="radio padding-5">
        <label class="control-label" for="zhifubao-code">
          <input type="radio" id="zhifubao-code" name="pay" value="qrcode">支付宝二维码
        </label>
      </div>
      -->
      <div class="form-group padding-5">
        <button role="button" class="btn btn-danger" id="to_pay" type="submit">立即支付</button>
      </div>
    </form>
  </div>
</div>
<div class="padding-5">
</div>
<div class="box no-padding">
  <div class="block-head">
    <h4>支付帮助</h4>
  </div>
  <div class="sub-wrapper">
    <p>
      <div class="help padding-5">
        1.点击支付按钮，页面没有跳转
        <p class="padding-5">
          <span class="solve-title">解决方案</span>建议您更换一个浏览器后重新尝试，如不奏效，建议您尝试更换网络环境或到另一台设备上重新操作。
        </p>
      </div>
      <div class="help padding-5">
        2.快捷支付提示“支付失败，当前交易有风险”
        <p class="padding-5">
          <span class="solve-title">解决方案</span>您的交易存在风险，建议您先在支付宝网站上绑定手机再进行操作。
        </p>
      </div>
    </p>
  </div>
</div>
<div class="hide" id="waiting-pay">
<div class="over-all no-padding">
</div>
<div class="text-center panel panel-default" id="confirm-pay">
  <div class="panel-heading" style="background:#333;color:white;">
    <h4>等待支付</h4>
  </div>
  <div class="panel-body">
    <div class="alert alert-danger hide" id="pay_check_alert">
    </div>
    <div class="alert alert-info">
      请在新窗口中完成支付
    </div>
    <button class="btn btn-success" role="button" id="pay-succeed">已支付</button>
    &nbsp;&nbsp;
    <button class="btn btn-default" role="button" id="pay-dismiss">未完成</button>
  </div>
</div>
</div>
<script>
  window.onload = function () {
  
    $(window).bind('beforeunload', function (e) {
    
      e.preventDefault();
    
    });

    $('input[name=pay]').change(function () {
    
      var that = $(this);

      if (that.val() == 'union') {

        $('#bank-list').removeClass('hide');

      } else {

        $('#bank-list').addClass('hide');

      }
    
    });

    $('#pay-succeed').click(function (e) {
      
      window.onbeforeunload = undefined;
    
      var order_code = $('#o_code').val();

      if (order_code == undefined || order_code == '') {


        window.location.href = '/home';

      } else {

        $.get('/order/checkpayed', { 'order': order_code }, function (data) {

          if (!data.code) {

            switch (data.msg) {

              case 'not_pay':

                var s = '我们还未收到您的订单支付成功的消息，如果支付失败，请您重新支付。';

                $('#pay_check_alert').removeClass('hide').html(s);

                setTimeout('$("#waiting-pay").addClass("hide")', 3000); 

                break;

              case 'not_found':

                window.location.href="/home";

                break;

              case 'empty_code':

                window.location.href="/home";

                break;

            }

          } else {

            window.location.href = '/profile/myorder';

          }

        }, 'json');

      }

    });

    $('#pay-dismiss').click(function (e) {
    
      e.preventDefault();

      $('#waiting-pay').addClass('hide');
    
    });
  
  };
</script>
<script type="text/javascript">
  window.onbeforeunload = function (event) {

  return '您的订单尚未支付，确定要离开页面吗？';

};
</script>
@endsection
