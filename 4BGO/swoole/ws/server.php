<?php
// 握手
// https://github.com/matyhtf/framework/blob/master/libs/Swoole/Client/WebSocket.php

$ws = new Swoole\WebSocket\Server('127.0.0.1', 9503);

$ws->on('open', function ($ws, $request) {
    var_dump($request->fd, $request->get, $request->server);
    $ws->push($request->fd, "hello, welcome\n");
});
$ws->on('message', function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    $ws->push($frame->fd, "server: {$frame->data}");
});
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});
$ws->start();