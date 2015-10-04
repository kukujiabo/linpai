@extends('app')

@section('content')

<div class="row top-50" id="news_wrapper">
  <div class="col-xs-12 col-sm-12 col-md-9">
    <div class="row">
      <div class="col-xs-12"  id="new_content_list">
      </div>
    </div>
  </div>
  <div class="col-xs-9 col-md-3 col-sm-6 sidebar">
    <div class="row">
      <div class="col-xs-12" id="new_cat_list">
        <h4 class="page-header">最新文章</h4>
        <div class="news_cats">
          <ul class="no-padding text-left">
            <li>新车拍照规定</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</div>
<script type="text/javascript">
  window.onload = function () {

    $('body').css({ 'background': '#eee' });

  };
</script>

@endsection
