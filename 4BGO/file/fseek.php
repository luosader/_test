<?php 
header('Content-Type:text/html;charset=UTF-8');
ini_set('memory_limit', '-1');
// define('DIR',dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR);
// define('URL',$_SERVER['HTTP_HOST'].DIRECTORY_SEPARATOR.'_script'.DIRECTORY_SEPARATOR);
// define('PATH','..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'_script'.DIRECTORY_SEPARATOR);
define('PATH', '');
// windows "\r\n"; Linux "\n"

// echo "<pre>";

$file = 'data.md';
// $file = PATH.'temp/old.txt';
// $file = PATH.'db_icyun_20170110.sql';





$fp = fopen($file,'r');
// $fsize = 3.65;// 源文件 3925447562KB > 3.65G
$fsize = 3.7;
$chunk = 1048576;// 单位：KB ，这里设为1M
// $chunk = 524288000;
$chunk = 104857600;// 100M
$num = ceil(($fsize*1024*1024)/($chunk/1024));// 转为Kb
// $max = (intval($fs) == PHP_INT_MAX) ? PHP_INT_MAX : filesize($file);// 如果超越 filesize()出来的是负数？

// $readData = fread($fp,$chunk);
// echo $readData;die;

for ($sk=0; $sk < $num; $sk++) {
    $readData = fread($fp,$chunk);
    // echo $readData;
    // echo "<hr>";
    $fileName = PATH.'temp/'.$sk.'.php'; // 获取需要创建的文件名称
    if (!is_dir(PATH.'temp/')) mkdir(PATH.'temp/', 0777); // 使用最大权限0777创建文件
    // file_put_contents 方式创建
    file_put_contents($fileName, $readData);
    // fwrite 方式创建
    // if (!file_exists($fileName)) { // 如果不存在则创建
    //     // 检测是否有权限操作
    //     if (!is_writable($fileName)) chmod($fileName, 0777); // 如果无权限，则修改为0777最大权限
    //     $file_handle = fopen($fileName,'w');
    //     fwrite($file_handle, $readData);
    // }
    fseek($fp,$chunk,SEEK_CUR);
}
fclose($fp);










// $data = file($file);
// $line = $data[count($data) - 1];
// echo $line;



// $file_handle = fopen(PATH.'temp/old.txt', "rb+");// 可读写，文件必须存在
// $file_handle = fopen(PATH.'temp/new.txt', "r+");
// $file_handle = fopen(PATH.'temp/new.txt', "w+");
// $file_handle = fopen(PATH.'temp/new.txt', "a+");
// $file_handle = fopen(PATH.'temp/new.txt', "x+");

// 可以用以下办法生成测试文件
// for ($index1 = 1; $index1 <= 100; $index1++) {
//     fwrite($file_handle, 'http://blog.csdn.net/longxuu/article/details/'.$index1."\r\n");
// }
// fclose($file_handle); 

// 读取处理代码如下：
// $i = 0;
// $now = '';
// while ($i >= 0) {
//     if ($i>10) {
//         break;
//     }
//     fseek($file_handle, 0, SEEK_CUR);
//     $now = fgetc($file_handle);//可以自己写个判断false表示文件到头   
//     if ($now == "\r\n") {
//         echo '找到断点';
//     }  
//     echo $now;  
//     $i++;
// }

// fclose($file_handle);




/*   $fp = fopen($file, "r");
   $num = 10;
   $chunk = 4096;
   $fs = sprintf("%u", filesize($file));
   $max = (intval($fs) == PHP_INT_MAX) ? PHP_INT_MAX : filesize($file);
   $readData = '';
   for ($len = 0; $len < $max; $len += $chunk)
   {
       $seekSize = ($max - $len > $chunk) ? $chunk : $max - $len;
       fseek($fp, ($len + $seekSize) * -1, SEEK_END);
       $readData = fread($fp, $seekSize) . $readData;
       if (substr_count($readData, "\n") >= $num + 1)
       {
           preg_match("!(.*?\n){" . ($num) . "}$!", $readData, $match);
           $data = $match[0];
           break;
       }
   }
   fclose($fp);
   echo $data;*/


