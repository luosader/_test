<?php
header('Content-Type:text/html;charset=UTF-8');
$file = "D:\Program Files Professional\WampSever\www\php\index.php";
echo $file."<br>";
echo basename($file);
var_dump(pathinfo($file,PATHINFO_DIRNAME ));//数组不能用echo
fclose($file);

$path = "D:\Program Files Professional\WampSever\www\php\\test.txt";
$current = file_get_contents($path);
echo $current.'<br>';
date_default_timezone_set("Etc/GMT-8");
$current .= date('Y-m-d H:i:s',time()).'执行了xxxx'."\n";
$result = file_put_contents($path, $current);
// var_dump($result);
if($result !== false)
    echo '写入成功！'.'<br>';
else
    echo '写入失败！'.'<br>';

var_dump(glob("*.*"));
fclose($path);

$file = fopen($path, 'r');
$str = fgets($file);
// fwrite(,);
// var_dump($str);
echo $str;
fclose($path);
//计数器
//<?php  include ""; ？>引用另一个php等文件
$file = fopen($path, 'w');
$num = fgets($file);
echo "您已经是第<font color=red size=7".$num."</font>位访问者";
fputs($file,++$num);
fclose($path);

$filename  =  'D:\Program Files Professional\WampSever\www\php\demo.txt' ;
$somecontent  =  '你好'."\n" ;
// 首先我们要确定文件存在并且可写。
 if ( is_writable ( $filename )) {
     // 在这个例子里，我们将使用添加模式打开$filename，
    // 因此，文件指针将会在文件的末尾，
    // 那就是当我们使用fwrite()的时候，$somecontent将要写入的地方。
     if (! $handle  =  fopen ( $filename ,  'a' )) {
         echo  "不能打开文件  $filename " ;
         exit;
    }
     // 将$somecontent写入到我们打开的文件中。
     if ( fwrite ( $handle ,  $somecontent ) ===  FALSE ) {
        echo  "不能写入到文件  $filename " ;
        exit;
    }
    echo  "成功地将  $somecontent  写入到文件 $filename " ;
     fclose ( $handle );
} else {
    echo  "文件  $filename  不可写" ;
}
//作业  不足1kb的  按byte算;不足1MB的按kb算;
//判断是否为目录is_dir
//新建目录mkdir,
/*作业616
文件管理系统
1、列出当前文件下面的所有文件和文件夹
列表
    图标（区分文件夹和文件）文件名  如果是文件右边显示大小加上单位
dirname — 获得文件目录路径的目录部分
basename - 获得不带目录的文件名
file_exists — 检查文件或目录是否存在
is_dir — 判断给定文件名是否是一个目录
is_file — 判断给定文件名是否为一个正常的文件
glob — 寻找与模式匹配的文件路径

stat — 给出文件的信息
filesize — 取得文件大小
filetype — 取得文件类型
fileatime — 取得文件的上次访问时间
filemtime — 取得文件修改时间
touch — 设定文件的访问和修改时间
fileowner — 取得文件的所有者
2、点开文件夹，显示该文件夹下面的文件
    列表
        图标（区分文件夹和文件）文件名  如果是文件右边显示大小加上单位
mkdir — 新建目录
rmdir — 删除目录
pathinfo — 返回文件路径的信息
realpath — 返回规范化的绝对路径名
rename — 重命名一个文件或目录
3、点开文件，新的页面显示该文件的全部内容
    内容包括：1）文件名；
              2）文件路径；XXXX\XXX\xx.xxx
              3）文件正文内容
readfile — 输出一个文件
unlink — 删除文件
is_executable、is_link、is_readable、is_writable：这四个PHP文件函数分别返回文件是否可执行、是否是链接、是否可读、是否可写。
*/
?>