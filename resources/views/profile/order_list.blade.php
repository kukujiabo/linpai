@foreach ($orders as $order)
<div class="order-title">
  <div class="col-xs-4">
    <b>订单号：{{$order->order_code}} </b>
  </div>
  <div class="col-xs-4">
    <b>{{$order->created_at}}</b>
  </div>
  <div style="clear:both"></div>
</div>
<div class="order-body">
  <div class="col-xs-3 no-padding">
    <div class="col-xs-5 padding-5">
      <img src="{{$order->good_tiny_pic}}" width="100%">
    </div>
    <div class="col-xs-7 padding-5">
      {{$order->good_name}}
    </div> 
  </div>
  <div class="col-xs-2 order-col">
    {{$order->sum/$order->num}}
  </div>
  <div class="col-xs-1 order-col">
    {{$order->num}}
  </div>
  <div class="col-xs-1 order-col">
    {{$order->cut_fee}}
  </div>
  <div class="col-xs-2 order-col">
    {{$order->final_price}}
  </div>
  <div class="col-xs-1 order-col">
    @if ($order->status == 0)
    <a href="{{asset('order/pay')}}?order={{$order->order_code}}" class="require go-to-pay" data-id="{{$order->oid}}">
       未付款
    </a>

    @elseif ($order->status == 1)
    已付款
    @elseif ($order->status == 2)
      已完成
      <div>
        <a href="#" class="theme-font-blue deliver-info" data-id="{{$order->order_code}}">
          <span class="glyphicon glyphicon-info"></span>
          查看物流
        </a>
      </div>

    @elseif ($order->status == 3)
      已取消

    @endif
  </div>
  <div class="col-xs-2 order-col">
    上海
  </div>
  <div style="clear:both"></div>
</div> 
@endforeach
