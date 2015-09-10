@section('edit_car')
  <div class="edit-info" id="car-info-edit">
    <h4 id="c-i-tit">使用新车</h4>
    <div class="padding-5">
      <div class="alert alert-danger hide" id="carinfo-error">
      </div>
    </div>
    <form class="form-inline" method="post" id="new-car-form" action="{{asset('car/add')}}" data-addurl="{{asset('car/add')}}" data-editurl="{{asset('car/edit')}}" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="cid" value="">
      <fieldset>
        <div class="form-group col-md-6">
            <label for="owner-info" class="control-label col-md-5">
              <span class="require">*</span>
              车辆所有人信息
            </label>
            <input type="text" class="form-control col-md-5" name="owner" placeholder="" id="owner-info">
        </div>
        <div class="form-group col-md-6">
            <label for="v-brand" class="control-label col-md-5">
              <span class="require">*</span>
              车辆品牌
            </label>
            <input type="text" class="form-control col-md-5" name="brand" placeholder="" id="v-brand">
        </div>
      </fieldset>
      <br>
      <fieldset>
        <div class="form-group col-md-6">
            <label for="v-brand" class="col-md-5 control-label ">
              <span class="require">*</span>
              车辆厂牌型号 
            </label>
            <input type="text" class="form-control col-md-5" name="factory_code" placeholder="" id="v-factory">
            <div class="col-md-1 padding-5">
              <span class="glyphicon glyphicon-info-sign i-c-img theme-font-blue" data-disclass="flow-img" id="fac-t-img"></span>
            </div>
        </div>
        <div class="form-group col-md-6">
          <label for="v-brand" class="control-label col-md-5" >
            <span class="require">*</span>
            识别号码（车架号）
          </label>
          <input type="text" name="reco_code" class="form-control col-md-5" placeholder="" id="v-factory">
          <div class="col-md-1 padding-5">
            <span class="glyphicon glyphicon-info-sign i-c-img theme-font-blue" data-disclass="flow-img" id="reco-t-img"></span>
          </div>
        </div>
      </fieldset>
      <br>
      <fieldset>
        <div class="form-group col-md-6">
            <label for="v-brand" class="col-md-5 control-label ">
              <span class="require">*</span>
              车辆类型
            </label>
            <div class="col-md-3">
              <label class="radio" for="domestic">国产车</label>&nbsp;&nbsp;
              <input type="radio" class="car_type" name="car_type" id="domestic" value="domestic" checked>
            </div>
            <div class="col-md-3">
              <label class="radio" for="imported">进口车</label>&nbsp;&nbsp;
              <input type="radio" class="car_type" name="car_type" id="imported" value="imported">
            </div>
        </div>
      </fieldset>
      <br>
      <fieldset>
        <div class="form-group col-md-12">
          <p class="col-md-12" style="margin: 20px 0px;">
            <span class="require">*</span>
            车辆相关文件（请上传大小小于 <span class="require">3M</span> 的附件）
          </p>
        </div>
      </fieldset>
      <div class="sub-wrapper">
        <div class="row">
          <div class="col-md-1">
            <input type="hidden" id="_token" value="{{csrf_token()}}">
          </div>
          @foreach ($good_attribs as $good_attrib) 
  
            @if ($good_attrib['spec'] == 'file_upload')

            <div class="col-md-2">
              <div style="padding-5">
                <div class="thumbnail">
                  <img class="upload-img" target="dir_{{$good_attrib['code']}}" id="upload-img-{{$good_attrib['code']}}" src="" alt="" style="width:100%;height:110px;">
                  <input type="hidden" name="dir_{{$good_attrib['code']}}" id="hint-{{$good_attrib['code']}}" value="">
                  <div class="caption" align="center">
                    <div class="progress progress-striped progress-sm" role="progressbar">
                      <div class="progress-bar progress-bar-info" id="progress_bar_{{$good_attrib['code']}}">
                      </div>
                    </div> 
                        <a class="btn btn-default btn-sm no-padding">
                         <label class="h-cursor no-margin" style="padding:5px" for="{{$good_attrib['code']}}">选择图片</label>
                        </a>
                        <input type="file" id="{{$good_attrib['code']}}" name="{{$good_attrib['code']}}" class="hide info-img" data-url="{{ asset('/uploads') }}" data-spec="{{$good_attrib['spec']}}" accept="image/*" multiple >
                    <div style="position:absolute;right:10px;buttom:5px;">
                        <span class="glyphicon glyphicon-info-sign i-c-img theme-font-blue" data-img="{{$good_attrib['code']}}"></span>
                    </div>
                  </div>
                </div>
              </div>
              <p class="text-center" filename="{{$good_attrib['code']}}">{{ $good_attrib['name']}}</p>
            </div>

            @endif

          @endforeach    

          <div class="col-md-1">
          </div>
        </div>        
      </div>
      <div class="padding-5"></div>
      <div class="form-group sub-wrapper">
        <button type="submit" role="button" class="btn btn-primary" id="new-car-submit">保存车辆信息</button>
      </div>
    </form> 
  </div>


@endsection
