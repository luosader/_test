<?php
header('Content-Type:text/html;charset=UTF-8');

$array1 = array(array(array('艾希','盖伦','瑞兹'),array('薇恩','希维尔','凯特琳'),array('潘森','雷克顿','奥拉夫')),array(array('亚索','劫','艾克'),array('卡特琳娜','阿卡利','乐芙兰'),array('伊芙琳','雷恩加尔','魔腾')),array(array('塞恩','慎','内瑟斯'),array('阿里斯塔','拉莫斯','崔斯特'),array('娑娜','迦娜','基兰')),);
echo $array1[0][0][0];
echo "<hr>";
//查找x行x列的内容

//定义一个数组，改变其中一个元素的值
$string = array('张三丰','男','20','未婚');
echo  '修改前：'.implode ( '; ' ,  $string). "<br>" ;
$replace = array('顺','男','23');
$start = array( 3 ,  0 ,  0 );
$length  = array( 6 ,  3 ,  2 );
echo  '修改后：'.implode ( '; ' ,  substr_replace ( $string ,  $replace ,  $start ,  $length )). "\n" ;
/*

*/
//作业612
//输入三个人的三门课的总分，平均分，再将学生按照总分排序(倒序)，平均分排序(正序);
//建立一个数组，随机生成一个验证码


?>