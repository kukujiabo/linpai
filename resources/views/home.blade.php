@extends('app')

@extends('banner')

@extends('area_select')

@section('content')
  <div id="why-us">
    <b class="home-section">为什么选择我们？</b>
    <div class="home-block">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">
          <img src="/imgs/safe.jpg"> 
          <div class="padding-5"></div>
          <h3>安全</h3>
          <p>
            车管所正规办理，100%真临牌，出险可理赔
          </p>
        </div>
        <div class="col-md-2">
          <img src="/imgs/money.jpg"> 
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
            在线4步轻松购买，告别传统繁复流程
          </p>
        </div>
        <div class="col-md-2">
          <img src="/imgs/shunfeng.png"> 
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
  <div id="why-us" style="background:#eee;padding-top:50px">
    <b class="home-section" >如何购买？</b> 
    <div class="home-block">
      <div class="row" style="min-height:244px;">
        <div class="intro-bar"></div>
        <div class="col-xs-2 col-sm-2 col-md-2"></div>
        <div class="col-xs-2 col-sm-2 col-md-2">
          <img class="process-bar-img" src="/imgs/i-selected.jpg" style="padding: 0px 3px;">
          <div class="padding-5"></div>
          <h4>选择临牌</h4>
          <p class="process-bar-step">
            选择您所需要购买的临时号牌
          </p>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
          <img class="process-bar-img"  src="/imgs/i-upload.jpg" style="padding: 0px 3px;">
          <div class="padding-5"></div>
          <h4>上传扫描件</h4>
          <p class="process-bar-step">
            上传相关的车辆档案，请参考 <a class="theme-font-blue" href="/text/metaguide">办理材料指南</a>
          </p>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
          <img class="process-bar-img"  src="/imgs/i-pay.jpg" style="padding: 0px 3px;">
          <div class="padding-5"></div>
          <h4>在线支付</h4>
          <p class="process-bar-step">
            支付宝、微信、网银均可支付，方便快捷 
          </p>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
          <img class="process-bar-img"  src="/imgs/i-deliver.jpg" style="background:#fff;">
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
  <div id="buy">
    <b class="home-section">购买临时号牌 </b>
    <div class="row home-block">
  
      <!-- 商品列表开始 -->

      @foreach ($goods as $goodLine)
      
        <div class="col-md-2">
        </div> 

        @foreach ($goodLine as $key => $good)

        <div class="col-xs-6 col-md-3" style="">
          <div class="thumbnail no-radius" style="background:#eee;">
            <b class="no_trans_fee"></b>
            <a href="{{ asset('goods?gid='. $good->id) }}">
              <img class="good-img" src="{{ asset($good->pic) }}">
              <div class="caption good-block text-left">
                <h3>{{ $good->name }}</h3>
                <p class="h-good-intro">
                  {{ $good->intro }}
                </p>
                <div class="row">
                  <div class="col-xs-3 no-padding-left">
                    <h3 class="require no-margin padding-3">¥&nbsp;{{ $good->price }}</h3>
                  </div>
                  <div class="col-xs-6 col-xs-offset-3 no-padding">
                    <button class="btn btn-danger no-radius btn-group-justified">立即购买</button>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div> 
        <div class="col-md-2"></div>
        @endforeach

      @endforeach

      <!-- 商品列表结束 -->

    </div>
  </div>
@endsection
