<?php
/**
 * 订阅服务器
 * igvault/app.js
 */
$post = $_POST;

file_put_contents(getcwd().'/log.txt', var_export($post,true));

// echo json_encode($post);exit;

$data = '{body:\'Message\'}';
echo $data;exit;