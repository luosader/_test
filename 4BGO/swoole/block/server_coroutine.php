<?php
/*服务端 (协程风格)*/

/*TCP*/
//多进程管理模块
// $pool = new Swoole\Process\Pool(2);
$pool = new Swoole\Process\Pool(1); //如果在 Cygwin 环境下运行请修改为单进程。
//让每个OnWorkerStart回调都自动创建一个协程
$pool->set(['enable_coroutine' => true]);
$pool->on("workerStart", function ($pool, $id) {
    //每个进程都监听9501端口
    $server = new Swoole\Coroutine\Server('127.0.0.1', '9501', false, true);
    //收到15信号关闭服务
    Swoole\Process::signal(SIGTERM, function () use ($server) {
        $server->shutdown();
    });
    //接收到新的连接请求
    $server->handle(function (Swoole\Coroutine\Server\Connection $conn) {
        //接收数据
        $data = $conn->recv();
        if (empty($data)) {
            //关闭连接
            $conn->close();
        }
        //发送数据
        $conn->send("hello");
    });
    //开始监听端口
    $server->start();
});
$pool->start();

// /*HTTP*/
// Co\run(function () {
//     $server = new Co\Http\Server("127.0.0.1", 9502, false);
//     $server->handle('/', function ($request, $response) {
//         $response->end("<h1>Index</h1>");
//     });
//     $server->handle('/test', function ($request, $response) {
//         $response->end("<h1>Test</h1>");
//     });
//     $server->handle('/stop', function ($request, $response) use ($server) {
//         $response->end("<h1>Stop</h1>");
//         $server->shutdown();
//     });
//     $server->start();
// });

// /*WebSocket*/
// Co\run(function () {
//     $server = new Co\Http\Server("127.0.0.1", 9502, false);
//     $server->handle('/websocket', function ($request, $ws) {
//         $ws->upgrade();
//         while (true) {
//             $frame = $ws->recv();
//             if ($frame === false) {
//                 echo "error : " . swoole_last_error() . "\n";
//                 break;
//             } else if ($frame == '') {
//                 break;
//             } else {
//                 if ($frame->data == "close") {
//                     $ws->close();
//                     return;
//                 }
//                 $ws->push("Hello {$frame->data}!");
//                 $ws->push("How are you, {$frame->data}?");
//             }
//         }
//     });
//     $server->handle('/', function ($request, $response) {
//         $response->end(<<<HTML
//             <h1>Swoole WebSocket Server</h1>
//             <script>
//             var wsServer = 'ws://127.0.0.1:9502/websocket';
//             var websocket = new WebSocket(wsServer);
//             websocket.onopen = function (evt) {
//                 console.log("Connected to WebSocket server.");
//                 websocket.send('hello');
//             };
//             websocket.onclose = function (evt) {
//                 console.log("Disconnected");
//             };
//             websocket.onmessage = function (evt) {
//                 console.log('Retrieved data from server: ' + evt.data);
//             };
//             websocket.onerror = function (evt, e) {
//                 console.log('Error occured: ' + evt.data);
//             };
//             </script>
// HTML
//         );
//     });
//     $server->start();
// });
