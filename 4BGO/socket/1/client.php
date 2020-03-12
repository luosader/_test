<?php
header("Content-type:text/html;charset=utf-8");

// if(extension_loaded('sockets')){
//     if(strtoupper(substr(PHP_OS,0,3)) == 'WIN') {
//         // dl('php_sockets.dll');
//         printf('php_sockets.dll');
//     } else {
//         // dl('sockets.so');
//         printf('sockets.so');
//     }
// } else {
//     printf('通过编辑php.ini打开');die;
// }
?>


<?php 
$sendStr="客户端传递参数为1";
$socket=socket_create(AF_INET,SOCK_STREAM,getprotobyname("tcp"));//建立通道
if(socket_connect($socket,"localhost",1234)){//连接通道
    // socket_getsockname(socket, addr);// 对于客户端来说在connect()以后才固定ip和端口，此时可以调用getsockname()来获得客户端自己的ip和端口号。
    $receiveStr="";
    $receiveStr=socket_read($socket,1024); //读取服务端返回参数
    echo "服务端返回参数:".$receiveStr;
    socket_write($socket,$sendStr,strlen($sendStr));//参数写入通道中
}
socket_close($socket); 
?>