<?php


$alipay_config['partner']   = '2088021237428966';

//收款支付宝账号
$alipay_config['seller_email']  = 'linpai51@foxmail.com';

//
$alipay_config['key'] = 'g0cezbipn4glrjbakg89n898j5a6qhbt';

$alipay_config['sign_type']    = strtoupper('MD5');

$alipay_config['input_charset']= strtolower('utf-8');

//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
$alipay_config['cacert']    = getcwd().'\\cacert.pem';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport']    = 'https';

