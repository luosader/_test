<?php
//加载GatewayClient。关于GatewayClient参见本页面底部介绍
require_once '/your/path/GatewayClient/Gateway.php';
// GatewayClient 3.0.0版本开始要使用命名空间
use GatewayClient\Gateway;
// 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值(ip不能是0.0.0.0)
Gateway::$registerAddress = '127.0.0.1:1236';

// 向任意uid的网站页面发送数据
Gateway::sendToUid($uid, $message);
// 向任意群组的网站页面发送数据
Gateway::sendToGroup($group, $message);
