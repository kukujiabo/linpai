@extends('app')

@extends('banner')

@section('content')
  <div id="why-us">
    <b class="home-section">如何购买？</b> 
    <div class="home-block">
      <div class="row">
        <div class="intro-bar"></div>
        <div class="col-xs-2 col-sm-2 col-md-2"></div>
        <div class="col-xs-2 col-sm-2 col-md-2">
          <img class="process-bar-img" src="/imgs/i-select.png">
          <div class="padding-5"></div>
          <h4>选择临牌</h4>
          <p>
            第一步：挑选您喜欢的临牌，放入购物车中
          </p>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
          <img class="process-bar-img"  src="/imgs/i-upload.png">
          <div class="padding-5"></div>
          <h4>上传扫描件</h4>
          <p>
            第二步：上传你爱车的信息
          </p>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
          <img class="process-bar-img"  src="/imgs/i-pay.jpg" style="padding: 0px 3px; background:#fff;">
          <div class="padding-5"></div>
          <h4>在线支付</h4>
          <p>
            第三步：支付宝，微信，网银均可支付，方便快捷
          </p>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
          <img class="process-bar-img"  src="/imgs/i-deliver.jpg">
          <div class="padding-5"></div>
          <h4>等待收货</h4>
          <p>
            第四步：坐等收快递，省心！
          </p>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2"></div>
      </div>
    </div>
  </div>
  <div class="padding-5"></div>
  <div class="padding-5"></div>
  <div id="buy">
    <b class="home-section">购买产品</b>
    <div class="padding-5"></div>
    <div class="row home-block">
  
      <!-- 商品列表开始 -->

      @foreach ($goods as $goodLine)
      
        <div class="col-xs-2">
        </div> 

        @foreach ($goodLine as $key => $good)

        <div class="col-xs-4">
          <div class="thumbnail">
            <a href="{{ asset('goods?gid='. $good->id) }}">
              <img class="good-img" src="{{ asset($good->pic) }}">
              <div class="caption good-block">
                <h3>{{ $good->name }}</h3>
                <p>
                  {{ $good->intro }}
                </p>
              </div>
            </a>
          </div>
        </div> 

        @endforeach
        <div class="col-xs-2">
        </div> 

      @endforeach

      <!-- 商品列表结束 -->

    </div>
  </div>
  <div id="why-us" class="top-100">
    <b class="home-section">为什么选择我们？</b>
    <div class="home-block">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">
          <img src="/imgs/professional.png"> 
          <div class="padding-5"></div>
          <h3>专业</h3>
          <p>
            专业团队，让您全程无忧
          </p>
        </div>
        <div class="col-md-2">
          <img src="/imgs/caozhi.png"> 
          <div class="padding-5"></div>
          <h3>超值</h3>
          <p>
            全网最低的临牌购买价
          </p>
        </div>
        <div class="col-md-2">
          <img src="/imgs/simple.png"> 
          <div class="padding-5"></div>
          <h3>简单</h3>
          <p>
            购买4步骤，一分钟搞定
          </p>
        </div>
        <div class="col-md-2">
          <img src="/imgs/efficiency.png"> 
          <div class="padding-5"></div>
          <h3>高效</h3>
          <p>
            免费快递直送，速度
          </p>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
  </div>
<div class="qr-code">
  <img src="/imgs/qr-code.png">
  <div class="focus-brand">
    扫一扫，关注51临牌公众号，立即购买！
  </div>
</div>
@endsection
