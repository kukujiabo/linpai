@extends('app')

@extends('banner')

@extends('area_select')

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
          <p class="process-bar-step">
            选择您所需要购买的临时号牌
          </p>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
          <img class="process-bar-img"  src="/imgs/i-upload.png">
          <div class="padding-5"></div>
          <h4>上传扫描件</h4>
          <p class="process-bar-step">
            上传相关的车辆档案，请参考办理材料指南
          </p>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
          <img class="process-bar-img"  src="/imgs/i-pay.jpg" style="padding: 0px 3px; background:#fff;">
          <div class="padding-5"></div>
          <h4>在线支付</h4>
          <p class="process-bar-step">
            支付宝、微信、网银均可支付，方便快捷 
          </p>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
          <img class="process-bar-img"  src="/imgs/i-deliver.jpg">
          <div class="padding-5"></div>
          <h4>等待收货</h4>
          <p class="process-bar-step">
            顺丰直达，安全省心
          </p>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2"></div>
      </div>
    </div>
  </div>
  <div class="padding-5"></div>
  <div class="padding-5"></div>
  <div id="buy">
    <b class="home-section">购买临时号牌 </b>
    <div class="padding-5"></div>
    <div class="row home-block">
  
      <!-- 商品列表开始 -->

      @foreach ($goods as $goodLine)
      
        <div class="col-md-2">
        </div> 

        @foreach ($goodLine as $key => $good)

        <div class="col-xs-6 col-md-4">
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
        <div class="col-md-2">
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
            专业临牌办理团队，<br>让您全程无忧
          </p>
        </div>
        <div class="col-md-2">
          <img src="/imgs/caozhi.png"> 
          <div class="padding-5"></div>
          <h3>超值</h3>
          <p>
            业内最具竞争力的价格，<br>秒杀所有4S店
          </p>
        </div>
        <div class="col-md-2">
          <img src="/imgs/simple.png"> 
          <div class="padding-5"></div>
          <h3>简单</h3>
          <p>
            轻松4步购买，瞬间搞定
          </p>
        </div>
        <div class="col-md-2">
          <img src="/imgs/efficiency.png"> 
          <div class="padding-5"></div>
          <h3>高效</h3>
          <p>
            顺丰速递直送，省时省力
          </p>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
  </div>
<div class="qr-code">
  <img src="/imgs/m-code.png">
</div>
@endsection
