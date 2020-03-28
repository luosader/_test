<?php
/**
 * cmd
 *     php D:/WWW/_test/4BGO/s_to_c/server.php
 * http://tx.socket/admin.html
 * @var serverSocket
 */
// ini_set('display_errors','1');
// error_reporting(E_ALL ^ E_NOTICE);
error_reporting(0);

/**
 * 聊天室服务器  websocket 专用
 */
class serverSocket
{
    private $socket;
    private $accept = [];
    private $hands  = [];

    // client与server之间建立socket通信，首先在PHP中创建socket并监听端口信息
    // 传相应的IP与端口进行创建socket操作
    public function __construct($host, $port, $max)
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, true); //true表示接受所有的数据包
        socket_bind($this->socket, $host, $port);
        socket_listen($this->socket, $max); //$max队列最大数
        print_r($this->socket);
    }

    // 设计一个循环挂起WebSocket的通道，进行数据的接收、处理和发送
    public function start()
    {
        $i = 0;
        // 死循环，直到socket断开
        while (true) {
            $cycle   = $this->accept; //已有
            $cycle[] = $this->socket; //增加

            /**
             * socket_select($sockets, $write = NULL, $except = NULL, NULL);
             * 这个函数是同时接受多个连接的关键，我的理解它是为了阻塞程序继续往下执行。因为客户端是长连接，如果客户端非正常断开，服务端会在 socket_accept 阻塞，现在使用 select 非阻塞模式 socket
             * $sockets可以理解为一个数组，这个数组中存放的是文件描述符。当它有变化（就是有新消息到或者有客户端连接/断开）时，socket_select函数才会返回，继续往下执行。
             * $write是监听是否有客户端写数据，传入NULL是不关心是否有写变化。
             * $except是$sockets里面要被排除的元素，传入NULL是”监听”全部。
             * 最后一个参数是超时时间
             *     0:则立即结束;n>1:则最多在n秒后结束，如遇某一个连接有新动态，则提前返回;null:如遇某一个连接有新动态，则返回;
             */
            socket_select($cycle, $write = null, $except = null, null);

            foreach ($cycle as $sock) {
                if ($sock == $this->socket) {
                    //有新的client连接进来

                    $this->accept[] = socket_accept($sock); //接受一个socket连接

                    $arr = array_keys($this->accept); //键名数组
                    $key = end($arr); //输出最后一个元素的值
                    // 将新加入的client标记为未握手状态
                    $this->hands[$key] = false;
                } else {
                    // 1.首次与客户端握手; 2.为client断开socket连接; 3.消息处理;

                    $length = socket_recv($sock, $buffer, 204800, null); //读取该socket的信息，注意：第二个参数是引用传参即接收数据，第三个参数是接收数据的长度
                    $key    = array_search($sock, $this->accept);
                    if (!$this->hands[$key]) {
                        $this->dohandshake($sock, $buffer, $key);
                    } elseif ($length < 1) {
                        $this->close($sock);
                    } else {
                        //接收客户端发来的内容
                        $data = $this->decode($buffer); //解码
                        if ($data == 'admin') {
                            print_r(PHP_EOL . 'From Admin Operation');

                            //管理员操作 - 推送服务端的内容
                            $data = "This is the data sent by server{$i}";
                            $data = $this->encode($data); //编码
                            //将信息传递给从机
                            // var_export(array_keys($this->accept));
                            foreach ($this->accept as $client) {
                                socket_write($client, $data, strlen($data));
                            }
                            $i++;
                        } elseif ($data == 'client') {
                            print_r(PHP_EOL . 'From Client Operation');

                            // // 用户操作
                            // 区分客户机：1、通过HttpSession值；2、@PathParam获取用户对象。
                            // $data = 'user action';
                            // $data = $this->encode($data); //编码
                        } elseif ($data == 'open') {
                            print_r(PHP_EOL . '有新连接加入！ ip:');
                        } else {
                            print_r(PHP_EOL . 'This is the data received from client:' . PHP_EOL . $data);
                        }
                    }
                }
            }
            sleep(1);
        }
    }

    /**
     * 首次与客户端握手
     */
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
     * 关闭一个客户端连接
     */
    public function close($sock)
    {
        $key = array_search($sock, $this->accept);
        socket_close($sock);
        unset($this->accept[$key]);
        unset($this->hands[$key]);
    }

    /**
     * 字符解码
     */
    public function decode($buffer)
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

    /**
     * 字符编码
     */
    public function encode($buffer)
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

/*实例化*/
$host = '192.168.0.212'; //192.168.0.212
$ws   = new serverSocket($host, 2020, 20);
$ws->start();
sleep(2);
