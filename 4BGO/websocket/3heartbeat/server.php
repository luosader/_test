<?php
/**
 * WebSocket 服务端
 * 业务目标：
 *     防阻塞：非阻塞模式
 *     安全验证
 *     服务端指定推送
 *     长连接必须加心跳
 *     client在线统计
 *     分组、点对点交流
 * Workerman 基于 socket，
 */
// error_reporting(E_ALL ^ E_NOTICE);
// ob_implicit_flush();

/*实例化*/
$ws = new WS('192.168.0.212', 2020, 5);
$ws->run();

class WS
{
    private $master; // 连接 server 的 client
    private $sockets = []; //记录连接进来client的socket信息组
    private $hands   = []; //标志socket资源握手状态组

    public function __construct($host, $port, $backlog = 2)
    {
        // 建立一个 socket 套接字
        $this->master = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('socket_create() failed');
        socket_set_option($this->master, SOL_SOCKET, SO_REUSEADDR, 1) or die('socket_option() failed'); //1 表示接受所有的数据包
        socket_bind($this->master, $host, $port) or die('socket_bind() failed');
        socket_listen($this->master, $backlog) or die('socket_listen() failed'); //$backlog queue队列限制长度
    }

    // 启动服务
    public function run()
    {
        print_r('start:' . PHP_EOL);
        // 设计一个循环挂起WebSocket的通道，进行数据的接收、处理和发送
        while (true) {
            $cycle   = $this->sockets; //已有
            $cycle[] = $this->master; //当前
            // $write = null;$except = null;
            socket_select($cycle, $write, $except, null);
            foreach ($cycle as $sock) {
                if ($sock == $this->master) {
                    // print_r('opener');
                    // 处理新进来的client连接
                    // 接受一个socket连接
                    $new = socket_accept($this->master);
                    // 给新连接进来的socket一个唯一的ID
                    $ukey = uniqid(); //如何区分Admin和User？ => 在open后可session或重新ukey
                    // 保存open记录：
                    $this->sockets[$ukey] = $new; //将新连接进来的socket存进连接池
                    $this->hands[$ukey]   = false; //将新加入的socket标记为未握手状态
                } else {
                    // 1.首次与客户端握手; 2.为client断开socket连接; 3.消息处理;

                    // 读取该socket的信息，注意：第二个参数是引用传参即接收数据，第三个参数是接收数据的长度
                    $length = socket_recv($sock, $buffer, 204800, null);
                    // $length = 0;
                    // $buffer = '';
                    // do {
                    //     $l = socket_recv($sock, $buf, 1000, 0);
                    //     $length += $l;
                    //     $buffer .= $buf;
                    // } while ($l == 1000);

                    // 查找user池里对应的key
                    $ukey = array_search($sock, $this->sockets);

                    if ($length < 1) {
                        // 给该client的socket进行断开操作，并删除相关记录
                        $this->close($sock, $ukey);
                    } elseif (!$this->hands[$ukey]) {
                        $this->dohandshake($sock, $buffer, $ukey);
                    } else {
                        // 处理从机发来的内容 slave
                        $from = $this->decode($buffer); //解码
                        if (!$from) {continue;}
                        if ($from == 'ping') {
                            // $this->send('pong');
                            $this->send('pong', $sock);
                            // socket_write($sock, 'pong', 4);
                            continue;
                        }
                        $from = json_decode($from, true);
                        if ($from['code'] == 'admin') {
                            print_r(PHP_EOL . 'From Admin => ' . $from['title'] . '：' . $from['body']);
                            if ($from['event'] == 'push') {
                                $to = [
                                    'code'  => 'client',
                                    'title' => $from['title'],
                                    'body'  => $from['body'],
                                    'tag'   => $from['tag'],
                                    'icon'  => $from['icon'],
                                ];
                                // $this->send($to, '' , [$sock]);
                                $this->send($to);
                            }
                        } elseif ($from['code'] == 'client') {
                            print_r(PHP_EOL . 'From Client_' . $ukey . ' => ' . $from['title'] . '：' . $from['body']);
                            if ($from['event'] == 'open') {
                                // 消息推送给相关Admin 在线人数更新
                                // $total = count($this->sockets);
                                // $to    = ['code' => 'admin', 'title' => $from['title'], 'body' => $from['body'], 'total' => $total];
                                // $this->send($to);
                            }
                        } else {
                            print_r(PHP_EOL . '意外断开！');
                        }
                    }
                }
            }
            // sleep(1); // 降低cpu使用率
        }
    }

