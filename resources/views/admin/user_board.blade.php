@extends('admin/admin_index')

@section('content')

<div class="list-page">
  <div class="row">
    <div class="col-md-10">
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
          <tr>
            <td class="col-md-1">1</td>
            <td class="col-md-2">Meroc</td>
            <td class="col-md-2">15201932985</td>
            <td class="col-md-4">kukujiabo@163.com</td>
            <td class="col-md-2">2015-06-07</td>
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
          <tr>
            <td class="col-md-1">2</td>
            <td class="col-md-2">Ryan</td>
            <td class="col-md-2">15201932985</td>
            <td class="col-md-4">ryan@163.com</td>
            <td class="col-md-2">2014-07-09</td>
            <td class="col-md-1">
              <a href="#">
                <span class="glyphicon glyphicon-zoom-in"></span>
              </a>
                |
              <a href="#">
                <span class="glyphicon glyphicon-remove"></span>
              </a>
            </td>
          </tr> 
        </tbody>
      </table>
    </div>
    <div class="col-md-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          筛选    
        </div>
        <div class="panel-body">
           
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
