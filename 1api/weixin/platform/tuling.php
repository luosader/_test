<?php 
$content = '卧槽';
$key = 'e5f9b61b6ea642b1ae43468e44dc843a';
$url = "http://www.tuling123.com/openapi/api?key=$key&info=$content";
$str = file_get_contents($url);
$result = json_decode($str);

echo $result->text;


 ?>