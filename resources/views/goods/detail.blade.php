@extends('app')

@extends('processbar')

@section('content')

<div class="box" id="good-info">
  <div class="padding-20">
    <ul class="nav nav-tabs good-nav" role="tablist">
      
      @foreach ($goods as $key => $good)

      @if ($good->id == $gid)

      <li role="presentation" class="active">

      @else

      <li role="presentation">

      @endif
        <a href="#{{ $good->code }} " aria-controls="{{ $good->code }}" role="tab" data-toggle="tab">
          {{ $good->name }} 
        </a>
      </li>
    
      @endforeach

    </ul>
    <div class="padding-5"></div>
    <div class="tab-content">

      @foreach ($goods as $key=> $good)

      @if ($gid == $good->id)

      <div role="tab-panel" class="tab-pane active" id="$good->code">

      @else

      <div role="tab-panel" class="tab-pane" id="$good->code">

      @endif

        <div class="well" >
          <div class="good-tab-info info-top">
            <div class="col-md-5" >
              <img class="thumbnail" width="100%" src="{{ asset('/imgs/good.jpg') }}">
            </div>
            <div class="col-md-7" style="text-align:left;">
              <h4>{{ $good->name }}</h4>
              <hr>
              <form class="form" method="post" action="order">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="gid" value="{{ $good->id }}">
                <input type="hidden" name="good_type" value="1">
                <div class="btn-group">
                  <button class="btn btn-default" id="g-minu" role="button">
                    <span class="glyphicon glyphicon-minus"></span>
                  </button>
                  <input class="btn btn-default" type="text" id="g-num" name="gnum" value="1">
                  <button class="btn btn-default" id="g-plus" role="button">
                    <span class="glyphicon glyphicon-plus"></span>
                  </button>
                </div>
                <div class="padding-5"></div>
                <div class="alert alert-info">
                  价格： ￥<span class="g-price">298</span> 元
                  <span class="tips price-tips">(可使用优惠券或推荐码抵扣部分金额。)</span>
                </div>
                <div class="form-group">
                  <button class="btn btn-default" role="button" type="submit">立即购买</button>
                </div>
              </form>        
            </div>
            <div style="clear:both;"></div>
          </div>
        </div>
      </div>

      @endforeach

    </div>
    <div class="good-info-desc">
      <h4>产品描述</h4>
      <p>
        1.在您完成第一次购买以后，您将会得到一个推荐码，并可以推荐给朋友；
      </p>
      <p>
        2.您推荐的推荐码可以多人使用，不限人数，但每人只能使用一次。
      </p>
      <p>
        3.每一位使用您的推荐码结帐的朋友都将得到30元的减免，而座位分享推荐码的奖励，您也将获得一张30元的现金优惠券，优惠券会自动放入“我的优惠券”中； 
      </p>
    </div>
  </div>
</div>

@endsection
