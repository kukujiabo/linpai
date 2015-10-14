<div id="order_detail">
  <a href="#" id="od_remove" style="position:fixed;top:3%;left:92%;z-index:10005"><span class="glyphicon glyphicon-remove"></span></a>
  <div class="over-all"></div>
  <div class="padding-20" id="order_info">
    <h4>订单信息</h4>
    <hr>
    <div class="row">
      <div class="col-xs-3">
        订单号：<span id="order_code">{{$order->order_code}}</span> 
      </div>
      <div class="col-xs-3">
        商品名：<span id="good_name">{{$order->good_name}}</span> 
      </div>
      <div class="col-xs-2">
        数量：<span id="num">{{$order->num}}</span> 
      </div>
      <div class="col-xs-2">
        价格：<span id="sum">{{$order->sum}}</span>
      </div>
      <div class="col-xs-2">
        <a href="#" id="view_boun" class="theme-font-blue" data-user="{{$order->uid}}" data-order="{{$order->order_code}}">查看优惠券</a>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3">
        下单时间：<span id="order_time">{{$order->created_at}}</span>
      </div>
      <div class="col-xs-3">
        支付方式：<span id="pay_typ"></span>
      </div>
    </div>
    <hr>
    <h4>下单用户信息</h4>
    <hr>
    <div class="row">
      <div class="col-xs-3">
        用户名：<span id="user">{{$user->name}}</span> 
      </div>
      <div class="col-xs-3">
        手机号：<span id="u-mobile">{{$user->mobile}}</span> 
      </div>
      <div class="col-xs-3">
        邮箱：<span id="email">{{$user->email}}</span> 
      </div>
    </div>
    <hr>
    <h4>收件人信息</h4>
    <hr>
    <div class="row">
      <div class="col-xs-3">
        收件人：<span id="receiver">{{$order->receiver}}</span> 
      </div>
      <div class="col-xs-3">
        手机号：<span id="mobile">{{$order->mobile}}</span> 
      </div>
      <div class="col-xs-6">
        地址：<span id="address">{{$order->province}}{{$order->city}}{{$order->district}}{{$order->address}}</span> 
      </div>
    </div>
    <hr>
    <h4>车辆信息</h4>
    <hr>
    <div class="row">
      <div class="col-xs-3">
        所有人：<span id="car_owner">{{$order->car_owner}}</span>
      </div>
      <div class="col-xs-3">
        车架号：<span id="reco_code">{{$order->reco_code}}</span>
      </div>
      <div class="col-xs-3">
        厂牌型号：<span id="car_factory_code">{{$order->car_factory_code}}</span>
      </div>
      <div class="col-xs-3">
      </div>
    </div>
    <div class="row">

    @if (!empty($order->dir_identity_face))
      <div class="col-xs-2" id="dir_identity_face">
        <b class="theme-orig">身份证正面</b>
        <a class="btn btn-default btn-sm" href="/download?file={{$order->dir_identity_face}}">下载</a>
      </div>
    @endif
    @if (!empty($order->dir_identity_back))
      <div class="col-xs-2" id="dir_identity_back">
        <b class="theme-orig">身份证背面</b>
        <a class="btn btn-default btn-sm" href="/download?file={{$order->dir_identity_back}}">下载</a>
      </div>
    @endif
    @if (!empty($order->dir_trans_ensurance))
      <div class="col-xs-2" id="dir_trans_ensurance">
        <b class="theme-orig">交强险附件</b>
        <a class="btn btn-default btn-sm" href="/download?file={{$order->dir_trans_ensurance}}">下载</a>
      </div>
    @endif
    @if (!empty($order->dir_car_check))
      <div class="col-xs-2" id="dir_car_check">
        <b class="theme-orig">发票扫描件</b>
        <a class="btn btn-default btn-sm" href="/download?file={{$order->dir_car_check}}">下载</a>
      </div>
    @endif
    @if (!empty($order->dir_validate_paper))
      <div class="col-xs-2" id="dir_validate_paper">
        <b class="theme-orig">合格证附件</b>
        <a class="btn btn-default btn-sm file-download" href="/download?file={{$order->dir_validate_paper}}">下载</a>
      </div>
    @endif
    @if (!empty($order->dir_driving_license))
      <div class="col-xs-2" id="dir_driving_license">
        <b class="theme-orig">行驶证附件</b>
        <a class="btn btn-default btn-sm file-download" href="/download?file={{$order->driving_license}}">下载</a>
      </div>
    @endif
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-2 padding-5">
        订单状态： 
        <span id="status">
        @if ($order->status == 0)
          未付款
        @elseif ($order->status == 1)
          已付款
        @elseif ($order->status == 2)
          已发货
        @elseif ($order->status == 3)
          已收货
        @endif
        </span>
      </div>

      @if ($order->status == 1)
        <div class="col-xs-10 padding-5 hide" id="deliver_info">
          <div class="col-xs-3">
            车牌号：<span content="plate_number"></span>
          </div>
          <div class="col-xs-3">
            快递公司：<span content="company"></span>
          </div>
          <div class="col-xs-3">
            运单号：<span content="deliver_code"></span>
          </div>
          <!--
          <div coass="col-xs-1">
            <a href="#" id="deliver_modify">修改</a>
          </div>
          -->
        </div>
        <div class="col-xs-10" id="deliver_edit"> 

      @elseif ($order->status == 2)
        <div class="col-xs-10 padding-5" id="deliver_info">
          <div class="col-xs-3">
            车牌号：<span content="plate_number">{{$order->plate_number}}</span>
          </div>
          <div class="col-xs-3">
            快递公司：<span content="company">{{$deliver->company}}</span>
          </div>
          <div class="col-xs-3">
            运单号：<span content="deliver_code">{{$deliver->code}}</span>
          </div>
          <div coass="col-xs-1">
            <a href="#" id="deliver_modify">修改</a>
          </div>
        </div>
        <div class="col-xs-10 hide" id="deliver_edit">

      @endif
       @if ($order->status > 0)
          <form class="form-inline padding-4" id="deliver_form" method="post" action="/orderboard/deliver">
            <input type="hidden" name="order_code" value="{{$order->order_code}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label class="control-label">车牌号：</label>
          
              @if (!empty($order->plate_number))
  
              <input class="form-control input-sm" type="text" name="plate_number" value="{{$order->plate_number}}">

              @else

              <input class="form-control input-sm" type="text" name="plate_number">

              @endif
              
            </div>
            <div class="form-group">           
              <label class="control-label">快递公司：</label>

              @if (!empty($deliver))

                <input class="form-control input-sm" type="text" name="company" value="{{$deliver->company}}"> 

              @else 

                <input class="form-control input-sm" type="text" name="company"> 

              @endif

            </div>
            &nbsp;&nbsp;
            <div class="form-group">           
              <label class="control-label">运单号：</label>

              @if (!empty($deliver))

                <input class="form-control input-sm" type="text" name="deliver_code" value="{{$deliver->code}}"> 

              @else

                <input class="form-control input-sm" type="text" name="deliver_code"> 

              @endif

            </div>
            &nbsp;&nbsp;
            @if ($order->status == 1)
            <div class="form-group">
              <a role="button" id="deliver_submit">发货</a>
            </div>

            @if (!empty($deliver))
            |
            <div class="form-group">
              <a role="button" id="deliver_dismiss">取消</a>
            </div>

            @endif
            @endif
          </form>
        @endif
        </div>
    </div>
  </div>
