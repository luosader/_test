php读取大文件可以使用file函数和fseek函数，但是二者之间效率可能存在差异，本文章向大家介绍php file函数与fseek函数实现大文件读取效率对比分析，需要的朋友可以参考一下。

1. 直接采用file函数来操作

由于 file函数是一次性将所有内容读入内存，而PHP为了防止一些写的比较糟糕的程序占用太多的内存而导致系统内存不足，使服务器出现宕机，所以默认情况下限制只能最大使用内存16M,这是通过php.ini里的 memory_limit = 16M 来进行设置，这个值如果设置-1，则内存使用量不受限制。

下面是一段用file来取出这具文件最后一行的代码：
复制代码

```php
    ini_set('memory_limit', '-1');
    $file = 'access.log';
    $data = file($file);
    $line = $data[count($data) - 1];
    echo $line;
```

复制代码

整个代码执行完成耗时 116.9613 (s)。

我机器是2个G的内存，当按下F5运行时，系统直接变灰，差不多20分钟后才恢复过来，可见将这么大的文件全部直接读入内存，后果是多少严重，所以不在万 不得以，memory_limit这东西不能调得太高，否则只有打电话给机房，让reset机器了。

 

2.直接使用PHP的 fseek 来进行文件操作

这种方式是最为普遍的方式，它不需要将文件的内容全部读入内容，而是直接通过指针来操作，所以效率是相当高效的。在使用fseek来对文件进行操作时，也有多种不同的方法，效率可能也是略有差别的，下面是常用的两种方法：

方法一

首先通过fseek找到文件的最后一位EOF，然后找最后一行的起始位置，取这一行的数据，再找次一行的起始位置， 再取这一行的位置，依次类推，直到找到了$num行。

#实现代码如下
复制代码

```php
$fp = fopen($file, "r");
$line = 10;
$pos = -2;
$t = " ";
$data = "";
while ($line > 0)
{
    while ($t != "\n")
    {
        fseek($fp, $pos, SEEK_END);
        $t = fgetc($fp);
        $pos--;
    }//  http://www.manongjc.com
    $t = " ";
    $data .= fgets($fp);
    $line--;
}
fclose($fp);
echo $data
```

复制代码

整个代码执行完成耗时 0.0095 (s)

 
方法二
还是采用fseek的方式从文件最后开始读，但这时不是一位一位的读，而是一块一块的读，每读一块数据时，就将读取后的数据放在一个buf里，然后通过换 行符(\n)的个数来判断是否已经读完最后$num行数据。

#实现代码如下
复制代码

```php
   $fp = fopen($file, "r");
   $num = 10;
   $chunk = 4096;
   $fs = sprintf("%u", filesize($file));
   $max = (intval($fs) == PHP_INT_MAX) ? PHP_INT_MAX : filesize($file);
   for ($len = 0; $len < $max; $len += $chunk)
   {
       $seekSize = ($max - $len > $chunk) ? $chunk : $max - $len;
       fseek($fp, ($len + $seekSize) * -1, SEEK_END);
       $readData = fread($fp, $seekSize) . $readData;
       if (substr_count($readData, "\n") >= $num + 1)
       {
           // 作者：码农教程   http://www.manongjc.com
           preg_match("!(.*?\n){" . ($num) . "}$!", $readData, $match);
           $data = $match[0];
           break;
       }
   }
   fclose($fp);
   echo $data;
```

复制代码

整个代码执行完成耗时 0.0009(s)。

 

方法三
复制代码

```php
   function tail($fp, $n, $base = 5)
   {
       assert($n > 0);
       $pos = $n + 1;
       $lines = array();
       while (count($lines) <= $n)
       {
           try
           {
               fseek($fp, -$pos, SEEK_END);
           }
           catch (Exception $e)
           {
               fseek(0);
               break;
           }
           $pos *= $base;
           while (!feof($fp))
           {
               array_unshift($lines, fgets($fp));
           }
       }
    
       return array_slice($lines, 0, $n);
   }
    
   var_dump(tail(fopen("access.log", "r+"), 10));
```

复制代码

整个代码执行完成耗时 0.0003(s)

 

原文地址：http://www.manongjc.com/article/1578.html