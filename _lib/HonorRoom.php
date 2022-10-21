<?php
### 荣誉室
$k='a';$v='1';$a = "{$k}={$v}$a&";echo $a; //变量解析

echo 8/2*(2+2); //16
echo 1|2|4|8; //位运算符
echo 1 <=> 2; //PHP7+太空船操作符
$id = [1]; var_dump($id>1); //比较判断
$a=null; print_r(is_null($a)?:'b'); //三目运算。is_null($a)作为值返回
$a = null; dump($a>-1); //false dump($a==0); //true
echo sprintf('sn_%04d', rand(0,999)); //生成4位数，不足前面补0
implode(array('name'=>'lothar','sex'=>1)); //无缝拼接
$cool='A'; $cool++; echo $cool; //字母亦可以递增，“A”的ASCII码为65
$c = 'z'; echo ++$c . "\n"; //aa的字典顺序是小于z的
$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ#'; echo $chars[0],$chars{1},PHP_EOL; //连着写，dump也可以; 字符串当作数组取值;

$a=[['name'=>'张三'],['name'=>'李四','age'=>1]];
array_walk($a,function(&$v,$k,$p){$v=array_merge($v,$p);},array('age'=>19)); //遍历

$otk = function($data,$msg='Empty!') use ($a) {if (!$data)echo $msg;}; //匿名函数赋值给变量，结尾有分号； eval(code_str)字符串最后必须是分号；
$a = 'ABC';$pose = 'strtolower';echo $pose($a); //函数赋值到变量里

// 定界符，类似于 javascript模板字符串（反引号 `）
$d = <<<EOF
特殊语言结构：定界符，结尾一行一定要单纯，不含任何其它字符。
EOF;
// 断点语句
goto LABEL; 
echo 'Foo'; 
LABEL: echo 'Bar';

// 可执行 \simplewind\vendor\web-msg-sender\vendor\workerman\phpsocket.io\examples\chat\public\socket.io-client\socket.io.js
$default       = '(func) return 123;';
$codeStr       = substr($default, 6);
$error_message = 'error';
if (!php_check_syntax($codeStr, $error_message)) {
    echo $error_message;
}
echo `php -l $codeStr`; `io('http://localhost/a');`;

### Git探索 E:\WXS\Tools\3安装软件\8版本控制器\Git\Git探索.md
### Redis缓存 _test\8dev\redis.php


$array = [
    '2' => ['title' => 'Flower', 'order' => 3],
    '3' => ['title' => 'Rock', 'order' => 1],
    '4' => ['title' => 'Grass', 'order' => 2],
];
$keys = array_keys($array);
array_multisort(array_column($array, 'order'), SORT_DESC, SORT_NUMERIC, $array, $keys);
$array = array_combine($keys, $array);
print_r($array);














