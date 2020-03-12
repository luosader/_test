<?php
echo 'start curl<br>';
$out = popen('clear_receive.php &', 'r');
pclose($out); 

echo 'end curl<br>';
// 运行p.php，即可实现PHP多进程异步编程。
?>