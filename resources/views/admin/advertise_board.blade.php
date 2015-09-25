@extends('admin/admin_index')

@include('upload_box')

@include('pages_nav')

@include('admin/new_ad')

@section('content')

<div class="list-page">
  <div class="box board-search padding-5">
    <form class="form-inline" role="form" action="#" method="get">
      <div class="col-xs-11">
        <div class="form-group padding-5">
          <label class="control-label" for="receiver">代号</label>
          &nbsp;&nbsp;<input type="text" name="receiver" class="form-control input-sm" value="">
        </div>
        <div class="form-group padding-5">
          <label class="control-label" for="order_code">类型</label>
          &nbsp;&nbsp;
          <select class="form-control input-sm" name="a_type" id="order_status">
            <option value="-1">全部</option>
            <option value="1">首页横幅</option>
            <option value="2">---</option>
          </select>
        </div>
        <div class="form-group padding-5">
          <label class="control-label" for="order_status">状态</label>
          &nbsp;&nbsp;
          <select class="form-control input-sm" name="status" id="order_status">
            <option value="0">启用</option>
            <option value="1">停用</option>
          </select>
        </div>
      </div>
      <div class="col-xs-1">
        <div class="form-group padding-5">
          <button class="btn btn-primary btn-sm" type="submit">查询</button>
        </div>
      </div>
      <div style="clear:both"></div>
    </form>
  </div>
  <div class="row padding-5">
    <div class="col-xs-1">
      <button class="btn btn-default btn-sm">新增图片</button>
    </div>
    <div class="col-xs-1">
      <button class="btn btn-default btn-sm">新增类型</button>
    </div>
  </div>
  <div class="board-control">
    <table class="table table-hover table-stripped" id="table-ad">
      <thead class="tab_title">
        <tr class="text-center">
          <th class="col-xs-2"> 图片</th>
          <th class="col-xs-3"> 图片链接</th>
          <th class="col-xs-2"> 图片类型</th>
          <th class="col-xs-2"> 图片代码</th>
          <th class="col-xs-1"> 序号</th>
          <th class="col-xs-2"> 操作</th>
        </tr>
      </thead>  
      <tbody>
        @foreach ($ads as $ad) 

          <tr>
            <td>
              @if (empty($ad->url))
                没有图片
              @else
                <img class="board-img" src="{{$ad->url}}">
              @endif
            </td>
            <td>{{$ad->url}}</td>
            <td>{{$ad->type}}</td>
            <td>{{$ad->code}}</td>
            <td>{{$ad->seq}}</td>
            <td>
              <a href="#" class="board_img_uploads" data-code="{{$ad->code}}" data-url="{{$ad->url}}">
                <span class="glyphicon glyphicon-upload"></span>
              </a>
              &nbsp;|&nbsp;
              <a href="#" class="board_img_remove" data-code="{{$ad->code}}">
                <span class="glyphicon glyphicon-remove"></span>
              </a>
            </td>
          </tr>

        @endforeach
      </tbody>
    </table>
  </div>
  <div class="padding-5 text-center">
    @yield('page_nav')
  </div>
</div>
<div>
  @yield('new_ad')
</div>

<div>
  @yield('upload_box')
</div>

@endsection
