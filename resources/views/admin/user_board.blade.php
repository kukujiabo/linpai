@extends('admin/admin_index')

@include('pages_nav')

@section('content')

<div class="list-page">
  <div class="row">
    <div class="col-md-12">
      <div class="box board-search padding-5">
        <form class="form-inline" id="user_board_form" role="form" action="#" method="get">
          <div class="col-xs-10">
            <div class="form-group padding-5">
              <label class="control-label" for="order_code">用户名</label>
              &nbsp;&nbsp;<input type="text" name="user_name" class="form-control input-sm" value="{{$user_name}}">
            </div>
            <div class="form-group padding-5">
              <label class="control-label" for="mobile">手机号</label>
              &nbsp;&nbsp;<input type="text" name="mobile" class="form-control input-sm" value="{{$mobile}}">
            </div>
            <div class="form-group padding-5">
              <label class="control-label" for="mail">邮箱</label>
              &nbsp;&nbsp;<input type="text" name="mail" class="form-control input-sm" value="{{$mail}}">
            </div>
          </div>
          <input type="hidden" name="excel" value="">
          <div class="col-xs-2">
            <div class="form-group padding-5">
              <button class="btn btn-primary btn-sm" id="query_user" type="submit">查询</button>
            </div>
            <div class="form-group padding-5">
              <a class="btn btn-default btn-sm" type="submit" id="download_excel">下载列表</a>
            </div>
          </div>
          <div style="clear:both"></div>
        </form>
      </div>
      <div class="board-control">
      <table class="table table-hover table-striped" id="user_table">
        <thead class="tab_title">
          <tr class="text-center">
            <th class="col-md-1">编号
              <a href="javascript:void(0);">
                <span class="caret"></span>
              </a>
            </th>
            <th class="col-md-2">用户名
              <a href="javascript:void(0);">
                <span class="caret"></span>
              </a>
            </th>
            <th class="col-md-2">手机号</th>
            <th class="col-md-4">邮箱</th>
            <th class="col-md-2">注册时间
              <a href="javascript:void(0);">
                <span class="caret"></span>
              </a>
            </th>
            <th class="col-md-1">操作</th>
          </tr>
        </thead>
        <tbody id="user_list">

          @foreach ($users as $user)

          <tr>
            <td class="col-md-1">{{$user->id}}</td>
            <td class="col-md-2">{{$user->name}}</td>
            <td class="col-md-2">{{$user->mobile}}</td>
            <td class="col-md-4">{{$user->email}}</td>
            <td class="col-md-2">{{$user->created_at}}</td>
            <td class="col-md-1">
              <a href="javasript:void(0);">
                <span class="glyphicon glyphicon-zoom-in"></span>
              </a>
                |
              <a href="javasript:void(0);">
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
  </div>
</div>

@endsection
