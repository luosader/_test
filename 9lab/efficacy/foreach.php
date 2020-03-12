<?php
// N种遍历效能分析
// 1、区别1
// array_walk 主要是要对数组内的每个值进行操作，操作结果影响原来的数组
// array_map主要是对数组中的值进行操作后返回数组，以得到一个新数组
// 2、区别2
// array_walk 可以没有返回值；array_map要有返回值，因为要填充数组





// $startTime=$mtime[1]+$mtime[0]; // $mtime[0] 微妙 ，$mtime[1] 时间戳整数部分
// set_time_limit(36000);

$mtime=explode(' ',microtime());
$time = bcadd($mtime[1],$mtime[0],8);
$test = array();
for($i = 0; $i<10000000; $i++) {
	$test[$i] = $i;
}
$mtime=explode(' ',microtime());
$one_time = bcadd($mtime[1],$mtime[0],8);

function add($arg){
	return $arg++;
}
foreach($test as $key => $value) {
	add($value);
	// $value++;
}
unset($value);
$mtime=explode(' ',microtime());
$two_time = bcadd($mtime[1],$mtime[0],8);

array_walk($test, function ($value) {
	return $value++;
});
unset($value);
$mtime=explode(' ',microtime());
$three_time = bcadd($mtime[1],$mtime[0],8);

// while ( <= 10) {
// 	# code...
// }

// each(array);
// while ( <= 10) {
// 	# code...
// }

// $foreach_time =  bcadd($two_time, $one_time, 8);
$itemtime = bcsub($one_time, $time, 8);
$foreach_time = bcsub($two_time, $one_time, 8);
$array_walk_time = bcsub($three_time, $two_time, 8);

// $foreach_time =  $two_time - $one_time;
// $array_walk_time = $three_time - $two_time;

echo 'a = ' . $time . '<br/>';
echo 'b = ' . $one_time . '<br/>';
echo 'c = ' . $two_time . '<br/>';
echo 'd = ' . $three_time . '<br/>';
echo 'itemtime = ' . $itemtime . '<br/>';
echo 'foreach_time =' . $foreach_time . '<br/>';
echo 'array_walk_time =' . $array_walk_time . '<br/>';

?>