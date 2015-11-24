@extends('mobile/mobile') 
@include('mobile/head')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>个人中心－51临牌</h1>
  </div>
  <div data-role="content" style="padding-left:0px;padding-right:0px">
    <p style="font-size:18px;padding:0px 20px;">你好，{{$user->name}}</p>
    <div class="white_full_btn" style="padding:18px; 20px;border-bottom:1px solid #eee"> 
      <a  style="font-size:20px;color:#333;font-weight:normal">{{$user->mobile}}</a>
    </div> 
    <div class="white_full_btn" style="padding: 20px;border-bottom:1px solid #eee">
      <a href="/mobile/myshare" style="font-size:20px;color:#333;font-weight:normal;display:block;width:100%">我的邀请码</a>
    </div> 
    <div class="white_full_btn" style="padding: 20px;">
      <a href="/mobile/myorder" style="font-size:20px;color:#333;font-weight:normal;display:block;width:100%">我的订单</a>
    </div> 
    <div style="margin-top:50px;">
      <form action="/mobile/logout" method="post" data-role="none">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div style="padding:0px 15%">
          <button type="submit" style="color:#fff;background:#ff8800;font-size:24px;padding:10px" class="no-shadow-orange" data-inset="false">退出登录</button>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection
