@section('upload_box')
<div class="hide" id="upload_box">
  <div class="over-all">
  </div>
  <div id="upload-box">
    <div id="upload_preview" class="padding-5">
      <img id="u_p_img" src="" width="100%" height="100%">
    </div>
    <div class="padding-5">
      <div class="progress progress-striped progress-sm" role="progressbar">
        <div class="progress-bar progress-bar-info" id="">
        </div>
      </div> 
    </div>
    <div class="padding-5">
      <form class="form">
        <a class="btn btn-default btn-sm no-padding">
          <label class="h-cursor no-margin" style="padding:5px" for="board_upload">选择图片</label>
        </a>
        <input type="file" id="board_upload" name="board_img" class="hide info-img" data-url="{{ asset('/uploads') }}" data-type="" accept="image/*" multiple >
      </form>
    </div>
  </div>
</div>

@endsection