/*echo strlen('php读取大文件可以使用file函数和fseek函数，但是二者之间效率可能存在差异，本文章向大家介绍php file函数与fseek函数实现大文件读取效率对比分析，需要的朋友可以参考一下。');
echo "<br>";
echo filesize($file);echo "<br>";

$file = fopen($file,'r');
// 读取第一行
$data = fgets($file);
// echo $data;echo "<br>";
// 输出当前位置
echo ftell($file);echo "<br>";
// 改变当前位置
fseek($file,15);
// 再次输出当前位置
echo ftell($file);echo "<br>";
// 倒回文件的开头
fseek($file,0);
echo ftell($file);
fclose($file);*/







/*返回文件大小*/
/*// 使用file直接读取 很慢
$starttime=microtime_float();
  
// ini_set('memory_limit', '-1');
// $file = 'testfile.txt';
  
$data = file($file);
$line = $data[count($data) - 1000];
$endtime=microtime_float();
  
echo count($data),"<br/>";
echo $endtime-$starttime;
  
function microtime_float(){
  list($usec, $sec) = explode(" ", microtime());
  return ((float)$usec + (float)$sec);
}*/

/*// 使用linux命令  tail 这种方法不能在windows下使用
$starttime=microtime_float();

$file = 'testfile.txt';
$file = escapeshellarg($file); // 对命令行参数进行安全转义
$line = `tail -n 100 $file`;
  
echo $line,"<br/>";
  
$endtime=microtime_float();
echo $endtime-$starttime;
  
function microtime_float(){
  list($usec, $sec) = explode(" ", microtime());
  return ((float)$usec + (float)$sec);
}*/



// 使用fseek函数
/*// 方法一：使用fopen打开文件（从文件指针资源句柄）
$starttime=microtime_float();
  
// $file = 'testfile.txt';
$fp = fopen($file, "r+");
$line = 100;
$pos = -2;
$t = $data = "";
  
while ($line > 0)
{
    while ($t != "\r\n") //换行符
    {
        fseek($fp, $pos, SEEK_END);//移动指针
        $t = fgetc($fp);//获取一个字符
        $pos--;//向前偏移
    }
    $t = "";
    $data = fgets($fp);//获取当前行的数据
    $line--;
}
fclose($fp);
echo $data,"<br/>";

$endtime=microtime_float();
echo $endtime-$starttime;
  
function microtime_float(){
  list($usec, $sec) = explode(" ", microtime());
  return ((float)$usec + (float)$sec);
}*/


/*// 方法二：一块一块的读取 最快
$starttime=microtime_float();
  
// $file = 'testfile.txt';
$fp = fopen($file, "r");
$num = 10;
$chunk = 4096;//4K的块
$fs = sprintf("%u", filesize($file));
$readData='';
$max = (intval($fs) == PHP_INT_MAX) ? PHP_INT_MAX : $fs;

for($len = 0; $len < $max; $len += $chunk){
   $seekSize = ($max - $len > $chunk) ? $chunk : $max - $len;
   fseek($fp, ($len + $seekSize) * -1, SEEK_END);
   $readData = fread($fp, $seekSize) . $readData;

   if (substr_count($readData, "\n") >= $num + 1) {
      $ns=substr_count($readData, "\n")-$num+2;
      preg_match('/(.*?\n){'.$ns.'}/',$readData,$match);
      $data = $match[1];
      break;
  }
}
fclose($fp);
echo $data,"<br/>";

$endtime=microtime_float();
echo $endtime-$starttime;

function microtime_float(){
  list($usec, $sec) = explode(" ", microtime());
  return ((float)$usec + (float)$sec);
}*/











?>