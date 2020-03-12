<?php
$sendStr = "我是服务端参数2";
$socket  = socket_create(AF_INET, SOCK_STREAM, getprotobyname("tcp")); //建立通道
socket_bind($socket, "localhost", 1234); //绑定要监听的端口

if (socket_listen($socket)) {
    //监听端口
    $receiveSocket = socket_create(AF_INET, SOCK_STREAM, getprotobyname("tcp"));
    $receiveSocket = socket_accept($socket);
    socket_getpeername(socket, address); // 服务器调用accept()接受客户端连接请求，就在此时又分配了ip和端口用于服务器与客户端进行通信，每调用一次accept（）就分配一对ip和端口用于通信，服务器调用getpeername（）获得客户端的ip和端口号
    socket_write($receiveSocket, $sendStr, strlen($sendStr)); //写如通道
    $receiveStr = "";
    $receiveStr = socket_read($receiveSocket, 1024); //读取通道
    echo "客户端传入:" . $receiveStr;
}
socket_close($receiveSocket);
socket_close($socket);
