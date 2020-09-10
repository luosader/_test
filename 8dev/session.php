<?php
ini_set('session.cookie_domain','.test');
// 如果未修改php.ini下面两行注释去掉
ini_set('session.save_handler', 'redis');
// ini_set('session.save_path', 'tcp://127.0.0.1:6379');
ini_set('session.save_path', 'http://127.0.0.1:6379');
//redis有密码的话
//ini_set('session.save_path', 'tcp://192.168.1.10:6379?auth=password');
 
session_start();
// $_SESSION['sessionid'] = 'this is session content6379!';
// echo $_SESSION['sessionid'];
// echo '<br/>';
 
$redis = new redis();
$redis->connect('127.0.0.1', 6379);

// redis 用 session_id 作为 key 并且是以 string 的形式存储
echo $redis->get('PHPREDIS_SESSION:' . session_id());
echo $redis->get('key');

