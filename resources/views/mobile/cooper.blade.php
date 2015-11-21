@extends('mobile/mobile')

@include('mobile/mobile_area_select')

@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>成为供应商</h1>
  </div>
    <div class="ui-content blue_back">
      <div style="float:left;padding:15px 5px;width:15%;">
        <img src="/imgs/logo-linpai.png" style="width:60px;">
      </div>
      <p style="float:left;margin:0px;padding:10px;font-size:12px;width:72%;text-shadow:none;color:white">我们欢迎全国各地的临时牌照服务商（全国车管所均可）加入我们的平台，享受［51临牌］带来的服务和佣金以及完善的保障</p>
      <div class="clear"></div>
    </div>
  <div data-role="content">
    <div class="ui-content" data-role="popup" data-position-to="window" id="info_popup">
      <p id="alert_content"></p>
    </div>
    <a href="#info_popup" data-rel="popup" id="trig_info"></a>
    <p>请填写以下信息</p>
    <p style="color:#138ed1">（我们的工作人员会在2个工作日内与您取得联系）</p>
  </div>
  <form id="coop_form" data-role="none" action="/communitcate/addcooperator" method="post">
  <input type="hidden" value="{{csrf_token()}}" name="_token">
  <div data-role="collapsible-set">
      <div data-role="collapsible" style="border-radius:0px;" data-iconpos="right" data-icon="carat-d">
        <h4>联系人：<span id="txt_contact"></span></h4>
        <p> 
          <input type="text" name="contact" placeholder="请填写您的姓名" data-desc="联系人">
        </p>
      </div>
      <div data-role="collapsible" data-iconpos="right" data-icon="carat-d">
        <h4>公&nbsp;&nbsp;&nbsp;司：<span id="company"></span></h4>
        <p> 
          <input type="text" name="company" placeholder="请填写单位名称（非必填）">
        </p>
      </div>
      <div data-role="collapsible" data-iconpos="right" data-icon="carat-d">
        <h4>手机号码：<span id="txt_mobile"></span></h4>
        <p> 
          <input type="text" name="mobile" class="" placeholder="请填写11位有效手机号" data-desc="手机号">
        </p>
      </div>
      <div data-role="collapsible" data-iconpos="right" data-icon="carat-d">
        <h4>固定电话：<span id="txt_telephone"></span></h4>
        <p> 
          <input type="text" name="telephone" placeholder="eg: 021-55356175">
        </p>
      </div>
      <div data-role="collapsible"  data-iconpos="right" data-icon="carat-d">
        <h4>所属区域：
          <span id="txt_province"></span>
          <span id="txt_city"></span>
          <span id="txt_district"></span>
        </h4>
        <p> 
        <!--
          <input type="text" name="area" placeholder="eg: 上海市－黄浦区">
        -->
        </p>
        <input type="text" name="province" id="province" placeholder="省份" data-desc="省份">
        <input type="text" name="city" id="city" placeholder="城市" data-desc="城市">
        <input type="text" name="district" id="district" placeholder="区域" data-desc="区域">
      </div>
      <div data-role="collapsible"  data-iconpos="right" data-icon="carat-d">
        <h4>电子邮箱：<span id="txt_email"></span></h4>
        <p> 
          <input type="text" name="email" placeholder="请填写您的电子邮件" data-desc="电子邮件">
        </p>
      </div>
      <div data-role="collapsible" style="border-radius:0px;"  data-iconpos="right" data-icon="carat-d">
        <h4>业务介绍：<span id="txt_business"></span></h4>
        <p> 
          <textarea type="text" name="business" placeholder="请简单介绍一下您的业务"></textarea>
        </p>
      </li>
  </div>  
  <div class="ui-content" style="padding:30px 15%;">
    <div class="ui-btn blue_full_btn">
      <a href="#" type="submit" id="submit_btn" class="blue_full_btn">提交信息</a>
    </div>
  </div>
  </form>
</div>
<script type="text/javascript">
  
  var cform = $('#coop_form');

  var submitBtn = $('#submit_btn');

  cform.ajaxForm();

  var options = {
  
    dataType: 'json',

    success: function (data) {

      if (data.code == 1) {
      
        $('input[type=text]').val('');

        $('textarea').val('');

        $('#alert_content').html('您已成功提交信息，我们将尽快联系您！');

        $('#trig_info').click();
      
      } else {
      
        var arr  = data.msg;

        var info = '';

        for (var i = 0; i < arr.length; i++) {
        
          var key = arr[i];

          var value = $('input[name=' + key + ']').data('desc');
          
          info += '<p>' + value + '必须填写' + '</p>';
        
        }

        console.log(info);

        $('#alert_content').html(info);

        $('#trig_info').click();
      }
    
    }, 

    error: function (err) {
    
      console.log(err);
    
    }
  
  };

  submitBtn.on('tap', function (e) {
  
    e.preventDefault();

    cform.ajaxSubmit(options);
  
  });

  $('input[type=text]').change(function () {
  
    var that = $(this);

    var name = that.attr('name');

    $('span#txt_' + name).html(that.val());
  
  });

</script>

@endsection
