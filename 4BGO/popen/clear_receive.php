<?php
// 使用popen结合SHELL命令也可以实现多进程并发编程。

$file = 'file.txt';
file_put_contents($file, 'clear');
