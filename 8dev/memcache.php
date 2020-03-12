<?php
// phpinfo();
require '../_lib/func.php';
// memcache简单使用
if (extension_loaded('memcache')) {
    $m = new memcache();
    $m->connect('localhost',11211) or die('shit');
    $m->set('memcache','hello memcache!<br>');
    echo 'Memcache扩展开启：<br>';
    echo $m->get('memcache');
} else {
    echo 'Memcache扩展未开启！';
}

echo "<hr>";
// memcached简单使用
if (extension_loaded('Memcached')) {
    $d = new memcached();
    $d->addServer('127.0.0.1',11211);
    $d->set('memcached','hello memcached!<br>');
    echo 'Memcached扩展开启：<br>';
    echo $d->get('memcached');
} else {
    echo 'Memcached扩展未开启！';
}

echo '<hr>';
$g = $m->get('omg');
debug($g);


