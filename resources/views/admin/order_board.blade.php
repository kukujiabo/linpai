@extends('admin/admin_index')

@include('pages_nav')

@section('content')

<div class="list-page"> 
  <div class="row">
    <div class="col-md-12">
       <div class="box board-search padding-5">
        <form class="form-inline" role="form" action="#" method="get">
          <div class="col-xs-11">
            <div class="form-group padding-5">
              <label class="control-label" for="order_code">订单号</label>
              &nbsp;&nbsp;<input type="text" name="order_code" class="form-control input-sm" value="{{$order_code}}">
            </div>
            <div class="form-group padding-5">
              <label class="control-label" for="receiver">收件人</label>
              &nbsp;&nbsp;<input type="text" name="receiver" class="form-control input-sm" value="{{$receiver}}">
            </div>
            <div class="form-group padding-5">
              <label class="control-label" for="mobile">手机号</label>
              &nbsp;&nbsp;<input type="text" name="mobile" class="form-control input-sm" value="{{$mobile}}">
            </div>
            <div class="form-group padding-5">
              <label class="control-label" for="order_status">状态</label>
              &nbsp;&nbsp;
              <select class="form-control input-sm" name="status" id="order_status">
                <option value="-1">全部</option>
                <option value="0">未付款</option>
                <option value="1">已付款</option>
                <option value="2">已发货</option>
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
      <div class="board-control">
        <table class="table table-hover table-striped" id="order_table"> 
          <thead class="tab_title">
            <tr class="text-center">
              <th class="col-xs-2">订单号</th>
              <th class="col-xs-1">收件人</th>
              <th class="col-xs-1">商品</th>
              <th class="col-xs-1">数量</th>
              <th class="col-xs-3">地址</th>
              <th class="col-xs-2">手机</th>
              <th class="col-xs-1">状态</th>
              <th class="col-xs-1">操作</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)        

            <tr class="text-center">
              <td class="col-xs-2">{{$order->order_code}}</td>
              <td class="col-xs-1">{{$order->receiver}}</td>
              <td class="col-xs-1 no-padding-both-side">
                <div class="over-elis" style="width:80px;" all="{{$order->good_name}}">{{$order->good_name}}</div>
              </td>
              <td class="col-xs-1">{{$order->num}}</td>
              <td class="col-xs-3 no-padding-both-side">
                <div class="over-elis" style="width:280px;" all="{{$order->province}}{{$order->city}}{{$order->district}}{{$order->address}}" >
                  {{$order->province}}{{$order->city}}{{$order->district}}{{$order->address}}
                </div>
              </td>
              <td class="col-xs-2">{{$order->mobile}}</td>
              <td class="col-xs-1">{{$order->status}}</td>
              <td class="col-xs-1">
                <a class="get_order_details" href="#" data-oid="{{$order->order_code}}" data-user="{{$order->uid}}" >
                  <span class="glyphicon glyphicon-zoom-in theme-orig"></span>
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
