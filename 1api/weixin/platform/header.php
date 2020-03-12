<?php

header("content-type:text/html;charset=utf8");

require("./WeCh.class.php");
define('APPID','wx8df1831e48ba0b9d');
define('APPSECRET','4ee1d147f25b87b48f41a8ad790ee030');
define('TOKEN','123456');
$wc = new WeCh(APPID,APPSECRET,TOKEN);

//第一次验证
//$wc ->firstValid();
//处理微信公众平台的消息(事件)
$wc ->responseMSG();