@section('banner')
<div id="my-carousel" class="carousel slide" data-interval="5000" style="height: auto; border-radius: 3px; margin-top:130px;">
  <ol class="carousel-indicators">
    <li data-target="#my-carousel" data-slide-to="0" class="active"></li>
    <li data-target="#my-carousel" data-slide-to="1"></li>
    <li data-target="#my-carousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="item active rounded" style="width: auto">
      <img class="banner-img" src="../imgs/carousel/race1.png">
      <div class="container">
        <div class="carousel-caption s-d-caption">
          <div class="pading-20">
            <h2>新车临时牌照</h2>
          </div>
          <div class="padding-5"></div>
          <div>
            <a class="btn btn-default btn-lg btn-center btn-banner no-border" href="#buy" role="button">即刻购买临牌</a>
          </div>
        </div>
      </div>
    </div>
    <div class="item rounded" style="width: auto">
      <img class="banner-img" src="../imgs/carousel/race2.png">
      <div class="container">
        <div class="carousel-caption s-d-caption">
          <div class="padding-20">
            <h2>新车临时牌照</h2>
          </div>
          <div class="padding-5"></div>
          <div class="padding-5">
            <a class="btn btn-default btn-lg btn-center btn-banner" href="#buy" role="button">即刻购买临牌</a>
          </div>
        </div>
      </div>
    </div>
    <div class="item rounded" style="width: auto">
      <img class="banner-img" src="../imgs/carousel/race3.png">
      <div class="container">
        <div class="carousel-caption s-d-caption">
          <div class="padding-20">
            <h2>新车临时牌照</h2>
          </div>
          <div class="padding-5"></div>
          <div class="padding-5">
            <a class="btn btn-default btn-lg btn-center btn-banner" href="#buy" role="button">即刻购买临牌</a>
          </div>
        </div>
      </div>
    </div>
    <a class="left carousel-control" href="#my-carousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#my-carousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
  </div>
</div>

@endsection
