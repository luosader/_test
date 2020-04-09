<?php
/**
 * TCP 服务器
 * https://wiki.swoole.com/#/start/start_tcp_server
 */

//创建Server对象，监听 127.0.0.1:9501端口
$serv = new Swoole\Server("127.0.0.1", 9501);

//监听连接进入事件
$serv->on('Connect', function ($serv, $fd) {
    echo "Client: Connect.\n";
});

//监听数据接收事件
$serv->on('Receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Server: " . $data);
});

//监听连接关闭事件
$serv->on('Close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$serv->start();


// 测试： php server.php
// telnet/netcat 工具连接服务器。
// telnet 127.0.0.1 9501
// hello
// Server: hello
