<?php
// header('Content-Type:text/html;charset=UTF-8');
header('Content-Type:text/html;charset=gbk');
/**
 * �������裺
��ʼ��86socket
�˿ڰ�
�˿ڽ��м���
����accept����
�ȴ��ͷ�������
 */

echo "****************server*****************\r\n";
//���� IP �� �˿ڣ��˿ڱ��뱣֤����ռ�ã��������ⲿ���ʣ�
$ip   = "127.0.0.1";
$port = 1935;
//��ʱ���
set_time_limit(0);
//����socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("����socketʧ�ܣ�ԭ��Ϊ��{socket_strerror($socket)}\r\n");
//��socket��ָ��ip�Ͷ˿�
$ret = socket_bind($socket, $ip, $port) or die("��socketʧ�ܣ�ԭ��Ϊ��{socket_strerror($ret)}\r\n");
//����socket,���ȴ���Ϊ4
$ret = socket_listen($socket, 4) or die("����socketʧ�ܣ�ԭ��Ϊ��{socket_strerror($ret)}\r\n");
//����
$count = 0;
echo "�ȴ�����!!!\r\n";
do {
    //�յ���������
    //������socket������Ϣ
    $msgsock = socket_accept($socket);
    if (!$msgsock) {
        echo "socket����ʧ�ܣ�ԭ��Ϊ��{socket_strerror($msgsock)}\r\n";
    }
    $msg = "<p style='color:red'>���ӳɹ�</p>";
    //����ͻ������벢��������
    socket_write($msgsock, $msg, strlen($msg));
    $buf      = socket_read($msgsock, 8192);
    $talkback = "�յ�����ϢΪ��{$buf}\r\n";
    echo $talkback;
    if (++$count > 5) {
        break;
    }
    socket_close($msgsock);
} while (true);

socket_close($socket);
