<?php
header('Content-Type:text/html;charset=UTF-8'); //设置文本类型和编码
date_default_timezone_set('PRC'); //时区设置
session_start(); //全局会话

$link = mysql_connect('localhost', 'root', 'root'); //打开数据库,我的localhost:8888????
mysql_select_db('33hao', $link) or die('无法连接数据库:' . mysql_error()); //进入数据库中的某个具体库。
// echo "成功连接数据库";
mysql_set_charset('utf8'); //设置数据库编码
// mysql_query("set names utf8");//和上面一样

$keywords = $_GET['keywords'];
if (!$keywords) {
    echo '搜索框不能为空';exit;
}
$keywords = mysql_escape_string($keywords);

$sql = 'select * from 33hao_member where member_name like "%' . $keywords . '%";  ';
// $sql = 'select * from 33hao_member where inviter_id="'.$keywords.'";  ';
// var_dump($today);
$result = mysql_query($sql);
$now    = mysql_num_rows($result);
var_dump($now);

// var_dump(mysql_num_rows($result)) ;
// if (!mysql_num_rows($result)) {
//     echo '没有数据';
//     exit;
// }
// $result=mysql_query($sql);
// while ($row=mysql_fetch_array($result)) {
//     echo $row['name'];
//     echo "<br/>";
// }
// mysql_close($con);
