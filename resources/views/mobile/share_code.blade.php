@extends('mobile/mobile')

@section('content')

<div data-role="page">

@if (!empty($code))

  <img src="/imgs/share_others.jpg" style="width:100%;height:100%;position:fixed;top:0;left:0">

  <div style="font-size:30px;text-align:center;width:100%;position:fixed;top:70%;z-index:100;color:#d9534f;font-weight:bold">{{$code}}</div>

  <div style="font-size:16px;text-align:center;width:100%;position:fixed;top:80%;z-index:100;color:#d9534f;font-weight:bold">请登录 www.51linpai.com 进行购买</div>
@else

<div data-role="header">
  <h1>我的邀请码－51临牌</h1>
  <a href="/mobile/profile" style="display:block;padding:1px;" data-role="none" class="ui-btn-right">
    <img src="/imgs/35.png">
  </a>
</div>
<div data-role="content">
  <div style="padding:30px;font-size:20px;border-radius:5px;background:#fff;text-shadow:none;font-weight:none;">
    <p>
      您当前还没有邀请码哦～
    <p>
    <ol style="font-size:16px;padding-left:20px;">
      <li>您第一次下单购买成功后，系统将自动为你分配邀请码。</li>
      <li>您的邀请码可以分享给好友，好友可以在下单时使用您的邀请码获得20元费用减免。</li>
      <li>您的好友成功下单支付后，您也将获得20元的优惠券，并在下次下单时使用。</li>
      <li>每个好友只能使用一次您的邀请码。</li>
    </ol>
    <div style="margin-top:50px;">
      <a href="/miniorder/cartype" class="orange_btn">立即购买临牌</a> 
    </div>
  </div>
</div>
@endif
  
</div>

@endsection
