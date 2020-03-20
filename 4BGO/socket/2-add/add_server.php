<?php

$host = '127.0.0.1';
$port = 1935;
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$ret = socket_bind($socket, $host, $port);
$ret = socket_listen($socket, 4);

$count = 0;
do {
    $msgsock = socket_accept($socket);
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