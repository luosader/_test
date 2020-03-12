<?php
header('Content-Type:text/html;charset=UTF-8');
//索引数组
$array1 = array('张三','男','20','未婚',);
$array2 = array( 1 => '张三', '男',5 => '20','未婚',);
//关联数组
$array3 = array( '姓名' => '张三','性别' => '男','年龄' => '20','婚姻'=>'未婚',);
var_dump($array1);
var_dump($array2);
print_r($array3);

echo '姓名：'.$array1[0].'<br>';
echo '性别：'.$array1[1].'<br>';
echo '年龄：'.$array1[2].'<br>';
echo '婚姻：'.$array1[3].'<br>';
echo '<br>';
echo '姓名：'.$array3['姓名'].'<br>';
echo '性别：'.$array3['性别'].'<br>';
echo '年龄：'.$array3['年龄'].'<br>';
echo '婚姻：'.$array3['婚姻'].'<br>';
//二维数组
$array4 = array(array(1,2,3),array(4,5,6),array(7,8,9),);
echo $array4[2][1];//以0为起始
var_dump($array4[2][1]);
print_r($array4[2][1]);echo '<br>';
 //全部输出
print_r($array4);//更人性化的格式化输出  
var_dump($array4);//有变量类型的提示，更好的调试
//

//作业611
//三维数组取值



?>