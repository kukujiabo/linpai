@extends('app')


@extends('banner')

@section('content')
  <div class="padding-5"></div>
  <div id="why-us" class="well box">
    <h2>---为什么选择我们---</h2>
    <hr>
    <div class="row">
      <div class="col-md-4">
        <i class="professional"></i>
        <h3>专业的服务</h3>
        <p>
          我们有专业的团队，专业的设备，良好的售后服务
        </p>
      </div>
      <div class="col-md-4">
        <i class="personal"></i>
        <h3>个性化定制</h3>
        <p>
          我们关心每个用户的要求，关注每个微小的细节。
        </p>
      </div>
      <div class="col-md-4">
        <i class="reliable"></i>
        <h3>可靠的产品</h3>
        <p>
          我们的产品上市至今，获得广大用户的一致好评， 
        </p>
      </div>
    </div>
  </div>
  <div class="padding-5"></div>
  <div id="how" class="well box">
    <h2>---如何购买---</h2>
    <hr>
    <div class="row">
      <div class="col-md-4">
        <i class="professional"></i>
        <h3>第一步</h3>
      </div>
      <div class="col-md-4">
        <i class="personal"></i>
        <h3>第二步</h3>
      </div>
      <div class="col-md-4">
        <i class="reliable"></i>
        <h3>第三步</h3>
      </div>
    </div>
  </div>
  <div class="padding-5"></div>
  <div id="buy" class="well box" >
    <h2>---购买产品---</h2>
    <hr>
    <div class="row">
  
      <!-- 商品列表开始 -->

      @foreach ($goods as $goodLine)
      
        <div class="col-md-1 lg-md-1">
        </div> 

        @foreach ($goodLine as $key => $good)

        <div class="col-md-5 lg-md-5">
          <div class="thumbnail">
            <a href="{{ asset('goods?gid='. $good->id) }}">
              <img class="good-img" src="{{ asset($good->pic) }}">
            </a>
            <div class="caption">
              <h3>{{ $good->name }}</h3>
              <p>
                {{ $good->intro }}
              </p>
            </div>
          </div>
  
        </div> 

        @endforeach
        <div class="col-md-1 lg-md-1">
        </div> 

      @endforeach

      <!-- 商品列表结束 -->

    </div>
    <br>
    <br>
  </div>
@endsection
