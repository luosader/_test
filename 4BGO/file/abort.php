<?php
ignore_user_abort(TRUE);// 浏览器关闭后，false时程序照常运行。不能证明它起作用
set_time_limit(0);
$interval = 1;
$stop     = 0;
do {
    if ($stop == 100) {break;}
    file_put_contents('phpzixue.php', ' Current Time: ' . time() . ' Stop: ' . $stop);
    // file_put_contents('phpzixue.php', ' Current Time: ' . time() . ' Stop: ' . $stop . PHP_EOL, FILE_APPEND | LOCK_EX);
    $stop++;
    sleep($interval);
} while (true);
