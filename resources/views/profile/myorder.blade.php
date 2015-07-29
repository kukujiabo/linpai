@extends('profile/profile')

@section('subcontent')
<ul class="media-list"  >
  <li class="media">
    <div class="media-left">
      <a href="#" class="bk-red">
        <img class="media-object" src="{{ asset('/imgs/blip-64.png') }}">
      </a>
    </div>
    <div class="media-body">
      <h4 class="media-heading">This is an order for temperary card.</h4>
      <p>
      </p>
    </div>
    <div class="media-right media-middle">
      <a class="btn btn-info btn-sm in-line" href="#">
        <span class="glyphicon glyphicon-credit-card"></span>
        支付
      </a>
    </div>
  </li>
  <li class="media">
    <div class="media-left">
      <a href="#" class="bk-red">
        <img class="media-object" src="{{ asset('/imgs/blip-64.png') }}">
      </a>
    </div>
    <div class="media-body">
      <h4 class="media-heading">This is an order for temperary card.</h4>
      <p>
      </p>
    </div>
    <div class="media-right media-middle">
      <a class="btn btn-primary btn-sm in-line" href="#" disabled>
        <span class="glyphicon glyphicon-time"></span>
        待发
      </a>
    </div>
  </li>
  <li class="media">
    <div class="media-left">
      <a href="#" class="bk-red">
        <img class="media-object" src="{{ asset('/imgs/blip-64.png') }}">
      </a>
    </div>
    <div class="media-body">
      <h4 class="media-heading">This is an order for temperary card.</h4>
      <p>
      </p>
    </div>
    <div class="media-right media-middle">
      <a class="btn btn-warning btn-sm in-line" href="#">
        <span class="glyphicon glyphicon-pencil"></span>
        签收
      </a>
    </div>
  </li>
  <li class="media">
    <div class="media-left">
      <a href="#" class="bk-red">
        <img class="media-object" src="{{ asset('/imgs/blip-64.png') }}">
      </a>
    </div>
    <div class="media-body">
      <h4 class="media-heading">This is an order for temperary card.</h4>
      <p>
      </p>
    </div>
    <div class="media-right media-middle">
      <a class="btn btn-success btn-sm in-line" href="#" disabled>
        <span class="glyphicon glyphicon-ok"></span>
        完成
      </a>
    </div>
  </li>
  <li class="media">
    <div class="media-left">
      <a href="#" class="bk-red">
        <img class="media-object" src="{{ asset('/imgs/blip-64.png') }}">
      </a>
    </div>
    <div class="media-body">
      <h4 class="media-heading">This is an order for temperary card.</h4>
      <p>
      </p>
    </div>
    <div class="media-right media-middle">
      <a class="btn btn-default btn-sm in-line" href="#" disabled>
        <span class="glyphicon glyphicon-lock"></span>
        关闭
      </a>
    </div>
  </li>
</ul>

@endsection