</div>
<script id="od_script" type="text/javascript">
  if ($) {

    $('#od_remove').click(function (e) {

      e.preventDefault();

      $('#order_detail').remove();

      $('#od_script').remove();

    });

    var deliverForm = $('#deliver_form');

    deliverForm.ajaxForm();

    var deliverOptions = {
    
      'dataType': 'json',

      'resetForm': false,
    
      'success': function (data) {

        if (data.code) {

          $('#status').html('已发货');

          $('#deliver_info').removeClass('hide');

          $('#deliver_edit').addClass('hide');

          var obj = data.res

          $('#deliver_info').find('span[content=company]').html(obj.deliver.company);

          $('#deliver_info').find('span[content=deliver_code]').html(obj.deliver.code);

          $('#deliver_info').find('span[content=plate_number]').html(obj.order.plate_number);

        } else {
      
          if (typeof(data.msg) == 'object') {

            var obj = data.msg;

            for (var k in obj) {

              deliverForm.find('input[name=' + k + ']').addClass('alert-red').attr('placeholder', '不能为空');

            }

          } else if (typeof(data.msg) == 'string') {


          }

        }

      },

      'error': function (err) {

        console.log(err);

      }
    
    };

  }

  deliverForm.find('#deliver_submit').click(function (e) {
  
    e.preventDefault();

    deliverForm.ajaxSubmit(deliverOptions);
  
  });

  $('#deliver_modify').click(function (e) {

    e.preventDefault();

    $('#deliver_edit').removeClass('hide');

    $('#deliver_info').addClass('hide');

    $('#deliver_submit').html('修改');

  });

  $('#deliver_dismiss').click(function (e) {

    e.preventDefault();

    $('#deliver_edit').addClass('hide');

    $('#deliver_info').removeClass('hide');

  });

  $('#view_boun').hover(function (e) {

    e.preventDefault();

    var that = $(this);

    $.get('/orderboard/bouns', {

      'uid': $(this).data('user'),
    
      'order_code': $(this).data('order')
    
    }, function (data) {
    
      var bounTips = $(data.res);

      that.after(bounTips);

      var elementTop = (that.offset().top - window.scrollY) + that.height();

      var elementLeft = that.offset().left;

      bounTips.css({'position':'fixed','left':elementLeft,'top':elementTop});

    }, 'json'); 

  }, function (e) {

    e.preventDefault();

    console.log(1);

    $('.boun_line').remove();

  });

  $('#view_boun').click(function (e) {
    
    e.preventDefault();
  
  });

</script>
