<?php
// php.exe真实路径：'D:/phpStudy/php53/php.exe';
// 测试文件真实路径：'D:/WWW/_test/backstage/popen/receive.php';
// cmd命令
// d:
// D:/phpStudy/php53/php D:/WWW/_test/backstage/popen/receive.php
// php -f /WWW/_test/backstage/popen/receive.php

echo 'start curl<br>';
// echo dirname(__FILE__);
define('BASE_PATH', str_replace('\\', '/', realpath(dirname(__FILE__) . '/')) . "/");
echo BASE_PATH;
$out = popen("D:/phpStudy/php53/php D:/WWW/_test/backstage/popen/receive.php &", "w");

pclose($out);

echo '<br>end curl<br>';
// 运行p.php，即可实现PHP多进程异步编程。
