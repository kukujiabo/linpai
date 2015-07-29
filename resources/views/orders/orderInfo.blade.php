@extends('app')

@extends('processbar')

@section('content')
<div class="process">
  @yield('process')
</div>
<p>确认订单信息</p>
<div class="box" >
  <div class="sub-wrapper">
    <div class="media">
      <div class="media-left">
        <a href="#" class="gray-light" style="display:block">
          <img class="media-object" src="imgs/blip-64.png" alt="">
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">{{ $good->name }}</h4>
        <div>298元</div>
        <div>数量：{{ $num }} &nbsp;张</div>
      </div>
    </div>
  </div>
</div>
<p>临牌车辆所有人信息</p>
<div class="box" id="car-info">
  <div class="sub-wrapper">
    <div class="person-info table-responsive">
      <table class="table">
        <thead class="gray-light">
          <tr>
            <th>所有人</th>
            <th>车辆型号</th>
            <th>临牌号</th>
            <th>操作</th>
          </tr>
        </thead> 
        <tbody>
          <tr>
            <td>刘德华</td>
            <td>保时捷</td>
            <td>askldwo</td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="sub-wrapper" id="car-info-toggle">
    <button role="button" class="btn btn-default" id="car-info-add" data-status="show">
      <span class="glyphicon glyphicon-plus"></span> 
      <span id="c-i-a-content">新增车辆</span>
    </button>
  </div>
  <div class="padding-5">
  </div>
  <div class="gray-light edit-info" id="car-info-edit">
    <form class="form-inline" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <fieldset>
        <div class="form-group col-md-5">
            <label for="owner-info" class="control-label col-md-4">
              <span class="require">*</span>
              车辆所有人信息
            </label>
            <input type="text" class="form-control col-md-4" placeholder="vehical owner" id="owner-info">
        </div>
        <div class="form-group col-md-6">
            <label for="v-brand" class="control-label col-md-4">
              <span class="require">*</span>
              车辆品牌
            </label>
            <input type="text" class="form-control col-md-4" placeholder="vehical brand" id="v-brand">
        </div>
      </fieldset>
      <br>
      <fieldset>
        <div class="form-group col-md-5">
            <label for="v-brand" class="col-md-4 control-label ">
              <span class="require">*</span>
              车辆厂牌型号
            </label>
            <input type="text" class="form-control col-md-4" placeholder="vehical factory type" id="v-factory">
        </div>
        <div class="form-group col-md-6">
          <label for="v-brand" class="control-label col-md-4" >
            <span class="require">*</span>
            识别号码（车架号）
          </label>
          <input type="text" class="form-control col-md-4" placeholder="vehical factory type" id="v-factory">
        </div>
      </fieldset>
      <fieldset>
        <div class="form-group col-md-12">
          <p class="col-md-12" style="margin: 20px 0px;">
            <span class="require">*</span>
            车辆相关文件
          </p>
        </div>
      </fieldset>
      <div class="sub-wrapper">
        <div class="row">
          <div class="col-md-1">
          </div>
    
          @foreach ($good_attribs as $good_attrib) 
  
            @if ($good_attrib['spec'] == 'file_upload')

            <div class="col-md-2">
              <div style="padding-5">
                <div class="thumbnail">
                  <img class="upload-img" src="imgs/blip-64.png" alt="" style="width:100%;">
                  <div class="progress progress-striped active progress-sm" role="progressbar">
                    <div class="progress-bar progress-bar-success" style="width:20%;">
                    </div>
                  </div> 
                  <div class="caption" align="center">
                    <a href="javascript:void(0);" class="btn btn-default btn-sm">
                      <label class="no-margin" for="identity-1">选择图片</label>
                    </a>
                    <input type="file" id="{{$good_attrib['acode']}}" name="{{$good_attrib['acode']}}" class="hide info-img" data-url="uploads?code={{ $good_attrib['acode'] }}&spec={{ $good_attrib['spec']}}" multiple />
                  </div>
                </div>
              </div>
            </div>

            @endif

          @endforeach    

          <div class="col-md-1">
          </div>
        </div>        
      </div>
      <div class="form-group sub-wrapper">
        <button type="submit" role="button" class="btn btn-primary">保存车辆信息</button>
      </div>
    </form> 
  </div>
