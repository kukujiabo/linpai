@extends('mobile/mobile')

@section('content')

<div data-role="page">

@if (!empty($code))

  <img src="/imgs/share_others.jpg" style="width:100%;height:100%;position:fixed;top:0;left:0">

  <div style="font-size:30px;text-align:center;width:100%;position:fixed;top:70%;z-index:100;color:#d9534f;font-weight:bold">{{$code}}</div>

  <div style="font-size:16px;text-align:center;width:100%;position:fixed;top:80%;z-index:100;color:#d9534f;font-weight:bold">请登录 www.51linpai.com 进行购买</div>
@else

@endif
  

</div>

@endsection
