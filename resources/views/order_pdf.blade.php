<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>51临牌 临时牌照 号牌 服务商 车辆行驶临时号牌 临时号牌</title>
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/jquery.fileupload.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/animate.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/site.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="/favicon.ico"/>
</head>
<body>
  <div style="padding:100px;width:100%;height:auto;font-size:20px;line-height:2.0em">
    <img src="/imgs/logo-linpai.png" style="width:200px">
    <h2 style="margin-top:50px;">感谢您选择［51临牌的］服务</h2>

    <p style="margin-top:50px;">订单号：{{$order['order_code']}}</p>
    <p>下单时间：{{$order['created_at']}}</p>

    <p>用户名：{{$user['name']}}</p>
    <p>收货人：{{$receiver}}</p>
    <p>手机号码：{{$user['mobile']}}</p>
    <p>收货地址：{{$address}}</p>

    <div style="background:#000;height:3px;width:100%;margin-top:50px;" ></div>

    <div style="margin:30px 0px;">订单详情：</div>
    <table style="width:100%;margin-top:50px;text-align:left;">
      <thead>
        <tr>
          <td>商品名称</td>
          <td>单价</td>
          <td>数量</td>
          <td>优惠码减免</td>
          <td>实付款</td>
          <td>临牌号</td>
        </tr>
      </thead>
      <tbody style="">      
        <tr style="">
          <td style="padding-top:30px;">{{$good_name}}</td>
          <td style="padding-top:30px;">{{$price}}</td>
          <td style="padding-top:30px;">{{$num}}</td>
          <td style="padding-top:30px;">{{$cut_fee}}</td>
          <td style="padding-top:30px;">{{$final_fee}}</td>
          <td style="padding-top:30px;">{{$car_num}}</td>
        </tr>
      </tbody>
    </table>

    <p style="margin-top:50px;">
      现在就把您的邀请码 {{$boun_code}} 分享给朋友们,使用您的邀请码下单的每一位朋友都将获 得高达 20RMB 的优惠减免。
    </p>

    <p>
      而作为奖励,每当有一位朋友获得优惠的同时,您同样也将获得一张20RMB 的优惠码以便在下次下单 时获得优惠减免,奖励不设上限。赶快行动吧!
    </p>

    <div style="background:#000;height:3px;width:100%;margin-top:50px;" ></div>

    <p style="margin-top:50px;">
      如您有任何其他问题,欢迎给我们发送邮件 service@51linpai.com 或于周一至周日的 10:00-18:00 给我们来电 4000602620。
    </p>

    <div style="margin-top:80px;width:100%;margin-bottom:100px;">
      <div style="float:left;">
        <p>诚挚的问候</p>
        <p>51临牌团队</p>
      </div>
      <div style="position:relative;float:right;margin-right:100px;text-align:center;">
        <img src="/imgs/weixin.png" style="width:120px;">
        <p style="font-size:10px;width:160px;line-height:1.2em;padding-top:12px;">
          关注[51临牌]公众微信号 让我们与您随时保持联系
        </p>
      </div>
      <div style="clear:both;"></div>
    </div>
    <div style="margin-top:80px;width:100%;font-size:24px;text-align:center;">
      www.51LinPai.com
    </div>
  </div>
</body>
</html>
