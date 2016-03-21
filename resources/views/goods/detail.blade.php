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
        <div class="good-tab-info info-top">
          <div class="col-md-5" >
            <img class="thumbnail" width="100%" src="{{asset($good->pic)}}">
          </div>
          <div class="col-md-7" style="text-align:left;">
            <h4>{{ $good->name }}</h4>
            <hr>
            <form class="form" method="get" action="order" id="detail_form_{{$good->id}}">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <input type="hidden" name="gid" value="{{$good->id}}">
              <input type="hidden" name="car_hand" value="one">
              <input type="hidden" name="good_type" value="1">
              @if (!empty($error))
                <div class="alert alert-danger" id="num-err">
                  <h5>温馨提示：</h5>
                  {{$error}}
                </div>
              @endif
              <div class="btn-group width-100">
                <button class="btn btn-default" id="g-minu" role="button" data-id="{{$good->id}}" data-target="g-num-{{$good->id}}">
                  <span class="glyphicon glyphicon-minus"></span>
                </button>
                <input class="btn btn-default g-num" type="text" id="g-num-{{$good->id}}" name="gnum" value="1">
                <button class="btn btn-default" id="g-plus" role="button" data-id="{{$good->id}}" data-target="g-num-{{$good->id}}" data-container="body" data-toggle="popover" data-placement="right" data-content="每位用户每次仅可购买一张车辆临时牌照">

                  <span class="glyphicon glyphicon-plus"></span>
                </button>
                <div class="col-xs-6" style="padding-top:5px;color:#000;">
                  &nbsp;&nbsp;每位用户每次限购1份
                </div>
              </div>
              <div class="padding-5"></div>
              <div class="theme-orig" style="font-size:18px;">
                <b>￥</b><span class="g-price" id="price-{{$good->id}}">{{$goodInfos[$key]->value}}</span>
                <input type="hidden" id="single-price-{{$good->id}}" value="{{$goodInfos[$key]->value}}">
              </div>
              <div class="padding-5"></div>
              <div class="form-group">
        @if ($good->code == 'below-three')
                <button class="btn btn-danger to_buy" role="button" disabled type="submit" target_form="detail_form_{{$good->id}}">立即购买</button> &nbsp;&nbsp;&nbsp;&nbsp; 即将上线，敬请期待！
        @else
                <button class="btn btn-danger to_buy" role="button" type="submit" target_form="detail_form_{{$good->id}}">立即购买</button>
        @endif
              </div>
            </form>        
          </div>
          <div style="clear:both;"></div>
        </div>
      </div>
      <div class="good-info-desc text-left">
        {!! htmlspecialchars_decode($good->comment) !!}
      </div>
    </div>

    @endforeach

  </div>
  </div>
<div class="hide" id="car_hand">
  <div class="over-all"></div>
  <div id="choose_car_hand">
    <div class="padding-20"></div>
    <div class="row text-center padding-5">
      <div class="col-xs-6 padding-5">
        <div class="ck_button ck_checked" data-value="one">新车</div>
      </div>
      <div class="col-xs-6 padding-5">
        <div class="ck_button ck_unchecked" data-value="second">二手车</div>
      </div>
    </div>
    <div class="padding-5 col-xs-6 col-xs-offset-3">
      <button class="btn btn-primary theme-back-blue btn-group-justified" id="next_order">下一步</button>
    </div>
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

      $('button#g-plus').hover(function () {

        $(this).popover('show');

      }, function () {

        $(this).popover('hide');
      
      });

    };

  </script>
@endsection
