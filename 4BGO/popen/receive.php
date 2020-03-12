<?php
// 使用popen结合SHELL命令也可以实现多进程并发编程。

$file = 'D:/WWW/_test/backstage/popen/file.txt';
for ($i = 0; $i < 10; $i++) {
    $fp = fopen($file, 'a+');
    fputs($fp, $i . "\r\n");
    fclose($fp);
    // sleep(1);
}
