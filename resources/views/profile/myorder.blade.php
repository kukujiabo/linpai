
@extends('profile/profile')

@section('subcontent')
@include('modal-box')
<div class="sub-wrapper">
  <h4>我的订单</h4>
</div>
<hr class="no-margin">
@if (empty($orders))

  <div class="padding-5"></div>
  <div class="sub-wrapper">
    <div class="alert alert-warning padding-5">
      您还没有下过订单，您可以即刻&nbsp;<a href="/goods">购买临牌</a>
    </div>
  </div>

@else
  <div class="sub-wrapper">
    <div class="padding-5"></div>
    <div class="order-head text-center">
      <div class="col-md-3">商品名称</div>
      <div class="col-md-2">单价（元）</div>
      <div class="col-md-1">数量</div>
      <div class="col-md-1">减免</div>
      <div class="col-md-2">实付款</div>
      <div class="col-md-1">状态</div>
      <div class="col-md-2">开设地</div>
      <div style="clear:both"></div>
    </div>
    <div class="order-content" id="order-list">
        @foreach ($orders as $order)
        <div class="order-title">
          <div class="col-xs-4">
            <b>编号：{{$order->code}} </b>
          </div>
          <div class="col-xs-4">
            <b>{{$order->created_at}}</b>
          </div>
          <div style="clear:both"></div>
        </div>
        <div class="order-body">
          <div class="col-xs-3 no-padding">
            <div class="col-xs-4 no-padding" style="background:#eee;">
              <img src="{{ asset('/imgs/blip-64.png') }}">
            </div>
            <div class="col-xs-8  order-col">
              {{$order->gname}}
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
            <a href="{{asset('order/pay')}}?order={{$order->code}}" class="require go-to-pay" data-id="{{$order->id}}">
               未付款
            </a>

            @elseif ($order->status == 1)
            已付款
            @elseif ($order->status == 2)
              已完成
              <div>
                <a href="#" class="theme-font-blue deliver-info" data-id="{{$order->code}}">
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
      </div>
    </div>    
  </div>
  <div class="col-md-12 text-center">
    <nav>
      <ul class="pagination">
  
        @if ($page > 1)
        <li>
          <a href="#" id="" aria-label="Previous" id="o-pre-page" data-cpage="{{$page}}" data-token="{{csrf_token()}}">
            <span aria-hidden="true">&laquo;上一页</span>
          </a>
        </li>
        @else
        <li>
          <a href="#" class="hide" id="o-pre-page" aria-label="Previous" data-token="{{csrf_token()}}">
            <span aria-hidden="true">&laquo;上一页</span>
          </a>
        </li>
        @endif
        
        @for ($i = 1; $i <= $pages; $i++) 
  
          <li><a href="#" class="o-page" data-page="{{$i}}" data-token={{csrf_token()}}>{{$i}}</a></li>
  
        @endfor
  
        @if ($page < $pages)
        <li>
          <a href="#" aria-label="Next" id="o-next-page" data-cpage="{{$page}}" data-token="{{csrf_token()}}">
            <span aria-hidden="true">下一页&raquo;</span>
          </a>
        </li>

        @else

        <li>
          <a href="#" class="hide" aria-label="Next" id="o-next-page" data-token="{{csrf_token()}}">
            <span aria-hidden="true">下一页&raquo;</span>
          </a>
        </li>
  
        @endif
      </ul>
    </nav>
  </div>
@endif
<div>
  @yield('modal-box')
</div>

@endsection
