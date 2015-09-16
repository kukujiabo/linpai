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
      <div class="col-xs-3">
        数量：<span id="num">{{$order->num}}</span> 
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
      <div class="col-xs-2" id="dir_identity_face">
        <img class="width-100">
        <a href="#" use="imgs">
          <b>身份证正面</b>
        </a>
        <a class="btn btn-default btn-sm" href="/download?file={{$order->dir_identity_face}}">下载</a>
      </div>
      <div class="col-xs-2" id="dir_identity_back">
        <img class="width-100">
        <a href="#" use="imgs">
          <b>身份证背面</b>
        </a>
        <a class="btn btn-default btn-sm" href="/download?file={{$order->dir_identity_back}}">下载</a>
      </div>
      <div class="col-xs-2" id="dir_trans_ensurance">
        <img class="width-100">
        <a href="#" use="imgs">
          <b>交强险附件</b>
        </a>
        <a class="btn btn-default btn-sm" href="/download?file={{$order->dir_trans_ensurance}}">下载</a>
      </div>
      <div class="col-xs-2" id="dir_car_check">
        <a href="#" use="imgs">
        <img class="width-100">
        <a href="#" use="imgs">
          <b>发票扫描件</b>
        </a>
        <a class="btn btn-default btn-sm" href="/download?file={{$order->dir_car_check}}">下载</a>
      </div>
      <div class="col-xs-2" id="dir_validate_paper">
        <img class="width-100">
        <a href="#" use="imgs">
          <b>合格证附件</b>
        </a>
        <a class="btn btn-default btn-sm file-download" href="/download?file={{$order->dir_validate_paper}}">下载</a>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-3">
        订单状态： 
        <span id="status">
        @if ($order->status == 0)
          未付款
        @elseif ($order->status == 1)
          已付款&nbsp;&nbsp;<a id="delivered" href="#">发货</a>
        @elseif ($order->status == 2)

        @elseif ($order->status == 3)

        @endif
        </span>
      </div>
      @if ($order->status == 1)

        <div class="col-xs-9">
          <form class="form-inline" method="post" action="#">
            <div class="form-group">           
              <label class="control-label">快递公司：</label>
              <input class="form-control input-sm" type="text"> 
            </div>
            &nbsp;&nbsp;
            <div class="form-group">           
              <label class="control-label">运单号：</label>
              <input class="form-control input-sm" type="text"> 
            </div>
            &nbsp;&nbsp;
            <div class="form-group">
              <button class="btn btn-default btn-sm">确定</button>
            </div>
          </form>
        </div>

      @endif
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

  }
</script>
