<?php
/**
 * https://github.com/feifeixj/websocket
 * cmd
 *     php D:/WWW/_test/4BGO/websocket/feifeixj/Server_socket.php
 * http://tx.socket/websocket.html
 * @var serverSocket
 */

/**
 * 聊天室服务器  websocket 专用
 */
class serverSocket
{
    private $socket;
    private $accept = [];
    private $hands  = [];

    public function __construct($host, $port, $max)
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, true);
        socket_bind($this->socket, $host, $port);
        socket_listen($this->socket, $max);
        print_r($this->socket);
    }

    public function start()
    {
        $i = 0;
        while (true) {
            $cycle   = $this->accept;
            $cycle[] = $this->socket;
            socket_select($cycle, $write, $except, null);

            foreach ($cycle as $sock) {
                if ($sock == $this->socket) {
                    $this->accept[]    = socket_accept($sock);
                    $arr               = array_keys($this->accept);
                    $key               = end($arr);
                    $this->hands[$key] = false;
                } else {
                    $length = socket_recv($sock, $buffer, 204800, null);
                    $key    = array_search($sock, $this->accept);
                    if (!$this->hands[$key]) {
                        $this->dohandshake($sock, $buffer, $key);
                    } else if ($length < 1) {
                        $this->close($sock);
                    } else {
                        //接收从客户端发送的内容
                        $data = $this->decode($buffer); //解码
                        print_r(PHP_EOL . 'This is the data received from client: ' . $data);

                        //服务器端的内容
                        $data = "This is the data sent by server{$i}, so smart";
                        $data = $this->encode($data); //编码
                        print_r($data);
                        //将信息传递给从机
                        foreach ($this->accept as $client) {
                            socket_write($client, $data, strlen($data));
                        }
                        $i++;
                    }
                }
            }
            sleep(1); //降低cpu使用率
        }
    }

    /**
     * 首次与客户端握手
     */
    public function dohandshake($sock, $data, $key)
    {
        if (preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $data, $match)) {
            $response = base64_encode(sha1($match[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
            $upgrade  = "HTTP/1.1 101 Switching Protocol\r\n" .
                "Upgrade: websocket\r\n" .
                "Connection: Upgrade\r\n" .
                "Sec-WebSocket-Accept: " . $response . "\r\n\r\n";
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
        } else if ($len === 127) {
            $masks = substr($buffer, 10, 4);
            $data  = substr($buffer, 14);
        } else {
            $masks = substr($buffer, 2, 4);
            $data  = substr($buffer, 6);
        }
        for ($index = 0; $index < strlen($data); $index++) {
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
        } else if ($length <= 65535) {
            return "\x81" . chr(126) . pack('n', $length) . $buffer;
        } else {
            return "\x81" . char(127) . pack('xxxxN', $length) . $buffer;
        }
    }
}

$ws = new serverSocket('127.0.0.1', 2020, 20); //192.168.0.212
$ws->start();
// sleep(2);
