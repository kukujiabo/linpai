@extends('app')

@section('content')

<div class="row top-50" id="news_wrapper">
  <div class="col-xs-12 col-sm-12 col-md-9">
    <div class="row" style="border: 1px solid #eee">
      @yield('news_content')
    </div>
  </div>
  <div class="col-xs-9 col-md-3 col-sm-6 sidebar">
    <div class="row" style="border: 1px solid #eee">
      <div class="col-xs-12" id="new_cat_list">
        <div class="padding-5">
        </div>
        <div class="input-group padding-5">
          <input type="text" class="form-control" style="background:#eee" placeholder="">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </div>
        <div class="news_cats padding-5">
          <ul class="no-padding text-left">
            <li class="news_itm padding-5">
              <a href="/news/detail">2015上海外地车限行时间规定</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</div>
<script type="text/javascript">
  /*
  window.onload = function () {

    $('body').css({ 'background': '#eee' });

  };
   */
</script>

@endsection
