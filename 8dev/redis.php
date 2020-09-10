<?php
// phpinfo();
// $root = getcwd();
// $root = __DIR__;
$root = dirname(__DIR__);
// echo $root;
require $root . '/_lib/func.php';
// debug(get_magic_quotes_gpc());

//连接本地的 Redis 服务
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
echo 'Server is running: ' + $redis->ping();
$redis->set('key', 'value');//设置key
echo '<br>Stored string in redis:: ' . $redis->get('key');//获取key

echo '<hr>';
// $redis->set('key',['a','b']);
// $r = $redis->strlen('key');
// $redis->append('key','string');
// $g = $redis->get('key');

// $redis->flushAll();//清空整个redis[总true]
// $redis->flushDB();//清空当前redis库[总true]