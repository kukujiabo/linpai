<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body style="text-align:center;font-family:Microsoft YaHei">
  <div style="width:100%;height:auto;font-size:14px;line-height:1.1em;text-align:left">
    <img src="/imgs/logo-linpai.png" style="width:150px">
    <h3 style="margin-top:40px;">感谢您选择［51临牌的］服务</h3>

    <p style="margin-top:40px;">订单号：{{$order_code}}</p>
    <p>下单时间：{{$created_at}}</p>
    <p>用户名：{{$user}}</p>
    <p>收货人：{{$receiver}}</p>
    <p>手机号码：{{$mobile}}</p>
    <p>收货地址：{{$address}}</p>

    <div style="background:#000;height:1px;width:100%;margin-top:20px;" ></div>

    <h4 style="margin:30px 0px;">订单详情：</h4>
    <table style="width:100%;margin-top:20px;text-align:center;">
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
          <td style="padding-top:20px;">{{$good_name}}</td>
          <td style="padding-top:20px;">{{$price}}</td>
          <td style="padding-top:20px;">{{$num}}</td>
          <td style="padding-top:20px;">{{$cut_fee}}</td>
          <td style="padding-top:20px;">{{$final_fee}}</td>
          <td style="padding-top:20px;">{{$car_num}}</td>
        </tr>
      </tbody>
    </table>

    <div style="background:#000;height:1px;width:100%;margin-top:20px;" ></div>

    <p style="margin-top:30px;">
      现在就把您的邀请码 {{$boun_code}} 分享给朋友们,使用您的邀请码下单的每一位朋友都将获得高达 20RMB 的优惠减免。
    </p>

    <p>
      而作为奖励,每当有一位朋友获得优惠的同时,您同样也将获得一张20RMB 的优惠码以便在下次下单时获得优惠减免,奖励不设上限。赶快行动吧!
    </p>

    <div style="background:#000;height:1px;width:100%;margin-top:20px;" ></div>

    <p style="margin-top:20px;">
      如您有任何其他问题,欢迎给我们发送邮件 service@51linpai.com 或于周一至周五的 10:30-18:00 给我们来电 4000602620。
    </p>

    <div style="margin-top:20px;width:100%">
      <div style="float:left;">
        <p>诚挚的问候</p>
        <p>51临牌团队</p>
      </div>
      <div style="position:relative;float:right;margin-top:20px;margin-right:80px;text-align:center;">
        <img src="/imgs/qrcode.png" style="width:100px;">
        <p style="font-size:10px;width:120px;line-height:1.2em;padding-top:12px;">
          关注[51临牌]公众微信号让我们与您随时保持联系
        </p>
      </div>
      <div style="clear:both;"></div>
    </div>
    <div style="margin-top:50px;width:100%;font-size:20px;text-align:center;">
      www.51LinPai.com
    </div>
  </div>
</body>
</html>
