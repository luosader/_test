<?php 

require("./WeCh.class.php");
define('APPID', 'wx8df1831e48ba0b9d');
define('APPSECRET', '4ee1d147f25b87b48f41a8ad790ee030');
define('TOKEN','123456');
$wc = new WeCh(APPID,APPSECRET,TOKEN);
$file = './yasina.jpg';
$result = $wc ->uploadTmp($file,'image');
var_export($result);//输出或返回一个变量的字符串表示

 ?>