
<?php
// 使用popen结合SHELL命令也可以实现多进程并发编程。
//b.php文件
$file = 'file.txt';

for ($i=0;$i<10;$i++){
    $fp = fopen($file,'a+');
    fputs($fp, $i.'/r/n');
    fclose($fp);
    // sleep(1);
}

?>