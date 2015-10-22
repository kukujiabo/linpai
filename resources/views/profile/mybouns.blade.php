@extends('profile/profile')

@section('subcontent')
<ul class="nav nav-tabs good-nav" role="tablist">

  @if ($type == 'rec')

  <li class="col-md-6 no-padding active" role="presentation" style="border:0px;">

  @else

  <li class="col-md-6 no-padding" role="presentation" style="border:0px;">

  @endif

    <a href="#boun-code" class="bouns-tab" role="tab" data-toggle="tab" style="border:0px">
      我的邀请码
      <b class="triggle-up"></b>
    </a>
  </li>
  
  @if ($type == 'discount')

    <li class="col-md-6 no-padding active" role="presentation" style="border:0px;">

  @else

    <li class="col-md-6 no-padding" role="presentation" style="border:0px;">

  @endif
    <a href="#boun-quan" class="bouns-tab" role="tab" data-toggle="tab" style="border:0px">我的优惠码</a>
  </li>
</ul>
<div class="tab-content">
  @if ($type == 'rec')
  
  <div class="tab-pane active" role="tab-pannel" id="boun-code">

  @else

  <div class="tab-pane" role="tab-pannel" id="boun-code">

  @endif
  @if (!empty($recomend))
    <div class="row padding-5">
      <div class="col-md-3 padding-5">
        <img src="{{ asset('/imgs/boun-code.png') }}">
      </div>
      <div class="col-md-9 text-left padding-5">
        <h3 class="">分享您的邀请码</h3>

        <p>
          现在就把您的邀请码分享给朋友们，您也将获得高达 <span class="theme-orig">20RMB</span> 的优惠减免。
        </p>
        <div class="padding-5"></div>
        <h5>您的邀请码</h5>
        <p class="alert alert-warning col-md-3 padding-5 text-center">
          <b>{{$recomend->code}}</b>
        </p>
      </div>
    </div>
    <div style="line-height:1.8em;text-align:left;width:85%;padding:0px 0px 0px 20px">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  现在就把您的邀请码分享给朋友们，使用您的邀请码下单的每一位朋友都将获得高达 <span class="theme-orig">20RMB</span> 的优惠减免，而作为奖励，每当有一位朋友获得优惠的同时，您同样也将获得一张 <span class="theme-orig">20RMB</span> 的优惠码以便在下次下单时获得优惠减免，奖励不设上限，优惠码将自动放入“我的优惠券码”中。
    </div>
    <div class="padding-20 text-left col-md-10">
      <form class="form" method="post" action="/profile/invite" id="invite_form">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <h5>输入电子邮箱或手机号码</h5>
        <textarea class="form-control" placeholder="可以输入多个邮箱或手机号，并用“空格” 或 “回车” 区分。" style="height:100px;" name="shares"></textarea>
        <div class="padding-5"></div>
        <button class="btn btn-danger" role="button" type="submit" id="invite_btn">发送邀请</button>
      </form>
      <div class="padding-5"></div>
      <div class="alert alert-warning">
        <div class="row">
          <div class="bdsharebuttonbox col-xs-10" data-tag="share_1">
            <a class="bds_mshare" data-cmd="mshare"></a>
            <a class="bds_qzone" data-cmd="qzone" href="#"></a>
            <a class="bds_tsina" data-cmd="tsina"></a>
            <a class="bds_baidu" data-cmd="baidu"></a>
            <a class="bds_renren" data-cmd="renren"></a>
            <a class="bds_tqq" data-cmd="tqq"></a>
            <a class="bds_more" data-cmd="more">&nbsp;更多</a>
            <a class="bds_count" data-cmd="count"></a>
          </div>
        </div>
      </div>
      <script>
        window._bd_share_config = {
           common : {
           bdText : '51临牌是专业...',  
           bdDesc : '自定义分享摘要',  
           bdUrl : 'http://51linpai.com/home',  
           bdPic : 'http://51linpai.com/imgs/wechat-code.jpg'
           },
           share : [{
             "bdSize" : 16
           }],
           slide : [{     
           bdImg : 0,
           bdPos : "right",
           bdTop : 100
               }],
           image : [{
           viewType : 'list',
           viewPos : 'top',
           viewColor : 'black',
           viewSize : '16',
           viewList : ['qzone','tsina','huaban','tqq','renren']
           }],
           selectShare : [{
           "bdselectMiniList" : ['qzone','tqq','kaixin001','bdxc','tqf']
           }]
        }


        </script>


    </div>
    <div style="clear:both;"></div>
    <div class="padding-5">
      <div class="col-md-10 text-left no-padding-left">
        <ol class="info_list">
          <li>您的朋友需在下单时在邀请码／优惠码页面输入您的邀请码，方能获得优惠减免。 </li>
          <li>您可以邀请的朋友数量不设上限。</li>
          <li>您的每位朋友仅能使用一次您的邀请码。</li>
        </ol>
      </div>
      <div style="clear:both;"></div>
      <div class="padding-5"></div>
    </div>
  @else
    <div class="padding-20 text-left">
      <h3>您还没有邀请码</h3>
      <div class="padding-5"></div>
      <h4>什么是邀请码？</h4>
      <p class="padding-5" style="line-height:1.8em">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;邀请码是［51临牌］提供给您的一种唯一编码，使用您的邀请码下单的朋友将获得高达 <span class="theme-orig">20RMB</span> 的优惠减免；而作为奖励，每当有一位朋友获得优惠的同时，您同样也将获得一张 <span class="theme-orig">20RMB</span> 的优惠码以便在下次下单时获得优惠减免，奖励不设上限，优惠码将自动放入“我的优惠券码”中。
      </p>
      <h4>如何获取邀请码？</h4>
      <p class="padding-5">
      在您完成第一次订单以后，您将获得一个邀请码并可以分享给朋友们，该邀请码唯一且永久有效。
      </p>
      <a role="button" class="btn btn-info theme-back-blue" href="/home#buy">立刻购买临牌</a>
    </div>
  @endif
  </div>
  
  @if ($type == 'discount')

  <div class="tab-pane active" role="tab-pannel" id="boun-quan">

  @else

  <div class="tab-pane" role="tab-pannel" id="boun-quan">

  @endif

    @if (count($bouns))
      <div class="sub-wrapper">
        <div class="padding-5"></div>
        <ol class="info_list text-left">
          <li>
            在您下一次下单时，需要在邀请码／优惠码页面直接使用您的优惠码即可获得优惠减免。
          </li>
          <li>
            优惠码可以累计使用。
          </li>
          <li>
            每个优惠码仅可以使用一次。
          </li>
          <li>
            您的优惠码仅限您本人使用。
          </li>
        </ol>
        <ul class="row quan-list">
        @foreach ($bouns as $boun)
          <li class="col-sm-4 col-md-4 bouns">
            <img src="/imgs/quan-avai.png" style="width:100%;z-index:10001">
            <div class="quan-itm">
              <b class="q-price">{{$boun->note}}RMB</b>
              <br>
              <b>CODE：{{$boun->code}}</b>
            </div>
          </li>
        
        @endforeach
        </ul>
          <div class="padding-5"></div>
        </div>
      </div>
    @else
      <div class="padding-20 text-left">
       <h3>您还没有优惠码</h3> 
       <div class="padding-5"></div>
       <h4>如何获取优惠码</h4>
       <p style="line-height:1.8em">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将您的邀请码分享给朋友，每当有朋友使用您的邀请码下单后，系统都会自动为您添加一个价值 <span class="theme-orig">20RMB</span> 的优惠码，并可以在下次下单时使用以获得优惠减免。您邀请的朋友数量并不设上限。
       </p>
        <br>
       <p>
        <h4>如何使用优惠码</h4>
        <ol class="info_list text-left">
          <li>
            在您下一次下单时，需要在邀请码／优惠码页面直接使用您的优惠码即可获得优惠减免。
          </li>
          <li>
            优惠码可以累计使用。
          </li>
          <li>
            每个优惠码仅可以使用一次。
          </li>
          <li>
            您的优惠码仅限您本人使用。
          </li>
        </ol>

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

    //document.getElementsByClassName('bdshare-slide-button')[0].style.display = 'none';
  
  };

</script>
@endsection
