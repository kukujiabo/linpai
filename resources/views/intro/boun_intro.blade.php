@extends('app')

@section('content')

<div class="box" style="margin-top:50px;background:#fff;">
  <div class="padding-20" style="line-height:2.0em">
    <h4>什么是邀请码？</h4>
    <p>
    邀请码（例如：图片）是［51临牌］提供给您的一种唯一编码，使用您的邀请码下单的朋友将获得高达 20RMB 的优惠减免；而作为奖励，每当有一位朋友获得优惠的同时，您同样也将获得一张20RMB 的优惠码以便在下次下单时获得优惠减免，奖励不设上限，优惠码将自动放入“我的优惠券码”中。
    </p> 
    <br>
    <h4>如何获取邀请码？</h4>
    <p>
    在您完成第一次订单以后，您将获得一个邀请码并可以分享给朋友们，该邀请码唯一且永久有效。
    </p>
  
    <br>
    <h4>如何使用邀请码？</h4>
    <p>
    您的朋友需在下单时在邀请码／优惠码页面输入您的邀请码，方能获得优惠减免。
    您可以邀请的朋友数量不设上限。
    您的每位朋友仅能使用一次您的邀请码。
    </p>
    
    <br>
    <h4>如何获取优惠码？</h4>
    <p>
    将您的邀请码分享给朋友，每当有朋友使用您的邀请码下单后，系统都会自动为您添加一个价值 20RMB 的优惠码，并可以在下次下单时使用以获得优惠减免。您邀请的朋友数量并不设上限。
    </p>  
  
    <br>
    <h4>如何使用优惠码？</h4>
    <p>
    在您下一次下单时，需要在邀请码／优惠码页面直接使用您的优惠码即可获得优惠减免。
    优惠码可以累计使用。
    每个优惠码仅可以使用一次。
    您的优惠码仅限您本人使用。
    </p>
  
    
    <br>
    <a href="/profile/mybouns" class="btn btn-primary theme-back-blue"style="color:#fff">看我的邀请码／优惠码</a>
  </div>
</div>
<script type="text/javascript">
  window.onload = function () {$('body').css({background: "#eee"});};
</script>
@endsection
