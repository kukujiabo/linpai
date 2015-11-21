@extends('mobile/mobile')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>{{$name}}邀请您加入51临牌</h1>
  </div>
  <div data-role="content">
    @if (empty($code)) 


    @else
      <div id="share_code">
        {{$code}}
      </div> 
    @endif
  </div>

</div>

@endsection
