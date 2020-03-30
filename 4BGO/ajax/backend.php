
<?php
// 使用popen结合SHELL命令也可以实现多进程并发编程。
// fopen();fputs();fclose();
// "w" 写入方式打开，将文件指针指向文件头并将文件大小截为零。如果文件不存在则尝试创建之。
// "w+" 读写方式打开，将文件指针指向文件头并将文件大小截为零。如果文件不存在则尝试创建之。
// "a" 写入方式打开，将文件指针指向文件末尾。如果文件不存在则尝试创建之。
// "a+" 读写方式打开，将文件指针指向文件末尾。如果文件不存在则尝试创建之。
// chr(10)// 换行
// chr(13)// 回车

// file_put_contents(filename, data);file_get_contents(filename);
// file_put_contents("rote.txt","cc  ",FILE_APPEND);
// 第三个参数实现将内容追加到文件的后面，如果没有这个参数会直接覆盖以前的数据。

//b.php文件
$file = 'file.txt';

if ($_POST['cmd'] == 'send') {
    for ($i = 0; $i < 10; $i++) {
        $fp = fopen($file, 'a+');
        fputs($fp, $i . '/r/n');
        fclose($fp);
        // sleep(1);
    }
    file_put_contents('file.txt', chr(10), FILE_APPEND);
    echo "$_POST[callback]";
} elseif ($_POST['cmd'] == 'clear') {
    file_put_contents('file.txt', '');
    echo "$_POST[callback]";
} else {
    echo "执行失败！";
}

?>