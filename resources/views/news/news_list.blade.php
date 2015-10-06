@extends('news/news')

@section('news_content')
<div class="col-xs-12"  id="new_content_list">
  <div class="padding-20 no-padding-left">
    <ul class="no-padding">
      <li class="row">
        <div class="col-xs-1" style="border-right:1px solid #eee;">
          <p class="no-margin">Sep</p>
          <p class="no-margin" style="font-size:24px;">24</p>
          <p class="no-margin">2015</p>
        </div>
        <div class="col-xs-11">
          <div class="col-xs-4">
            <img src="" width=100% height=120px>
          </div>
          <div class="col-xs-8" style="height:120px;">
            <div style="height:20%;">
              <h4 class="no-margin" style="color:#666">2015临牌新规定</h4>
            </div>
            <div style="height:50%;" class="over-elis">
              2015年
            </div>
            <a href="/news/detail" class="btn btn-default btn-sm" style="color:#ccc">查看详情</a>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div>
@endsection
