<?php
header('Content-Type:text/html;charset=UTF-8');
/**
 * 基本步骤：
初始化86socket
端口绑定
端口进行监听
调用accept阻塞
等待客服端连接
 */
//超时设计
set_time_limit(0);

echo "**************** server *****************\r\n";
//设置 IP 和 端口（端口必须保证不被占用，且允许被外部访问）
$host = '127.0.0.1';
$port = 1935;
//创建socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("创建socket失败，原因为：{socket_strerror($socket)}\r\n");
//绑定socket到指定ip和端口
$ret = socket_bind($socket, $host, $port) or die("绑定socket失败，原因为：{socket_strerror($ret)}\r\n");
//监听socket,最大等待数为4
$ret = socket_listen($socket, 4) or die("监听socket失败，原因为：{socket_strerror($ret)}\r\n");
//计数
$count = 0;
echo "等待连接!!!\r\n";
do {
    //收到请求连接
    //调用子socket处理信息
    $msgsock = socket_accept($socket);
    if (!$msgsock) {
        echo "socket阻塞失败，原因为：{socket_strerror($msgsock)}\r\n";
    }
    //处理客户端输入并返回数据
    $msg = "<p style='color:red'>连接成功</p>";
    socket_write($msgsock, $msg, strlen($msg));
    $buf      = socket_read($msgsock, 8192);
    $talkback = "收到的信息为：{$buf}\r\n";
    echo $talkback;
    if (++$count > 5) {
        break;
    }
    socket_close($msgsock);
} while (true);

socket_close($socket);