</div>
<p>收货人信息</p>
<div class="box" id="customer-info">
  <div class="sub-wrapper">
    <div class="person-info table-responsive">
      <table class="table">
        <thead class="gray-light">
          <tr>
            <th class="col-md-1 t-center">收货人</th>
            <th class="col-md-7 t-center">地址</th>
            <th class="col-md-2 t-center">手机号</th>
            <th class="col-md-2 t-center">操作</th>
          </tr>
        </thead> 
        <tbody>
          <tr>
            <td class="col-md-1 t-center">刘德华</td>
            <td class="col-md-7 t-center">保时捷</td>
            <td class="col-md-2 t-center">askldwo</td>
            <td class="col-md-2 t-center"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="wrapper" id="new-address-toggle">
      <button class="btn btn-default" id="new-address-add" data-status="show">新增地址</button>
    </div>
  </div>
  <div class="padding-5">
  </div>
  <div class="gray-light edit-info" id="new-address-info">
    <form class="form-inline">
      <h4>使用新地址</h4>
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label">
            <span class="require">*</span>
            &nbsp;收&nbsp;货&nbsp;人&nbsp;&nbsp;
          </label>
          <input class="form-control" type="text" name="receiver">
        </div>
      </fieldset>
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label">
            <span class="require">*</span>
            收获地址&nbsp;
          </label>
          <input class="form-control" type="text" name="receiver">
        </div>
      </fieldset> 
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label">
            <span class="require">*</span>
            详细地址&nbsp;
          </label>
          <input class="form-control width-50" name="addr" id="addr" type="text" name="receiver">
        </div>
      </fieldset> 
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label">
            <span class="require">*</span>
            手机号码&nbsp;
          </label>
          <input class="form-control" type="text" name="receiver">
        </div>
        <div class="form-group">
          <label class="control-label">
            &nbsp;&nbsp;固定电话&nbsp;
          </label>
          <input class="form-control" type="text" name="receiver">
        </div>
      </fieldset> 
      <fieldset class="padding-5"> 
        <div class="form-group">
          <label class="control-label">
            <span class="require">*</span>
            &nbsp;邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱&nbsp;
          </label>
          <input class="form-control" type="text" name="receiver">
        </div>
      </fieldset> 
      <div class="form-group padding-5">
        <button class="btn btn-primary" role="button" type="submit">保存收货人信息</button>
      </div>
    </form>
  </div>
</div>
<p>优惠码</p>
<div class="box" id="quan">
  <div class="sub-wrapper">
    <p>请输入 优惠码 / 推荐码</p>
    <form class="form-inline">
      <div class="form-group padding-5">
        <label class="sr-only" for=""></label>
        <input type="text" name="youhui_1" id="youhui_1" class="form-control" placeholder="优惠码">
      </div>
      <div class="form-group padding-5">
        <label class="sr-only" for=""></label>
        <input type="text" name="youhui_2" id="youhui_2" class="form-control" placeholder="优惠码">
      </div>
      <div class="form-group padding-5">
        <label class="sr-only" for=""></label>
        <input type="text" name="youhui_3" id="youhui_3" class="form-control" placeholder="优惠码">
      </div>
    </form>
    <div class="alert alert-warning" role="alert">
        *每人每次最多限用3个优惠码，每个优惠码仅可使用一次！
    </div>
    <p>
      <button class="btn btn-info" id="quan-view"  role="button" data-status="show">查看可用优惠码</button>
    </p>
  </div>
  <div class="edit-info gray-light" id="quan-box">    
    <ul class="row quan-list">
      <li class="col-md-2" >
        <div class="quan-itm r-trans">
          <b class="q-price">--￥30 --</b>
          <b>YH12909123</b>
        </div>
      </li>
      <li class="col-md-2" >
        <div class="quan-itm r-trans">
          <b class="q-price">--￥30 --</b>
          <b>YH12909123</b>
        </div>
      </li>
      <li class="col-md-2" >
        <div class="quan-itm r-trans">
          <b class="q-price">--￥30 --</b>
          <b>YH12909123</b>
        </div>
      </li>
      <li class="col-md-2" >
        <div class="quan-itm r-trans">
          <b class="q-price">--￥30 --</b>
          <b>YH12909123</b>
        </div>
      </li>
      <li class="col-md-2" >
        <div class="quan-itm r-trans">
          <b class="q-price">--￥30 --</b>
          <b>YH12909123</b>
        </div>
      </li>
      <li class="col-md-2" >
        <div class="quan-itm r-trans">
          <b class="q-price">--￥30 --</b>
          <b>YH12909123</b>
        </div>
      </li>
    </ul>
  </div>
</div>
<p>备注</p>
<div class="well">
  <div class="row">
    <div class="col-md-7">
      <label class="sr-only">备注</label>
      <textarea class="form-control" name="comment" id="comment">
      </textarea>
    </div>
    <div class="col-md-5">
      如果您有任何特别要求，请在此告诉我们，51linpai团队将尽量满足您的一切合理要求。
    </div>
  </div>
</div>
<p>
  <div class="padding-20">
    <label  for="contract" class="checkbox">
      <input type="checkbox" id="contract">
      我已阅读且同意
      <a href="#">《51临牌商品购买协议》</a>
    </label>
  </div>
  <div class="col-md-3" id="next-step">
    <button class="btn btn-info btn-lg btn-group-justified" role="button">下一步</button>
  </div>
</p>
@endsection
