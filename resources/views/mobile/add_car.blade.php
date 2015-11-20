@extends('mobile/mobile')


@section('content')

<div data-role="page">
  <div data-role="header">
    <h1>车辆信息－51临牌</h1>
    <a href="#" class="ui-btn">返回</a>
  </div>
  <div data-role="content">
    <ul data-role="listview">
      <li data-icon="edit" data-iconpos="right"> 
        <a href="#">
          <h2>所有人</h2>
        </a>
      </li>
      <li data-icon="edit" data-iconpos="right"> 
        <a href="#">
          <h2>厂牌型号</h2>
        </a>
      </li>
      <li data-icon="edit" data-iconpos="right"> 
        <a href="#">
          <h2>车辆品牌</h2>
        </a>
      </li>
      <li data-icon="edit" data-iconpos="right">  
        <a href="#">
          <h2>识别代码</h2>
        </a>
      </li>
      <li data-icon="camera" data-iconpos="right">
        <a href="#" class="file_upload" data-target="identity_face">
          <h2>身份证正面的扫描</h2>
          <input type="file" data-role="none" id="identity_face" name="identity_face" accept="image/*" style="display:none">
        </a>
      </li>
      <li data-icon="camera" data-iconpos="right"> 
        <a href="#">
          <h2>身份证背面的扫描</h2>
        </a>
      </li>
      <li data-icon="camera" data-iconpos="right"> 
        <a href="#">
          <h2>交强险副本</h2>  
        </a>
      </li>
      <li data-icon="camera" data-iconpos="right"> 
        <a href="#">
          <h2>车辆购买发票</h2>  
        </a>
      </li>
      <li data-icon="camera" data-iconpos="right"> 
        <a href="#">
          <h2 id="validate_paper">合格证扫描件</h2>  
        </a>
      </li>
    </ul>
  </div>
  
  <div class="ui-content">
    <div class="ui-btn red_white_btn">
      <a href="#" style="color:#d9534f" >保存</a>
    </div>
  </div>
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
