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
              <label class="control-label" for="mobile">下单账号</label>
              &nbsp;&nbsp;<input type="text" name="mobile" class="form-control input-sm" value="{{$mobile}}">
            </div>
            <div class="form-group padding-5">
              <label class="control-label" for="order_status">状态</label>
              &nbsp;&nbsp;
              <select class="form-control input-sm" name="status" id="order_status" >
                @if ($status == '-1')
                  <option value="-1" selected>全部</option>
                  <option value="0">未付款</option>
                  <option value="1">已付款</option>
                  <option value="2">已发货</option>
                @elseif ($status == '0')
                  <option value="-1">全部</option>
                  <option value="0" selected>未付款</option>
                  <option value="1">已付款</option>
                  <option value="2">已发货</option>
                @elseif ($status == '1')
                  <option value="-1">全部</option>
                  <option value="0">未付款</option>
                  <option value="1" selected>已付款</option>
                  <option value="2">已发货</option>
                @elseif ($status == '2')
                  <option value="-1">全部</option>
                  <option value="0">未付款</option>
                  <option value="1">已付款</option>
                  <option value="2" selected>已发货</option>
                @else
                  <option value="-1">全部</option>
                  <option value="0">未付款</option>
                  <option value="1">已付款</option>
                  <option value="2">已发货</option>
                @endif
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
              <th class="col-xs-1">下单时间</th>
              <th class="col-xs-2">下单账号</th>
              <th class="col-xs-2">收件人</th>
              <th class="col-xs-1">商品名称</th>
              <th class="col-xs-2">车辆所有人</th>
              <th class="col-xs-1">状态</th>
              <th class="col-xs-1">操作</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)        
            <tr class="text-center">
              <td class="col-xs-2">{{$order->order_code}}</td>
              <td class="col-xs-1">{{$order->created_at}}</td>
              <td class="col-xs-2 no-padding-both-side">
                <div class="over-elis"  all="{{$order->good_name}}">{{$order->order_owner_mobile}}</div>
              </td>
              <td class="col-xs-2">{{$order->receiver}}</td>
              <td class="col-xs-1 no-padding-both-side">
                <div class="over-elis" all="{{$order->province}}{{$order->city}}{{$order->district}}{{$order->address}}" >
                  {{$order->good_name}}
                </div>
              </td>
              <td class="col-xs-2">{{$order->car_owner}}</td>
              <td class="col-xs-1">
                @if ($order->status == 0)
                未付款
                @elseif ($order->status == 1)
                已付款
                @elseif ($order->status == 2)
                已发货
                @elseif ($order->status == 3)
                已签收
                @endif 
              </td>
              <td class="col-xs-1">
                <a class="get_order_details" href="#" data-oid="{{$order->order_code}}" data-user="{{$order->uid}}" >
                  <span class="glyphicon glyphicon-zoom-in theme-orig"></span>
                </a>
                |
                <a class="download_pdf" href="/orderboard/orderpdf?order_code={{$order->order_code}}" target="_blank" data-oid="{{$order->order_code}}">
                  <span class="glyphicon glyphicon-download theme-orig"></span>
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
