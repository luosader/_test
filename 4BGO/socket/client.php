<?php
// error_reporting(6143);
// header('Content-Type:text/html;charset=UTF-8');
header('Content-Type:text/html;charset=gbk');
/**
 * �������裺
ʹ��TCPЭ�鴴��һ��socket��Դ
����socket������
socket_write ��������
socket_read ��������
�ر�socket��Դ
 */
echo '****************client*****************<br/>';
//���� IP �� �˿�
$port = 1935;
$ip   = '127.0.0.1';
//��ʱ���
set_time_limit(0);
//����TCPЭ���socket��Դ
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('socket_create ʧ�ܣ�' . socket_strerror($socket));
echo '�����ɹ�<br/>';
$restult = socket_connect($socket, $ip, $port);
echo '���ӳɹ�<br/>';

$in = '����һ��sokcet�ͷ��˳ɹ���������=' . rand(1000, 9999);
if (socket_write($socket, $in, strlen($in))) {
    echo '���ͳɹ���������ϢΪ' . $in . '<br/>';
} else {
    echo '����ʧ�ܣ�ԭ��Ϊ' . socket_strerror($socket) . '<br/>';
}
while ($out = socket_read($socket, 8192)) {
    echo '������Ϣ�ɹ�����ϢΪ' . $out . '<br/>';
}

echo 'socket�ر�<br/>';
socket_close($socket);
echo '�ر����<br/>';
