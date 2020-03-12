<?php
// XML转对象
// SimpleXML 函数是 PHP 核心的组成部分。无需安装即可使用这些函数。 
if (file_exists('books.xml')){
	$xmlobj = simplexml_load_file("books.xml");
}else{
	exit('Error.');
}


echo "<pre>";
$count = count($xmlobj);
// var_dump($xmlobj);
// var_dump($xmlobj->book[1]);

$a = explode(',', 'a_啊,b_吧,c_查,d,e');
foreach ($a as $k => $v) {	
	$b[] = explode('_', $a[$k]);
}
// $xmlarr = objectToArray($xmlobj);
$xmlarr = obj_arr($xmlobj);
var_dump($xmlarr);

// 获取属性值
// echo $xmlobj->book[0]->title;
// $xmlattr = $xmlobj->book[0]->author->attributes();
// $xmlattr = $xmlobj->book[1]->description->attributes();
// var_dump($xmlattr);

// foreach($xmlattr AS $a => $b) {
// 	echo "$a = $b <br />";
// }





//对象递归转化数组
// function obj2arr($obj){
// 	$newArray=array();
// 	foreach($obj as $key=>$val){
// 		if(is_object($val)){
// 			$newArray[$key]=obj2arr($val);
// 		}else{
// 			$newArray[$key]=$val;
// 		}
// 	}
// 	return $newArray;
// }

function obj_arr($data) {
	if(is_object($data)) {
		$data = (array)$data;
	}
	if(is_array($data)) {
		foreach($data as $key=>$value) {
			$data[$key] = obj_arr($value);
		}
	}
	return $data;
} 

// 一维数组转为对象
function array2object($array) {
	if (is_array($array)) {
		$obj = new StdClass();
		foreach ($array as $key => $val){
			$obj->$key = $val;
		}
	} else { $obj = $array; }
	return $obj;
}
// 一维对象转为数组
function object2array($object) {
	if (is_object($object)) {
		foreach ($object as $key => $value) {
			$array[$key] = $value;
		}
	} else { $array = $object; }
	return $array;
}

//对象转数组,使用get_object_vars返回对象属性组成的数组
function objectToArray($obj){
	$arr = is_object($obj) ? get_object_vars($obj) : $obj;
	if(is_array($arr)){
		return array_map(__FUNCTION__, $arr);
	}else{
		return $arr;
	}
}

//数组转对象
function arrayToObject($arr){
	if(is_array($arr)){
		return (object) array_map(__FUNCTION__, $arr);
	}else{
		return $arr;
	}
}
?>