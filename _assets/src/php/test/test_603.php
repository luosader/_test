<?php
header('Content-Type:text/html;charset=UTF-8');
function pf($num){
	echo $num*=$num;
	echo '<br>';
}
pf(1);pf(2);pf(3);
pf(4);pf(5);pf(6);
pf(7);pf(8);pf(9);
echo '<br>';
//====================================
$b=20;
function demo1(){
	//echo $b=21;//此时不需要return
	global $b;//全局变量优先级高于$b=20
	$b=21;
	return $b;//返回一个值为21，否则为空。return 语句后面的内容将不会被执行了
}
//echo demo1($b);
demo1();
echo $b.'<br>';
//===================================
$age=20;$sex=1;
function demo2($a,$n,$s){
	echo '年龄：'.$a.'<br>';
	echo '名字：'.$n.'<br>';
	if($s==1){echo "性别：男";}else{echo "性别：女".'<br>';}
	echo '性别：'.$s==1 ? '男':'女'.'(不能显示"性别："？)';
}
demo2(12,'name',0);
//echo demo2($age,'',$sex);
echo '<br>';
/*
函数(function)可以重复使用，并且有特有的业务逻辑的代码片段 1、运行空间，引用全局变量加上global关键字 2、静态属性 static 3、返回值
*/
//====================================
$str1 = 'this is a test!';
echo strlen($str1);echo '<br>';
echo strlen('this is a test!');echo '<br>';
$str2 = '这是一个测试！';
echo mb_strlen($str2,'gb2312');echo '<br>';
echo mb_strlen($str2,'utf-8');echo '<br>';
//====================================
$a="hello       ";
var_dump("$a");
var_dump(trim($a));

echo str_replace("her", "you", "i love her, Jack said");
//strpos/strripos
echo md5($a);
//作业603
// 字符串去空格
// 字符串替换
 ?>