    // 首次与客户端握手
    public function dohandshake($sock, $data, $key)
    {
        if (preg_match("/Sec-WebSocket-Key: (.*)\r\n/i", $data, $match)) {
            // 需要将 Sec-WebSocket-Key 值累加字符串，并依次进行 SHA-1 加密和 base64 加密
            $response = base64_encode(sha1($match[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
            // 拼凑响应内容
            // Upgrade: websocket => 是固定的，告诉客户端即将升级的是Websocket协议，而不是mozillasocket，lurnarsocket或者shitsocket
            // Sec-WebSocket-Accept: 这个则是经过服务器确认，并且加密过后的 Sec-WebSocket-Key,也就是client要求建立WebSocket验证的凭证
            // . 'WebSocket-Location: ws://127.0.0.1:9090' . PHP_EOL
            $upgrade = 'HTTP/1.1 101 Switching Protocol' . PHP_EOL
                . 'Upgrade: websocket' . PHP_EOL
                . 'Connection: Upgrade' . PHP_EOL
                . 'Sec-WebSocket-Accept: ' . $response . PHP_EOL . PHP_EOL; //这里两个换行
            // 向客户端应答 Sec-WebSocket-Accept
            socket_write($sock, $upgrade, strlen($upgrade));
            $this->hands[$key] = true;
        }
    }
    /**
     * 主动推送给相关客户机
     * @param  array  $data    待发送的数据
     * @param  string/array $group 指定发送对象 resource
     * @param  array  $exclude 排除的对象
     */
    public function send($data = [], $group = '', $exclude = [])
    {
        $data   = $this->encode(json_encode($data)); //编码
        $length = strlen($data); //mb_strlen()
        // $group  = $group ?: $this->sockets;
        // $exclude = $exclude ?: [$this->master];

        if ($group && !is_array($group)) {
            socket_write($group, $data, $length);
        } else {
            // $this->sockets 中理应不包括发起者本身
            foreach ($this->sockets as $client) {
                if ($exclude && !in_array($client, $exclude)) {
                    socket_write($client, $data, $length);
                } else {
                    socket_write($client, $data, $length);
                }
            }
        }
    }

    // 关闭一个客户端连接
    public function close($sock, $key = null)
    {
        $key = $key ?: array_search($sock, $this->sockets);
        socket_close($sock);
        unset($this->sockets[$key]);
        unset($this->hands[$key]);
    }

    // 字符解码
    protected function decode($buffer)
    {
        $len = $masks = $data = $decoded = null;
        $len = ord($buffer[1]) & 127;
        if ($len === 126) {
            $masks = substr($buffer, 4, 4);
            $data  = substr($buffer, 8);
        } elseif ($len === 127) {
            $masks = substr($buffer, 10, 4);
            $data  = substr($buffer, 14);
        } else {
            $masks = substr($buffer, 2, 4);
            $data  = substr($buffer, 6);
        }
        $length = strlen($data);
        for ($index = 0; $index < $length; $index++) {
            $decoded .= $data[$index] ^ $masks[$index % 4];
        }
        return $decoded;
    }

    // 字符编码
    protected function encode($buffer)
    {
        $length = strlen($buffer);
        if ($length <= 125) {
            return "\x81" . chr($length) . $buffer;
        } elseif ($length <= 65535) {
            return "\x81" . chr(126) . pack('n', $length) . $buffer;
        } else {
            return "\x81" . char(127) . pack('xxxxN', $length) . $buffer;
        }
    }
}
