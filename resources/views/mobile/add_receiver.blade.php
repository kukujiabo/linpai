@extends('mobile/mobile')

@include('mobile/head')

@section('content')

<div data-role="page">
  <div data-role="header">
    @yield('header') 
  </div>
  <div data-role="content" style="padding-left:0;padding-right:0">
    <form data-role="none" action="/receiver/add" method="post" id="receiver_form">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <fieldset>
        <div data-role="collapsible-set">
          <div data-role="collapsible" class="inner_white no-radius" data-collapsed-icon="edit" data-expanded-icon="carat-u" data-iconpos="right">
            <h1 class="no-shadow" style="font-weight:normal">收&nbsp;&nbsp;货&nbsp;&nbsp;人：<span id="receiver_txt"></span></h1>
            <p>
              <input type="text" name="receiver" placeholder="请输入收货人姓名">
            </p>
          </div>
          <div data-role="collapsible" class="inner_white" data-collapsed-icon="edit" data-expanded-icon="carat-u" data-iconpos="right">
            <h1 class="no-shadow"  style="font-weight:normal">收货地址：<span id="address_txt"></span></h1> 
            <p>
              <input type="text" name="province" placeholder="请输入所在省份">
              <input type="text" name="city" placeholder="请输入所在城市">
              <input type="text" name="district" placeholder="请输入所在行政区">
              <input type="text" name="address" placeholder="请输入收货地址">
            </p>
          </div>
          <div data-role="collapsible" class="inner_white" data-collapsed-icon="edit" data-expanded-icon="carat-u" data-iconpos="right">
            <h1 class="no-shadow"  style="font-weight:normal">联系电话：<span id="mobile_txt"></span></h1> 
            <p>
              <input type="text" name="mobile" placeholder="请输入收货人手机号">
            </p>
          </div>
          <div data-role="collapsible" class="inner_white" data-collapsed-icon="edit" data-expanded-icon="carat-u" data-iconpos="right">
            <h1 class="no-shadow"  style="font-weight:normal">电子邮箱：<span id="email_txt"></span></h1> 
            <p>
              <input type="text" name="email" placeholder="请输入电子邮箱">
            </p>
          </div>
          <div data-role="collapsible" class="inner_white" data-collapsed-icon="edit" data-expanded-icon="carat-u" data-iconpos="right">
            <h1 class="no-shadow"  style="font-weight:normal">邮政编码：<span id="post_code_txt"></span></h1> 
            <p>
              <input type="text" name="post_code" placeholder="请输入邮编">
            </p>
          </div>
        </div>
      </fieldset>
      <div style="margin-top:30px;padding:20px;">
        <button id="submit_btn" style="margin-top:30px;" type="submit" class="blue_full_btn">提交</button>
      </div>
    </form>
  </div>
  <a href="#info_pop" data-rel="popup" id="trigger_pop"></a>
  <div data-role="popup" data-position-to="window" data-theme="b" id="info_pop" class="ui-content">
    <p id="info_content"></p>
  </div>
</div>
<script type="text/javascript" src="/js/add_receiver.js"></script>

@endsection
