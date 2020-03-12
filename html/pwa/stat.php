<?php
/**
 * 统计服务器
 * igvault/app.js
 */
$data = $_GET;
file_put_contents(getcwd().'/log.txt', $data);

echo json_encode($data);exit;