<?php
header('Content-Type:text/html;charset=UTF-8');
echo "<table width='400' bgcolor='#EEE'>";
date_default_timezone_set("Etc/GMT+8");//unix时间戳 格林威治时间 1970-1-1至今的秒数 时区：中国,东八区;还可以在页头设置 ini_set("date.timezone","Asis/shanghai");第三种：php配置文件中查找 php.ini date.timezone = PRC
echo "<tr>"."<td>";
echo "西八区：";echo "</td>";echo "<td>";
echo date('Y-m-d H:i:s');echo "</td>"."</tr>";

date_default_timezone_set("America/New_York");
echo "<tr>"."<td>";
echo "America/New_York：";echo "</td>";echo "<td>";
echo date('Y-m-d H:i:s');echo "</td>"."</tr>";

date_default_timezone_set("Canada/Atlantic");
echo "<tr>"."<td>";
echo "Canada/Atlantic：";echo "</td>";echo "<td>";
echo date('Y-m-d H:i:s');echo "</td>"."</tr>";

date_default_timezone_set("UTC");
echo "<tr>"."<td>";
echo "协调世界时：";echo "</td>";echo "<td>";
echo date('Y-m-d H:i:s');echo "</td>"."</tr>";

date_default_timezone_set("Atlantic/Madeira");
echo "<tr>"."<td>";
echo "Atlantic/Madeira：";echo "</td>";echo "<td>";
echo date('Y-m-d H:i:s');echo "</td>"."</tr>";

date_default_timezone_set("Africa/Gaborone");
echo "<tr>"."<td>";
echo "Africa/Gaborone：";echo "</td>";echo "<td>";
echo date('Y-m-d H:i:s');echo "</td>"."</tr>";

date_default_timezone_set("PRC");
echo "<tr>"."<td>";
echo "People's Republic of China：";echo "</td>";echo "<td>";
echo date('Y-m-d H:i:s');echo "</td>"."</tr>";

date_default_timezone_set("Pacific/Nauru");
echo "<tr>"."<td>";
echo "Pacific/Nauru：";echo "</td>"."<td>";
echo date('Y-m-d H:i:s');echo "</td>"."</tr>";


echo "<tr height='50'>"."<td>"."</td>"."</tr>";;

date_default_timezone_set("Etc/GMT-8");
echo "<tr height='50'>"."<td align='center'>";
echo '现在是：'.date('Y-m-d h:i:s');
echo "</td>"."<td align='center'>";
$a=strtotime("January 1 2016");
$b=ceil(($a-time())/60/60/24);
echo "距离2016年1月1日还有：".$b."天。";
echo "</td>"."</tr>";

$date1 = date('Y-m-d H:i:s', time());
$time1 = strtotime($date1);
$time2 = mktime(0,0,0,1,15,2016);
$sub = intval(($time2-$time1)/60/60/24);
echo "距离还款日还有："."<font color=#FF4040>".$sub."</font>"."天";


$d=strtotime("tomorrow");
echo date("Y-m-d h:i:sa", $d) . "<br>";

$d=strtotime("next Saturday");
echo date("Y-m-d h:i:sa", $d) . "<br>";

$d=strtotime("+3 Months");
echo date("Y-m-d h:i:sa", $d) . "<br>";

//下例输出七月四日之前的天数：
$d1=strtotime("December 31");
$d2=ceil(($d1-time())/60/60/24);
echo "距离十二月三十一日还有：" . $d2 ." 天。";



echo "</table>";
/*作业610
获取至少四个时区的时间
美国、马尔代夫、

算出一段时间内的天数
datetime()
算出今天距离xx还剩xx天(2016-1-15)

算出还款哪一天，算出哪天星期几
$a = time();
$b = date('Y-m-d H:i:s',mktime(0,0,0,15,1,2016));
$c = (ceil($b - $a)/(24*60*60));
echo  '现在：'.date('Y-m-d H:i:s') . "\n" ;echo "</td>"."<td>";
echo '到期日期：'.date('Y-m-d H:i:s',mktime(0,0,0,1,15,2016));echo "</td>"."<td>";
echo '距离期限还剩'.$c.'天';
*/


?>