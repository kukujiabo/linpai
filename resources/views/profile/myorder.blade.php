@extends('profile/profile')

@section('subcontent')

@include('modal-box')

<div class="sub-wrapper">
  <h4>我的订单</h4>
</div>
<hr class="no-margin">
@if (!count($orders))

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
      <div class="col-md-1">优惠减免</div>
      <div class="col-md-2">实付款</div>
      <div class="col-md-1">交易状态</div>
      <div class="col-md-2">临牌号</div>
      <div style="clear:both"></div>
    </div>
    <div class="order-content" id="order-list">

      @include('profile/order_list')

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
<input type="hidden" id="out_csrf_code" value="{{csrf_token()}}">

@endsection
