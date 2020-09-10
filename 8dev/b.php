<?php
ini_set('session.cookie_domain','test.com');
ini_set("session.save_handler","redis"); //很重要
ini_set("session.save_path","tcp://127.0.0.1:6379");//很重要
header("Content-type:text/html;charset=utf-8");
session_start();//这个很重要


// $_SESSION['test_session']= @array('name' =>'fanqie' , 'ccc'=>'hello redis ');


$redis = new redis();
$redis->connect('127.0.0.1', 6379);
echo 'sessionid>>>>>>> PHPREDIS_SESSION:' . session_id();
echo '<br/>';
echo '<br/>';
//redis用session_id作为key并且是以string的形式存储
echo '通过redis获取>>>>>>>'.$redis->get('PHPREDIS_SESSION:' . session_id());
echo '<br/>';
echo '<br/>';
echo '通过session获取>>>>>>><br/>';
echo '<pre>';
var_dump($_SESSION['test_session']);

echo '</pre>';