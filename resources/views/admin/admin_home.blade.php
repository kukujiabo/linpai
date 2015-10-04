@extends('admin/admin_index')

@section('content')

  <div class="row padding-5">
    <div class="col-xs-6">
      <div class="data-panel">
        <div class="data-panel-head">
          <span class="glyphicon glyphicon-eye-open"></span>
           流量
        </div>
        <div class="data-panel-body">
          <ul class="no-padding-left">
            <li>pv:</li>
            <li>uv:</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-xs-6">
      <div class="data-panel">
        <div class="data-panel-head">
          <span class="glyphicon glyphicon-user"></span>
            用户
        </div>
        <div class="data-panel-body">
          <ul class="no-padding-left">
            <li>用户总数: </li>
            <li>当日注册:</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row padding-5">
    <div class="col-xs-6">
      <div class="data-panel">
        <div class="data-panel-head">
          <span class="glyphicon glyphicon-list-alt"></span>
          订单
        </div>
        <div class="data-panel-body">
          <ul class="no-padding-left">
            <li>订单总数:</li>
            <li>当日订单:</li>
          </ul>
        </div>
      </div>
    </div>
    <!--
    <div class="col-xs-6">
      <div class="data-panel">
        <div class="data-panel-head"></div>
      </div>
    </div>
    -->
  </div>
  

@endsection
