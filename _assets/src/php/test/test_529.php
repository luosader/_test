<?php
header('Content-Type:text/html;charset=UTF-8');
$a = "false";
var_dump($a);//dump判定类型及输出结果
echo "<br />";
echo "$a";echo "<br />";
echo '$a'."<br />";//"."等同于JS里的"+"
echo 'he say:"I\'be back!"';//转义字符
echo $str = "<br />".<<<type
  文本的输出，后面“type”必须顶格写。
type
."<br />"."<br />"."<br />";
$s = 0.9;
echo "$s";
echo "<br />";

echo "<br />";
$b=0;$c="0";var_dump($b !== $c);
$b=0;$c="0";echo($b !== $c); 
$b=0;$c="0";var_dump($b <> $c);
echo "<br />";

$m=9;
 $n=($m>10) ? $m+1:$m-1;var_dump($m-1);

$e = (1>0) ? "1" : '0';var_dump($e);// 三目运算符 与下边if语句意思一样
if( 1 < 0 ){$f = "1";}else{$f = "0";}var_dump($f);

//分块语句
$g=600;
if ($g<=5&&$g>=0) {
	echo("这个数字小于5");
}elseif ($g==5) {
	echo("这个数字等于5");
}elseif ($g>=5&&$g<=100) {
	echo("这个数字大于5");
}elseif ($g<0||$g>100) {
	echo("这个数字无效");
}

$h=60;
if ($h>=90) {
	echo("优秀");
}elseif ($h>=75) {
	echo("良好");
}elseif ($h>=60) {
	echo("及格");
}else{echo("不及格");}

?>