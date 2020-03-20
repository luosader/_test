<?php
// error_reporting(6143);
header('Content-Type:text/html;charset=UTF-8');
/**
 * 基本步骤：
使用TCP协议创建一个socket资源
连接socket服务器
socket_write 传输数据
socket_read 接收数据
关闭socket资源
 */
echo "**************** client *****************\r\n";
//设置 IP 和 端口
$host = '127.0.0.1';
$port = 1935;
//超时设计
set_time_limit(0);
//创建TCP协议的socket资源
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('socket_create 失败：' . socket_strerror($socket));
echo "创建成功\r\n";
$result = socket_connect($socket, $host, $port);
echo "连接成功\r\n";

$in = '创建一个sokcet客服端成功，随机编号 = ' . rand(1000, 9999);
if (socket_write($socket, $in, strlen($in))) {
    echo '发送成功，发送信息为：' . $in . "\r\n";
} else {
    echo '发送失败，原因为：' . socket_strerror($socket) . "\r\n";
}
while ($out = socket_read($socket, 8192)) {
    echo '接收信息成功，信息为：' . $out . "\r\n";
}

echo "socket关闭\r\n";
socket_close($socket);
echo "关闭完成\r\n";