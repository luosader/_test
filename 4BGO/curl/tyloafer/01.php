
<?php 
ob_start();
header("Content-type: text/html; charset=utf-8"); 
$curl = curl_init();

// curl_setopt($curl,CURLOPT_URL,"http://www.php100.com");
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// $name = 'test';
// $pass = 'test';
// // $curlPost = "name=$name&pass=$pass";

// curl_setopt($curl, CURLOPT_URL, "http://www.wincomtech.cn/");
// curl_setopt($curl,CURLOPT_RETURNTRANSFER,0);   // 0表示输出 1表示不输出
// // curl_setopt($curl,CURLOPT_GET,1);
// // curl_setopt($curl,CURLOPT_POSTFIELDS,$curlPost);
// curl_setopt($curl,CURLOPT_HEADER,0);
// $data = curl_exec($curl);
// // header("content-type:text/html;charset=utf-8");
// // echo $data;
// // var_dump($data);
// curl_close($curl);


//模拟post提交数据

$message = 'this is posted by curl';
$phone = '1252562562';
$test = array('message' =>$message , 'phone'=>$phone);
curl_setopt($curl,CURLOPT_URL,'http://localhost/tyloafer/curl/target.php');
curl_setopt($curl,CURLOPT_POST,1);
curl_setopt($curl,CURLOPT_POSTFIELDS,$test);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,0);
$data = curl_exec($curl);

curl_close($curl);



?>