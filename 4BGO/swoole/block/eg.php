<?php

/*$host = '0.0.0.0';
$port = 0;
$mode = SWOOLE_PROCESS;
$sockType = SWOOLE_SOCK_TCP;
$server = new \Swoole\Server($host, $port, $mode, $sockType);

// 您可以混合使用UDP/TCP，同时监听内网和外网端口，多端口监听参考 addlistener小节。
$server->addlistener("127.0.0.1", 9502, SWOOLE_SOCK_TCP); // 添加 TCP
$server->addlistener("192.168.0.212", 9503, SWOOLE_SOCK_TCP); // 添加 Web Socket
$server->addlistener("0.0.0.0", 9504, SWOOLE_SOCK_UDP); // UDP
// $server->addlistener("/var/run/myserv.sock", 0, SWOOLE_UNIX_STREAM); //UnixSocket Stream
// $server->addlistener("127.0.0.1", 9502, SWOOLE_SOCK_TCP | SWOOLE_SSL); //TCP + SSL
$port = $server->addListener("0.0.0.0", 0, SWOOLE_SOCK_TCP); // 系统随机分配端口，返回值为随机分配的端口
echo $port->port;*/

/*sendMessage() 向Worker发送数据*/
$server = new Swoole\Server('0.0.0.0', 9501);
$server->set(array(
    'worker_num'      => 5,
    'task_worker_num' => 5,
));
$server->on('pipeMessage', function($server, $src_worker_id, $data) {
    echo "#{$server->worker_id} message from #$src_worker_id: $data\n";
});
$server->on('task', function($server, $task_id, $reactor_id, $data) {
    var_dump($task_id, $reactor_id, $data);
});
$server->on('finish', function($server, $fd, $reactor_id) {

});
$server->on('receive', function(Swoole\Server $server, $fd, $reactor_id, $data) {
    print_r($data);
    if (trim($data) == 'task') {
        $server->task("async task coming");
    } else {
        $worker_id = 1 - $server->worker_id;
        $server->sendMessage("hello task process", $worker_id);
    }
});
$server->start();

/*bind() 绑定一个用户定义的 UID*/
// $serv         = new Swoole\Server("0.0.0.0", 9501);
// $serv->fdlist = [];
// $serv->set(array(
//     'worker_num'    => 4,
//     'dispatch_mode' => 5, //uid dispatch
// ));
// $serv->on('connect', function($serv, $fd, $reactor_id) {
//     //echo "[#".posix_getpid()."]\tClient@[$fd:$reactor_id]: Connect.\n";
//     echo "{$fd} connect, worker:" . $serv->worker_id . PHP_EOL;
// });
// $serv->on('receive', function(Swoole\Server $serv, $fd, $reactor_id, $data) {
//     $conn = $serv->connection_info($fd);
//     print_r($conn);
//     echo "worker_id: " . $serv->worker_id . PHP_EOL;
//     if (empty($conn['uid'])) {
//         $uid = $fd + 1;
//         if ($serv->bind($fd, $uid)) {
//             $serv->send($fd, "bind {$uid} success");
//         }
//     } else {
//         if (empty($serv->fdlist[$fd])) {
//             $serv->fdlist[$fd] = $conn['uid'];
//         }
//         print_r($serv->fdlist);
//         foreach ($serv->fdlist as $_fd => $uid) {
//             $serv->send($_fd, "{$fd} say:" . $data . PHP_EOL);
//         }
//     }
// });
// $serv->on('close', function($serv, $fd, $reactor_id) {
//     //echo "[#".posix_getpid()."]\tClient@[$fd:$reactor_id]: Close.\n";
//     unset($serv->fdlist[$fd]);
// });
// $serv->start();

/*task() 投递一个异步任务到 task_worker 池中。此函数是非阻塞的，执行完毕会立即返回。*/
// $server = new Swoole\Server("127.0.0.1", 9501, SWOOLE_BASE);
// $server->set(array(
//     'worker_num'      => 2,
//     'task_worker_num' => 4,
// ));
// $server->on('Receive', function(Swoole\Server $server, $fd, $from_id, $data) {
//     echo "接收数据" . $data . "\n";
//     $data = trim($data);
//     $server->task($data, -1, function(Swoole\Server $server, $task_id, $data) {
//         echo "Task Callback: ";
//         var_dump($task_id, $data);
//     });
//     $task_id = $server->task($data, 0);
//     $server->send($fd, "分发任务，任务id为$task_id\n");
// });
// $server->on('Task', function(Swoole\Server $server, $task_id, $from_id, $data) {
//     echo "Tasker进程接收到数据";
//     echo "#{$server->worker_id}\tonTask: [PID={$server->worker_pid}]: task_id=$task_id, data_len=" . strlen($data) . "." . PHP_EOL;
//     $server->finish($data);
// });
// $server->on('Finish', function(Swoole\Server $server, $task_id, $data) {
//     echo "Task#$task_id finished, data_len=" . strlen($data) . PHP_EOL;
// });
// $server->on('workerStart', function($server, $worker_id) {
//     global $argv;
//     if ($worker_id >= $server->setting['worker_num']) {
//         swoole_set_process_name("php {$argv[0]}: task_worker");
//     } else {
//         swoole_set_process_name("php {$argv[0]}: worker");
//     }
// });
// $server->start();

/*heartbeat() 与 heartbeat_check_interval 的被动检测不同，此方法主动检测服务器所有连接，并找出已经超过约定时间的连接。*/