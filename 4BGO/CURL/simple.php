<?php
header('Content-Type:text/html;charset=UTF-8');

// sleep(1);

$ch = curl_init();

// $curl_opt = array(CURLOPT_URL, 'http://www.example.com/backend.php',
// 	CURLOPT_RETURNTRANSFER, 1,
// 	CURLOPT_TIMEOUT, 1,);
echo "CURL start：<br>";
$curl_opt = array(CURLOPT_URL,'backend.php',CURLOPT_RETURNTRANSFER,1,CURLOPT_TIMEOUT,1,);
curl_setopt_array($ch, $curl_opt);
curl_exec($ch);
curl_close($ch);
echo "CURL End。<br>";


?>