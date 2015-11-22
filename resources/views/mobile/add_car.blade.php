@extends('mobile/mobile')


@section('content')
<div data-role="page">
  <div data-role="header">
    <h1>车辆信息－51临牌</h1>
  </div>
  <div data-role="content" style="padding-left:0px;padding-right:0px;">
    <div data-role="popup" id="info_popup" data-theme="b">
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
        @foreach($attribs as $good_attrib)

          @if ($good_attrib['spec'] == 'file_upload')

            @if ($car_hand == 'one')

              @if ($good_attrib['code'] != 'driving_license')
                <li>
                  <div style="padding: 0px 15px;">
                    <input type="hidden" name="dir_{{$good_attrib['code']}}" value="" id="hint-{{$good_attrib['code']}}">
                    <label style="margin:0px;"  for="{{$good_attrib['code']}}">
                      <div style="float:left;padding-top:5px;">{{$good_attrib['name']}}</div>
                      <img src="/imgs/camera.png" id="upload-img-{{$good_attrib['code']}}" style="float:right;position:relative;height:30px;">
                      <div class="clear"></div>
                    </label>
                    <div style="display:none">
                      <!-- <input class="info-img"  type="file" style="display:none" name="identity_face" id="identity_face"> -->
                      <input type="file" id="{{$good_attrib['code']}}" name="{{$good_attrib['code']}}" class="hide info-img" data-url="{{ asset('/uploads') }}" data-spec="{{$good_attrib['spec']}}" accept="image/*" multiple >
                    </div>
                  </div>
                </li>
              @endif

            @else
              
              @if (
                $good_attrib['code'] == 'identity_face' || 
                $good_attrib['code'] == 'identity_back' ||
                $good_attrib['code'] == 'dirving_license'
              )

                <li>
                  <div style="padding: 0px 15px;">
                    <input type="hidden" name="dir_{{$good_attrib['code']}}" value="" id="hint-{{$good_attrib['code']}}">
                    <label style="margin:0px;"  for="{{$good_attrib['code']}}">
                      <div style="float:left;padding-top:5px;">{{$good_attrib['name']}}</div>
                      <img id="upload-img-{{$good_attrib['code']}}" src="/imgs/camera.png" style="float:right;position:relative;width:30px;">
                      <div class="clear"></div>
                    </label>
                    <div style="display:none">
                      <!-- <input class="info-img"  type="file" style="display:none" name="identity_face" id="identity_face"> -->
                      <input type="file" id="{{$good_attrib['code']}}" name="{{$good_attrib['code']}}" class="hide info-img" data-url="{{ asset('/uploads') }}" data-spec="{{$good_attrib['spec']}}" accept="image/*" multiple >
                    </div>
                  </div>
                </li>
        
              @endif

            @endif

          @endif

        @endforeach
        </ul>
      </fieldset>
      <fieldset style="margin-top:30px;" data-role="controlgroup">
        <label for="domestic" class="inner_white">国产</label>
        <input type="radio" name="car_type" id="domestic" value="domestic" checked>
        <label for="imported" class="inner_white">进口</label>
        <input type="radio" name="car_type" id="imported" value="imported"> 
      </fieldset> 
      <div class="ui-content" style="margin-top:30px;">
          <button class="blue_full_btn no-radius" type="submit" id="save_car" style="color:#d9534f" >保存</button>
      </div>
  </form>
</div>

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

          data.submit();
        
        }
      
      }).bind('fileuploaddone', function (e, data) {

        if (data.result.code) {

          console.log(data);

          var res = data.result.res;

          $('#upload-img-' + that.attr('name')).attr("src", res.preview);

          $('#hint-' + that.attr('name')).val(res.tmpfile);

        } else if (typeof(data.result.msg) == 'string') {
          
          if (data.result.msg == 'size_exceed') {

            alert('上传图片大小不能超过3M！请重新上传');

          } else if (data.result.msg == 'empty_file') {

            alert('上传图片无效，请重新上传');

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

          history.back();
        
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

  $(document).on('pageinit', function ()  {

    var uploadBtn = $('a.file_upload');
     
    uploadBtn.on('tap', function (e) {

      var that = $(this);

      var target = that.data('target');

      var uploadInput = $('#' + target);

      console.log(uploadInput);

      uploadInput.click();
    
    });

    uploadFileBind();

    formSubmit();

  });

</script>
@endsection
