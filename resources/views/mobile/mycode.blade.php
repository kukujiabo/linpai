@extends('mobile/mobile')


@section('content')
<div data-role="page">

@if (!empty($code))

  <img src="/imgs/my_boun_word.jpg" style="width:100%;height:100%;position:fixed;top:0;left:0">

  <div style="font-size:30px;text-align:center;width:100%;position:fixed;top:19%;z-index:100;color:#d9534f;font-weight:bold">{{$code}}</div>

@else


@endif
</div>

@endsection
