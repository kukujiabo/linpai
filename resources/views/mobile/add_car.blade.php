@extends('mobile/mobile')

@include('mobile/head')

@section('content')
<div data-role="page">
  <div data-role="header">
    @yield('header')
  </div>
  <div data-role="content" style="padding-left:0px;padding-right:0px;">
    <div data-role="popup" data-position-to="window" id="info_popup" data-theme="b">
      <p id="popup_info" style="padding:10px;"></p>
    </div>
    <a href="#info_popup" id="trigger_popup" data-rel="popup"></a>
    <form data-role="none" action="/car/add" method="post" id="car_form">
      <input type="hidden" name="good_code" value="{{$good_code}}">
      <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
      <input type="hidden" name="car_hand" value="{{$car_hand}}">
      <fieldset>
        <div data-role="collapsible-set">
          <div data-role="collapsible" class="inner_white no-radius" data-collapsed-icon="edit" data-expanded-icon="carat-u" data-iconpos="right">
            <h1 style="font-weight:normal" class="no-shadow">所&nbsp;&nbsp;有&nbsp;&nbsp;人&nbsp;&nbsp;&nbsp;&nbsp;<span id="txt_owner"></span></h1>
            <p>
              <input type="text" name="owner" placeholder="请输入车主姓名">
            </p>
          </div>
          <div data-role="collapsible" class="inner_white" data-collapsed-icon="edit" data-expanded-icon="carat-u" data-iconpos="right">
            <h1 style="font-weight:normal" class="no-shadow">厂牌型号&nbsp;&nbsp;&nbsp;&nbsp;<span id="txt_factory_code"></span></h1> 
            <p>
              <input type="text" name="factory_code" placeholder="请输入车辆厂牌型号（例：宝马320i）">
            </p>
          </div>
          <div data-role="collapsible" class="inner_white" data-collapsed-icon="edit" data-expanded-icon="carat-u" data-iconpos="right">
            <h1 style="font-weight:normal" class="no-shadow">识别代码&nbsp;&nbsp;&nbsp;&nbsp;<span id="txt_reco_code"></span></h1> 
            <p>
              <input type="text" name="reco_code" placeholder="请输入车架号（例：WDDEJ6GB3EM099882）">
            </p>
          </div>
        </div>
      </fieldset>
      <fieldset style="margin-top:30px;" data-role="controlgroup">
        <label for="domestic" class="inner_white original no-radius" data-id="orig_dom">国产</label>
        <input type="radio" name="car_type" id="domestic" data-id="domestic" value="domestic" checked>
        <label for="imported" class="inner_white original no-radius" data-id="orig_imp">进口</label>
        <input type="radio" name="car_type" id="imported" data-id="imported" value="imported"> 
      </fieldset> 
      <fieldset style="margin-top:20px;">
        <ul data-role="listview">
        @foreach($attribs as $good_attrib)

          @if ($good_attrib['spec'] == 'file_upload')

            @if ($car_hand == 'one')

              @if ($good_attrib['code'] != 'driving_license')
                <li>
                  <div style="padding: 0px 15px;">
                    <input type="hidden" name="dir_{{$good_attrib['code']}}" value="" id="hint-{{$good_attrib['code']}}">
                    <label style="margin:0px;"  for="{{$good_attrib['code']}}">
                      @if ($good_attrib['code'] == 'validate_paper')
                        <div style="float:left;padding-top:5px;" id="name_validate_paper">{{$good_attrib['name']}}</div>
                      @else
                        <div style="float:left;padding-top:5px;">{{$good_attrib['name']}}</div>
                      @endif
                      <img src="/imgs/camera.png" id="upload-img-{{$good_attrib['code']}}" style="float:right;position:relative;height:30px;">
                      <div class="clear"></div>
                    </label>
                    <div style="display:none">
                      <input type="file" data-role="none" id="{{$good_attrib['code']}}" name="{{$good_attrib['code']}}" class="hide info-img" data-url="{{ asset('/uploads') }}" data-spec="{{$good_attrib['spec']}}" accept="image/*" >
                    </div>
                  </div>
                </li>
              @endif

            @else
              
              @if (
                $good_attrib['code'] == 'identity_face' || 
                $good_attrib['code'] == 'identity_back' ||
                $good_attrib['code'] == 'driving_license'
 
              )

                <li>
                  <div style="padding: 0px 15px;">
                    <input type="hidden" name="dir_{{$good_attrib['code']}}" value="" id="hint-{{$good_attrib['code']}}">
                    <label style="margin:0px;"  for="{{$good_attrib['code']}}">
                      <div style="float:left;padding-top:5px;" id="name_{{$good_attrib['code']}}">{{$good_attrib['name']}}</div>
                      <img id="upload-img-{{$good_attrib['code']}}" src="/imgs/camera.png" style="float:right;position:relative;height:30px;">
                      <div class="clear"></div>
                    </label>
                    <div style="display:none">
                      <!-- <input class="info-img"  type="file" style="display:none" name="identity_face" id="identity_face"> -->
                      <input type="file" id="{{$good_attrib['code']}}" name="{{$good_attrib['code']}}" class="hide info-img" data-url="{{ asset('/uploads') }}" data-spec="{{$good_attrib['spec']}}" accept="image/*">
                    </div>
                  </div>
                </li>
        
              @endif

            @endif

          @endif

        @endforeach
        </ul>
      </fieldset>
      <div class="ui-content" style="margin-top:30px;">
          <button class="blue_full_btn no-radius" type="submit" id="save_car" style="color:#d9534f" >保存</button>
      </div>
  </form>
