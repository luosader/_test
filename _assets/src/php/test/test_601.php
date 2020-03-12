<?php
header('Content-Type:text/html;charset=UTF-8');
$i=44;
var_dump(floor($i));
var_dump(intval($i));
switch(intval($i/10)){
	case 10:
	case 9:echo "优秀";break;
	case 8:echo "良好";break;
	case 7:echo "优秀";break;
	case 6:echo "及格";break;
	case 5:
	case 4:
	case 3:
	case 2:
	case 1:
	case 0:echo "不及格";break;
	default:echo "输入的值不合法，请输入0-100之间的数";break;
}
//作业601
//成绩评级
?>