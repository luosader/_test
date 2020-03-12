<?php
header('Content-Type:text/html;charset=UTF-8');
//作业602
//九九乘法表三中实现方法
echo "<table bgcolor='#DDD' text='red'>";
$i=0;
while ($i<9) {
	$i++;
	$j=1;
	echo "<tr>";
	while($j<=$i){
		echo "<td width=90 bgcolor='#FFFFCD'>";
		echo $j.'x'.$i.'='.$i*$j;
		echo "</td>";
		$j++;
	}
	echo "</tr>";
}

$m=1;
do{
	$n=1;
	echo "<tr>";
	do{
		echo "<td bgcolor=#F5DEB3>";
		echo "{$n}x{$m}=".$m*$n;
		echo "</td>";
		$n++;
	}while($n<=$m);
	echo "</tr>";
	$m++;
}while ($m <= 9);

for ($x=1; $x < 10; $x++) {
	echo "<tr>";
	for ($y=1; $y <= $x; $y++) {
		echo "<td bgcolor='#F4A460'>";
		echo $y.'*'.$x.'='.$x*$y;
		echo "</td>";
	}
	echo "</tr>";
}
echo "</table>";
echo "<br>"."<br>"."<br>";

echo "<table width='600' border='1'>";
for($j=1;$j<=9;$j++){
echo "<tr>";
for($z=0;$z<9-$j;$z++){
echo "<td> </td>";
}
for($i=$j;$i>=1;$i--){
echo "<td>{$i}*{$j}=".($i*$j)."</td>";
}
echo "</tr>";
}
echo "</table>";

?>