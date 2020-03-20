<?php

$host = '127.0.0.1';
$port = 1935;
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$result = socket_connect($socket, $host, $port);

$in = '创建一个sokcet客服端成功，随机编号 = ' . rand(1000, 9999);
if (socket_write($socket, $in, strlen($in))) {
    echo '发送成功，发送信息为：' . $in . "\r\n";
} else {
    echo '发送失败，原因为：' . socket_strerror($socket) . "\r\n";
}
while ($out = socket_read($socket, 8192)) {
    echo '接收信息成功，信息为：' . $out . "\r\n";
}

socket_close($socket);