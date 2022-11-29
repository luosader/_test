<?php 

// 一维数组转xml
// 思路：
// 循环数组的每个单元，加入到xml的文档节点中
// $arr = array(
// 	'name' => '丁三',
// 	'age'  => '29', 
// 	);
// $arr = array
//   (
//   'test1'=>array('name'=>"Volvo",'year'=>22,'age'=>18),
//   'test2'=>array('name'=>"BMW",'year'=>15,'age'=>13),
//   'test3'=>array('name'=>"Saab",'year'=>5,'age'=>2),
//   'test4'=>array('name'=>"Land Rover",'year'=>17,'age'=>15)
//   );

$arr=Array
(
    "test1" => Array
        (
            "seller_credit" => Array
                (
                    "total_num" => 373405,
                    "level" => 15,
                    "good_num" => 368452,
                    "score" => 367826,
                )
        ),
    "test2" => Array
        (
            "seller_credit" => Array
                (
                    "total_num" => 36409,
                    "level" => 12,
                    "good_num" => 36091,
                    "score" => 36042,
                )
        )
);
$simplexml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><root></root>');
function arr2xml($arr,simplexmlelement $simplexml){
	
	foreach ($arr as $key => $value) {
		if(is_array($value)){
			$sim = $simplexml->addChild($key);
			arr2xml($value,$sim);
		}else{
			$simplexml->addChild($key,$value);
		}
		
	}
	return $simplexml->saveXML();
}
header('content-type:text/xml');
echo arr2xml($arr,$simplexml);
?>