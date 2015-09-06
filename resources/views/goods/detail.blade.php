@extends('app')

@extends('processbar')

@section('content')

<div class="box no-padding" id="good-info">
  <ul class="nav nav-tabs good-nav" role="tablist">
    
    @foreach ($goods as $key => $good)

    @if ($good->id == $gid)

    <li class="col-xs-6 active no-padding" role="presentation" style="border: 0px">

    @else

    <li class="col-xs-6 no-padding" role="presentation" style="border: 0px">

    @endif
      <a href="#{{ $good->code }}" class="good-tab" aria-controls="{{ $good->code }}" role="tab" data-toggle="tab"  style="border: 0px">
        {{ $good->name }} 
        @if ($good->id == $gid)
        <b class="triggle-up"></b>
        @endif
      </a>
    </li>
  
    @endforeach

  </ul>
  <div class="padding-5"></div>
  <div class="tab-content">

    @foreach ($goods as $key => $good)

    @if ($gid == $good->id)

    <div role="tab-panel" class="tab-pane active" id="{{$good->code}}">

    @else

    <div role="tab-panel" class="tab-pane" id="{{$good->code}}">

    @endif

      <div class="alert alert-warning" style="margin: 0px 10px;" >
        <div clas !importants="good-tab-info info-top">
          <div class="col-md-5" >
            <img class="thumbnail" width="100%" src="{{$good->pic}}">
          </div>
          <div class="col-md-7" style="text-align:left;">
            <h4>{{ $good->name }}</h4>
            <hr>
            <form class="form" method="get" action="order">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <input type="hidden" name="gid" value="{{$good->id}}">
              <input type="hidden" name="good_type" value="1">
              @if (!empty($error))
                <div class="alert alert-danger" id="num-err">
                  <h5>温馨提示：</h5>
                  {{$error}}
                </div>
              @endif
              <div class="btn-group">
                <button class="btn btn-default" id="g-minu" role="button" data-id="{{$good->id}}" data-target="g-num-{{$good->id}}">
                  <span class="glyphicon glyphicon-minus"></span>
                </button>
                <input class="btn btn-default g-num" type="text" id="g-num-{{$good->id}}" name="gnum" value="1">
                <button class="btn btn-default" id="g-plus" role="button" data-id="{{$good->id}}" data-target="g-num-{{$good->id}}">
                  <span class="glyphicon glyphicon-plus"></span>
                </button>
              </div>
              <div class="padding-5"></div>
              <div class="alert alert-info">
                价格： ￥<span class="g-price" id="price-{{$good->id}}">{{$goodInfos[$key]->value}}</span> 元
                <span class="tips price-tips">(可使用优惠券或推荐码抵扣部分金额。)</span>
                <input type="hidden" id="single-price-{{$good->id}}" value="{{$goodInfos[$key]->value}}">
              </div>
              <div class="form-group">
                <button class="btn btn-danger" role="button" type="submit">立即购买</button>
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
  <script type="text/javascript">

    window.onload = function () {

      var goodTabs = $('.good-tab');
    
      goodTabs.click(function (e) {
      
        var itm = $(this);

        goodTabs.find('.triggle-up').remove();

        itm.append('<b class="triggle-up"></b>');
      
      });
    
    };

  </script>
@endsection
