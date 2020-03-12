<?php
header("Content-type:text/html;charset=utf-8");

//检测当前目录值
if(!isset($dir)){ $dir = dirname(__FILE__); }
$dir = str_replace("\\","/",realpath($dir));
$filename = 'file.txt';
$word = "你好! PHP。\r\n";  //双引号会换行  单引号不换行


/**
* 创建文件夹
* @param string $dirname
* @return boolean
*/
function createFolder($dirname){
    //检测文件夹名称的合法性
    if(checkFilename(basename($dirname))){
        //当前目录下是否存在同名文件夹名称
        if(!file_exists($dirname)){ //可以用 is_dir($dirname)
            if(mkdir(trans($dirname),0777,true)){
                $mes="文件夹创建成功";
            }else{
                $mes="文件夹创建失败";
            }
        }else{
            $mes="存在相同文件夹名称";
        }
    }else{
        $mes="非法文件夹名称";
    }
    return $mes;
}
//要创建的多级目录
$dirname=$dir."/php测试";
// creatFolder($dirname);

/**
* 写入文件
* @param string $dirname
* @return boolean
*/
function put_fiie($file,$word){
    // if (is_writable($filename)) {
        file_put_contents($file, $word);//写入
        // echo file_put_contents($file, $word, FILE_APPEND);//追加
        // echo file_put_contents($file, $word, FILE_APPEND|LOCK_EX);//追加并锁定

        //fwrite方式写入
        // $fh = fopen($file, "w"); //w从开头写入 a追加写入
        // echo fwrite($fh, $word);
        // fclose($fh);
    // } else {
        // echo "文件 $filename 不可写";
    // }

    // echo "<br>";
    // echo "<a href=\"".$filename."\" >".$filename."</a>";
}
$file = $dirname.'/'.$filename;
// $file = "$dir/$filename";
put_fiie(trans($file),$word);

/**
* 删除文件夹以及文件夹下所有文件
* @param string $dirname
* @return boolean
*/
function deldir($dir) {
    $dh=opendir($dir);
    while ($file=readdir($dh)) {
        if($file!="." && $file!="..") {
            $fullpath=$dir."/".$file;
            if(!is_dir($fullpath)) {
                unlink($fullpath);
            } else {
                deldir($fullpath);
            }
        }
    }
    closedir($dh);
    if(rmdir($dir)) {
        return true;
    } else {
        return false;
    }
}







/**
*检测文件名是否合法
* @param string $filename
* @return boolean
*/
function checkFilename($filename){
  $pattern = "/[\/,\*,<>,\?\|]/";
  if (preg_match ( $pattern,  $filename )) {
    return false;
  }else{
    return true;
  }
}

//转码 防止中文乱码
function trans($str){
    if(empty($str)) return '';
    return iconv("UTF-8", "GBK", $str);//转成GBK
    // return mb_convert_encoding ($str, "GBK", "UTF-8");//转成GBK
}


// 5、常用转义符号的意义：
// \n  LF或ASCII中的0x0A(10),换行
// \r  CR或ASCII中的0x0D(13),回车
// \r\n表示 回车换行
// \t  水平制表符-HT或ASCII中的0x09（9）,表示键盘上的“TAB”键。
// \\  反斜杠
// \$  美圆符
// \"  双引号
// \'  单引号

// 6、"\r\n"与"</br>"的区别
// \r\n是输出的HTML代码换行，客户看到的效果没有换行。
// 如果是输出给浏览器，就用<br/>

?>