<?php 

require("./test.class.php");
define('APPID','wx8df1831e48ba0b9d');
define('APPSECRET','4ee1d147f25b87b48f41a8ad790ee030');
//实例化类
$we = new Wechat(APPID,APPSECRET);

//$result = $we ->getAccessToken();
//var_dump($result);

//$ticket = $we ->getQRCodeTicket(1234);
//echo $ticket;

$we ->getQRCode(1334,NULL,2);//NULL必须手写

 ?>