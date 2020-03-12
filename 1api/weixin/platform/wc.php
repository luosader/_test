<?php

require("./WeCh.class.php");
define('APPID', 'wx8df1831e48ba0b9d');
define('APPSECRET', '4ee1d147f25b87b48f41a8ad790ee030');
define('TOKEN','123456');
$wc = new WeCh(APPID,APPSECRET,TOKEN);

//$access_token= $wc ->getAccessToken();
//var_dump($access_token);
//$wc ->getQRCodeTicket(1234);
//$result = $wc ->getQRCodeTicket(1234);
//var_dump($result);
$wc ->getQRCode(1234,NULL,2);

