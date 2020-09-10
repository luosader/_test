<?php
//加载GatewayClient。关于GatewayClient参见本页面底部介绍
require_once '/your/path/GatewayClient/Gateway.php';
// GatewayClient 3.0.0版本开始要使用命名空间
use GatewayClient\Gateway;
// 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值(ip不能是0.0.0.0)
Gateway::$registerAddress = '127.0.0.1:1236';

// 假设用户已经登录，用户uid和群组id在session中
$uid      = $_SESSION['uid'];
$group_id = $_SESSION['group'];
// client_id与uid绑定
Gateway::bindUid($client_id, $uid);
// 加入某个群组（可调用多次加入多个群组）
Gateway::joinGroup($client_id, $group_id);
