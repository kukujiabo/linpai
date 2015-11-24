@extends('mobile/mobile')

@include('mobile/head')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>个人中心－51临牌</h1>
  </div>
  <div data-role="content">
    <p style="font-size:18px;">欢迎您，{{$user->name}}</p>
    <p>
      <a class="ui-btn ui-shadow ui-corner-all" href="/mobile/myorder">我的订单</a>
    </p>
    <p>
      <form action="/mobile/logout" method="post" data-role="none">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <button type="submit" data-inset="false">退出登录</button>
      </form>
    </p>
  </div>
</div>


@endsection
