@extends('admin/admin_index')

@include('pages_nav')

@include('area_select')

@section('content')

<div class="list-page">
  <div class="row">
    <div class="box board-search padding-5">
      <form class="form-inline query_form" role="form" action="#" method="get">
        <div class="col-xs-10">
          <div class="padding-5">
            @yield('area')
          </div>
        </div>
        <input type="hidden" name="province" id="post-province">
        <input type="hidden" name="city" id="post-city">
        <input type="hidden" name="district" id="post-district">
        <input type="hidden" name="excel" value="">
        <div class="col-xs-2">
          <div class="form-group padding-5">
            <button class="btn btn-primary btn-sm board_query" type="submit">查询</button>
          </div>
          <div class="form-group padding-5">
            <button class="btn btn-default btn-sm excel_download" type="submit">下载列表</button>
          </div>
        </div>
        <div style="clear:both"></div>
      </form>
    </div>
    <div class="board-control">
      <table class="table table-hover table-stripped" id="cooper-board">
        <thead>
          <tr>
            <th>联系人</th>
            <th>提交时间</th>
            <th>手机号码</th>
            <th>固定电话</th>
            <th style="text-align:left">所属区域</th>
            <th style="text-align:left">电子邮箱</th>
            <th style="text-align:left">操作</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($cooperators as $cooper)

            <tr id="info_{{$cooper->id}}">
              <td data-target="d_contact">{{$cooper->contact}}</td>
              <td data-target="d_created_at">{{$cooper->created_at}}</td>
              <td data-target="d_mobile">{{$cooper->mobile}}</td>
              <td data-target="d_phone">{{$cooper->telephone}}</td>
              <td data-target="d_address" style="text-align:left">{{$cooper->province}}&nbsp;{{$cooper->city}}&nbsp;{{$cooper->district}}</td>
              <td data-target="d_email" style="text-align:left">{{$cooper->email}}</td>
              <td style="text-align:left">
                <a href="#" class="detail_tag" data-target="info_{{$cooper->id}}" data-id="{{$cooper->id}}" style="text-decoration:none">详情</a>
              </td>
            </tr>

          @endforeach

        </tbody>
      </table>
      <div class="padding text-center">

        @yield('page-nav')

      </div>
    </div>
  </div>
</div>
<div class="coop_panel hide">
  <a href="#" id="op_remove" style="position:absolute;top:3%;left:97%;z-index:10005"><span class="glyphicon glyphicon-remove"></span></a>
  <h3>合作伙伴详情</h3>
  <hr>
  <div class="row" style="margin-top:30px;">
    <div class="col-sm-3">
      联系人：<span id="d_contact">{{$cooper->contact}}</span>
    </div>
    <div class="col-sm-3">
      手机号：<span id="d_mobile">{{$cooper->mobile}}</span>
    </div>
    <div class="col-sm-3">
      电话：<span id="d_phone">{{$cooper->mobile}}</span>
    </div>
  </div>
  <div class="row" style="margin-top:30px;">
    <div class="col-sm-4">
      提交时间：<span id="d_created_at">{{$cooper->created_at}}</span>
    </div>
    <div class="col-sm-5">
      电子邮箱：<span id="d_email">{{$cooper->email}}</span>
    </div>
  </div>
  <div class="row" style="margin-top:30px">
    <div class="col-sm-6">
      所属区域：<span id="d_address">{{$cooper->province}}{{$cooper->city}}{{$cooper->district}}</span>
    </div>
  </div>
  <div class="row" style="margin-top:30px">
    <div class="col-sm-10">
      业务介绍：<span id="d_business">{{$cooper->business}}</span>
    </div>
  </div>
</div>

@endsection
