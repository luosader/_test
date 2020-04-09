<?php
/**
 * WebSocket 服务器
 * https://wiki.swoole.com/#/start/start_ws_server
 */

//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new Swoole\WebSocket\Server("0.0.0.0", 9502);

//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    var_dump($request->fd, $request->get, $request->server);
    $ws->push($request->fd, "hello, welcome\n");
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    $ws->push($frame->fd, "server: {$frame->data}");
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();

// 测试: php ws_server.php
// 可以使用 Chrome 浏览器进行测试，JS 代码为：
// var wsServer = 'ws://127.0.0.1:9502';
// var websocket = new WebSocket(wsServer);
// websocket.onopen = function (evt) {
//     console.log("Connected to WebSocket server.");
// };
// websocket.onclose = function (evt) {
//     console.log("Disconnected");
// };
// websocket.onmessage = function (evt) {
//     console.log('Retrieved data from server: ' + evt.data);
// };
// websocket.onerror = function (evt, e) {
//     console.log('Error occured: ' + evt.data);
// };
