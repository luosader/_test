<?php  


// 获取土豆网视频地址

// 思路：file_get_contents/curl来获取页面的html
// 正则分析视频地址 

// echo 'ok';
$simplexml = simplexml_load_file('./1.xml');
// print_r($simplexml);

// echo $simplexml->cate1->book[1]->title;

// // 插卡改节点下有几本书

// // echo $simplexml->count();
// // echo '<hr>';
// // echo $simplexml->cate1->count();

// foreach ($simplexml->cate1[0]->children() as $son) {
// 	echo $son->getName().'下有'.$son->count().'<br />';
// }
// 类型张志转换把对象转成数组

// print_r((array)$simplexml);

// 把对象转换成数组
function toarray($sim){
	if($sim instanceof simplexmlelement){
		$arr = (array)$sim;
	}else{
		$arr = $sim;
	}
	foreach ($arr as $key => $value) {
		if($value instanceof simplexmlelement || is_array($value)){
			$arr[$key] = toarray($value);
		}
	}
	return $arr;
}

print_r($simplexml);

echo '<br />';

print_r($xmlarr = toarray($simplexml));

?>