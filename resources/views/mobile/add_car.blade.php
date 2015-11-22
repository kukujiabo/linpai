@extends('mobile/mobile')


@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>车辆信息－51临牌</h1>
  </div>
  <div data-role="content" style="padding-left:0px;padding-right:0px;">
    <form data-role="none" action="#" method="post">
      <fieldset>
        <div data-role="collapsible-set">
          <div data-role="collapsible" class="inner_white no-radius" data-collapsed-icon="edit" data-expanded-icon="carat-u" data-iconpos="right">
            <h1 style="font-weight:normal">所有人</h1>
            <p>
              <input type="text" name="owner" placeholder="请输入车主姓名">
            </p>
          </div>
          <div data-role="collapsible" class="inner_white" data-collapsed-icon="edit" data-expanded-icon="carat-u" data-iconpos="right">
            <h1 style="font-weight:normal">产牌型号</h1> 
            <p>
              <input type="text" name="factory_code" placeholder="请输入车辆厂牌型号">
            </p>
          </div>
          <div data-role="collapsible" class="inner_white" data-collapsed-icon="edit" data-expanded-icon="carat-u" data-iconpos="right">
            <h1 style="font-weight:normal">识别代码</h1> 
            <p>
              <input type="text" name="reco_code" placeholder="请输入车辆识别代码">
            </p>
          </div>
        </div>
      </fieldset>
      <fieldset style="margin-top:20px;">
        <ul data-role="listview">
          <li>
            <div style="padding: 0px 15px;">
              <label style="margin:0px;"  for="identity_face">
                <div style="float:left;padding-top:5px;">身份证正面照</div>
                <img src="/imgs/camera.png" style="float:right;position:relative;width:30px;">
                <div class="clear"></div>
              </label>
              <div style="display:none">
                <input  type="file" style="display:none" name="identity_face" id="identity_face">
              </div>
            </div>
          </li>
          <li style="">
            <div style="padding: 0px 15px;">
              <label style="margin:0px;"  id="man" for="identity_back">
                <div style="float:left;padding-top:5px;">身份证背面照</div>
                <img src="/imgs/camera.png" style="float:right;position:relative;width:30px;">
                <div class="clear"></div>
              </label>
              <div style="display:none">
                <input  type="file"  name="identity_face" id="identity_back">
              </div>
              </a>
            </div>
          </li>
          <li>
            <div style="padding: 0px 15px;">
              <label style="margin:0px;" for="dir_trans_ensurance">
                <div style="float:left;padding-top:5px;">交强险副本件</div>
                <img src="/imgs/camera.png" style="float:right;position:relative;width:30px;">
                <div class="clear"></div>
              </label>
              <div style="display:none">
                <input  type="file" style="display:none" name="dir_trans_ensurance" id="dir_trans_ensurance">
              </div>
            </div>
          </li>
          <li>
            <div style="padding: 0px 15px;">
              <label style="margin:0px;" for="car_check">
                <div style="float:left;padding-top:5px;">购买车辆发票</div>
                <img src="/imgs/camera.png" style="float:right;position:relative;width:30px;">
                <div class="clear"></div>
              </label>
              <div style="display:none">
                <input  type="file" style="display:none" name="car_check" id="car_check">
              </div>
            </div>
          </li>
          <li>
            <div style="padding: 0px 15px;">
              <label style="margin:0px;" for="validate_paper">
                <div style="float:left;padding-top:5px;">合格证发票</div>
                <img src="/imgs/camera.png" style="float:right;position:relative;width:30px;">
                <div class="clear"></div>
              </label>
              <div style="display:none">
                <input  type="file" style="display:none" name="validate_paper" id="validate_paper">
              </div>
            </div>
          </li>
        </ul>
      </fieldset>
      <div class="ui-content" style="margin-top:40px;">
          <button class="blue_full_btn no-radius" type="submit" style="color:#d9534f" >保存</button>
      </div>
  </form>
</div>

<script type="text/javascript">
  
  $(document).on('pageinit', function ()  {

    var uploadBtn = $('a.file_upload');
     
    uploadBtn.on('tap', function (e) {

      var that = $(this);

      var target = that.data('target');

      var uploadInput = $('#' + target);

      console.log(uploadInput);

      uploadInput.click();
    
    });

  });

</script>
@endsection
