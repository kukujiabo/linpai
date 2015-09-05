@extends('profile/profile')

@section('subcontent')
<ul class="nav nav-tabs good-nav" role="tablist">
  <li class="col-md-6 no-padding active" role="presentation" style="border:0px;">
    <a href="#boun-code" class="bouns-tab" role="tab" data-toggle="tab" style="border:0px">
      我的推荐码
      <b class="triggle-up"></b>
    </a>
  </li>
  <li class="col-md-6 no-padding" role="presentation" style="border:0px;">
    <a href="#boun-quan" class="bouns-tab" role="tab" data-toggle="tab" style="border:0px">我的优惠券</a>
  </li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" role="tab-pannel" id="boun-code">
  @if (!empty($recomend))
    <div class="row padding-5">
      <div class="col-md-3 padding-5">
        <img src="{{ asset('/imgs/boun-code.png') }}">
      </div>
      <div class="col-md-9 text-left padding-5">
        <h3 class="">分享您的推荐码</h3>
        <p>每推荐一位好友使用51临牌，您都将获得30元优惠券奖励，奖励将不设上限。</p>
        <div class="padding-5"></div>
        <h5>您的推荐码</h5>
        <p class="alert alert-warning col-md-3 padding-5 text-center">
          <b>{{$recomend->code}}</b>
        </p>
      </div>
    </div>
    <div class="padding-20 text-left col-md-8">
      <form class="form" method="post" action="#">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <h5>输入电子邮箱或手机号码</h5>
        <textarea class="form-control" placeholder="可以输入多个邮箱或手机号，并用“空格”区分。" name="shares"></textarea>
        <div class="padding-5"></div>
        <button class="btn btn-danger" role="button" type="submit" id="invite">发送邀请</button>
      </form>
    </div>
    <div style="clear:both;"></div>
    <div class="padding-5">
      <div class="col-md-8 text-left">
        <div class="row">
          <div class="col-xs-1"> 1.</div>
          <div class="col-xs-11 no-padding">在您完成一次购买后您将获得一个推荐码，并可以推荐给朋友。</div>
        </div>
        <div class="row">
          <div class="col-xs-1">2.</div>
          <div class="col-xs-11 no-padding">每一位使用您推荐码购买的朋友都将获得30元的减免！作为奖励，您也将获得一张30元的优惠券，优惠券自动放入“我的优惠券”中！</div>
        </div>
        <div class="row">
          <div class="col-xs-1">3.</div><div class="col-xs-11 no-padding">您推荐的朋友数量将不受限制。</div>
        </div>
        <div class="row">
          <div class="col-xs-1">4.</div><div class="col-xs-11 no-padding">您的每位朋友之能使用一次该推荐码。</div>
        </div>
      </div>
      <div style="clear:both;"></div>
      <div class="padding-5"></div>
    </div>
  @else
    <div class="padding-20 text-left">
      <h3>您还没有推荐码</h3>
      <p class="padding-5">在完成第一次购买后，您将会得到一个推荐码，并可以分享给朋友。</p>
      <a role="button" class="btn btn-info" href="/home#buy">立刻购买临牌</a>
    </div>
  @endif
  </div>
  <div class="tab-pane" role="tab-pannel" id="boun-quan">
    @if (count($bouns))
      <div class="sub-wrapper">
        <h3>我的优惠券</h3>
      </div>
      <hr>
      <div class="sub-wrapper">
      
        <ul class="row quan-list">
        @foreach ($bouns as $boun)
          <li class="col-sm-4 col-md-4 bouns">
            <div class="quan-itm">
              <b class="q-price">{{$boun->note}}RMB</b>
              <br>
              <b>CODE:{{$boun->code}}</b>
            </div>
          </li>
      
        @endforeach
        </div>
      </div>
    @else
      <div class="padding-20 text-left">
       <h3>您当前没有优惠券</h3> 
       <div class="padding-5"></div>
       <p>
          将您的优惠码分享给好友，好友使用您提供的推荐码成功购买临牌后，您将获得一张价值30元的现金抵扣券。
       </p>
       <p>
          一张优惠券只能使用一次，一次购买最多可使用三张优惠券或推荐码。
        </p>
      </div>
    @endif
  </div>
</div>
<script type="text/javascript">

  window.onload = function () {

    var goodTabs = $('.bouns-tab');
  
    goodTabs.click(function (e) {
    
      var itm = $(this);

      goodTabs.find('.triggle-up').remove();

      itm.append('<b class="triggle-up"></b>');
    
    });
  
  };

</script>
@endsection
