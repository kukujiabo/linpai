@extends('app')

@section('content')

<div class="top-50">
</div>
<div class="box" style="padding-top:0px;background:#fff;">
  <img src="/imgs/guide.jpg" style="width:100%">
  <div class="padding-20">
    <h3 class="text-center meta-font">车辆临时牌照办理指南</h3>
    <hr>
    <h4><b>在通过51临牌下单购买您爱车的临时牌照之前，您需要准备以下文档图片:</b></h4>
    <div class="padding-5">
      <p>
        <1> 车辆所属人身份证正面扫描件
      </p>
      <p>
        <2> 车辆所有人身份证反面扫描件
      </p>
      <p>
        <3> 机动车交通事故责任强制保险单扫描件<span class="theme-orig">（交强险副本扫描件）</span>
        <span class="glyphicon glyphicon-info-sign i-img meta-font" data-url="/imgs/notice/trans_ensurance.jpg" data-img="trans_ensurance" data-disclass="flow-img"></span>
      </p>
      <p>
        <4> 机动车销售统一发票扫描件<span class="theme-orig">（车辆购买发票）</span>
        <span class="glyphicon glyphicon-info-sign i-img meta-font" data-url="/imgs/notice/car_check.jpg" data-img="car_check" data-disclass="flow-img"></span>
      </p>
      <p>
        <5> 机动车整车出厂合格证扫描件<span class="theme-orig">（国产车辆合格证，仅需扫描带有二维码的详情页面）</span>
        <span class="glyphicon glyphicon-info-sign i-img meta-font" data-url="/imgs/notice/validate_paper.jpg" data-disclass="flow-img"></span>
      </p>
      <p>
        <6> 货物进口证明书扫描件<span class="theme-orig">（进口车辆海关关单）</span>
        <span class="glyphicon glyphicon-info-sign i-img meta-font" data-url="/imgs/notice/import_certify.jpg" data-disclass="flow-img" data-img="import_certify"></span>
      </p>
    </div>
  </div>
  <div class="padding-20">
    <h4><b>您的计算机中没有上述文件？</b></h4> 
    <div class="padding-5 meta-font">
      <h5>三种简单的方法来上传以上文档图片</h5>
    </div>
    <div class="padding-5 row text-align">
      <div class="col-md-1"></div>
      <div class="col-md-3 text-center padding-20 meta-info meta-font">
        <img src="/imgs/meta-phone.png"> 
        <h5>用您的手机拍照</h5>
        <p class="meta-content">
          手机通过电子邮件发送给自己，使用计算机登录并下载。
        </p>
      </div>
      <div class="col-md-3 text-center padding-20 meta-info meta-font">
        <img src="/imgs/meta-camera.png">
        <h5>使用您的相机</h5>
        <p class="meta-content">
          使用您的照相机拍照，然后传输计算机。
        </p>
      </div>
      <div class="col-md-3 text-center padding-20 meta-info meta-font">
        <img src="/imgs/meta-print.png">
        <h5>扫描文件</h5>
        <p class="meta-content">
          到影印店或使用您的扫描仪复制文件，以电子邮件将文件寄给自己并下载。
        </p>
      </div>
    </div>
  </div>
  <div class="padding-20">
  <hr>
    <p>
      如果以上方法仍无法解决您的问题
    </p>
    <p>
      欢迎给我们发送邮件到 service@51linpai.com 或于周一至周日10:00 － 18:00给我们来电<span style="color:#FF8800;"> <i><b>{{$company_phone}}</b></i></span>
    </p>
  </div>
</div>
<script type="text/javascript">
  window.onload = function () {$('body').css({background: "#eee"});};
</script>

@endsection
