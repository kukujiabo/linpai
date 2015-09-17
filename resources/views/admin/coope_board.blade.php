@extends('admin/admin_index')

@include('pages_nav')

@include('area_select')

@section('content')

<div class="list-page">
  <div class="row">
    <div class="box board-search padding-5">
      <form class="form-inline" role="form" action="#" method="get">
        <div class="col-xs-11">
          <div class="padding-5">
              @yield('area')
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
    <div class="board-control">
      <table class="table table-hover table-stripped" id="cooper-board">
        <thead>
          <tr>
            <th>联系人</th>
            <th>公司</th>
            <th>手机号码</th>
            <th>固定电话</th>
            <th>所属区域</th>
            <th>电子邮箱</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($cooperators as $cooper)

            <tr>
              <td>{{$cooper->contact}}</td>
              <td>{{$cooper->company}}</td>
              <td>{{$cooper->mobile}}</td>
              <td>{{$cooper->telephone}}</td>
              <td>{{$cooper->province}}&nbsp;{{$cooper->city}}&nbsp;{{$cooper->district}}</td>
              <td>{{$cooper->email}}</td>
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

@endsection