<div data-role="popup" data-position-to="window" id="progress_pop" data-dismissible="false" style="padding:30px;"  data-overlay-theme="a">
  <p>
    上传中：<span id="progress">0</span>%
  <a href="#" data-rel="back" id="progress_end" style="display:none" class="hide ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right"></a>
  </p>
</div>
<a id="trigger_progress" data-rel="popup" href="#progress_pop" class="ui-btn hide" data-transition="slide"></a>
<script type="text/javascript">
  
  function uploadFileBind () {
  
    $('.info-img').each(function (i, t) {

      var that = $(this);

      var url = that.data('url');

      that.fileupload({

        autoUpload: true,

        url: url,

        sequentialUploads: true,

        dataType: 'json', 

        formData: {
        
          code: that.attr('name'),

          spec: that.data('spec'),

          _token: $('#_token').val()

        },

        add: function (e, data) {

          $('#trigger_progress').click();

          $('#progress').html('0');

          var files = that.prop('files');

          if (files.length > 1) {
          
            alert('只能选择一张图片上传，请重新选择！');

            return;
          
          }

          data.submit();
        
        }
      
      
      }).bind('fileuploadprogress', function (e, data) {

        var progress = parseInt(data.loaded / data.total * 100, 10);

        $('#progress').html(progress);
      
      }).bind('fileuploaddone', function (e, data) {

        $('#progress_end').click();

        if (data.result.code) {

          var res = data.result.res;

          $('#upload-img-' + that.attr('name')).attr("src", res.preview);

          $('#hint-' + that.attr('name')).val(res.tmpfile);

        } else if (typeof(data.result.msg) == 'string') {
          
          if (data.result.msg == 'size_exceed') {

            alert('上传图片大小不能超过3M！请重新上传');

          } else if (data.result.msg == 'empty_file') {

            alert('上传图片大小不能超过3M！请重新上传');

          }

        }
        
      });
    
    });
  
  }

  function formSubmit () {
  
    var form = $('#car_form');

    var subBtn = $('#save_car');

    form.ajaxForm();

    var options = {
    
      dataType : 'json',

      success: function (data) {

        if (data.code == 1) {
        
          alert('保存成功！');

          window.location.href="/miniorder/buy?car_hand={{$car_hand == 'one' ? 1 : 2}}";
        
        } else {
        
          var msg = data.msg;  

          var html = '';

          for(var k in msg) {
          
            html += '<p>' + msg[k] + '</p>';
         
          }

          $('#popup_info').html(html);

          $('#trigger_popup').click();
        
        }
      
      },

      error: function (err) {
      
        console.log(err);

      }
    
    };

    subBtn.on('tap', function (e) {
    
      e.preventDefault();
    
      form.ajaxSubmit(options);
    
    });

  }

  $(document).on('pagecreate', function ()  {

    var uploadBtn = $('a.file_upload');
     
    uploadBtn.on('tap', function (e) {

      var that = $(this);

      var target = that.data('target');

      var uploadInput = $('#' + target);

      console.log(uploadInput);

      uploadInput.click();
    
    });

    $('input[type=radio]').click(function (e) {

      var name = $('#name_validate_paper');

      var that = $(this);

      var id = that.data('id');

      if (that.data('id') == 'imported') {
      
        name.html('报关单扫描件');
      
      } else if(that.data('id') == 'domestic') {
      
        name.html('合格证扫描件');
      
      }
    
    });

    $('input[type=text]').change(function (e) {

      var value = $(this).val();

      var id = $(this).attr('name');
    
      $('#txt_' + id).html(value);
    
    });

    uploadFileBind();

    formSubmit();

  });

</script>
</div>
@endsection
