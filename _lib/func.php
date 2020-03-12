<?php
header('Content-Type:text/html;charset=UTF-8');//GBK
error_reporting(E_ALL);
// error_reporting(E_ERROR);
define('DS', DIRECTORY_SEPARATOR);
define('EOL', PHP_EOL);
define('BR', '<br>');
define('ROOT', dirname(__DIR__));

/**
 * 日期时间
 * time()返回当前的unix时间戳
 * date()格式化一个本地时间/日期
 *     date('n-j-Y G:i:s')   => 1-1-1970 13:00:00
 *     date('n-j-Y G:i A')   => 1-1-1970 13:00 PM
 *     date('n-j-Y g:i A')   => 1-1-1970 1:00 PM
 *     date('F-d-Y')         => January-01-1970 01:00:00 PM
 *     date('M-d-Y')         => Jan-01-1970
 *     date('m/d/Y H:i:s')   => 01/01/1970 13:00:00
 * microtime()返回当前unix时间戳和微秒数
 * mktime()返回一个日期的 UNIX 时间戳。
 * 
 * 更多内容详见： ...\op\opcore\lib\func\TimeFunc.php
 */
define('STARTTIME', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
define('CURTIME', time()); //echo strtotime("now"), PHP_EOL;
define('ENDTIME', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1);
echo 'S: ' . STARTTIME . ',' . str_repeat('&nbsp', 6) . date('Y-F-d H:i:s', STARTTIME), BR;
echo 'C: ' . CURTIME . ',' . str_repeat('&nbsp', 6) . date('Y-m-d h:i:s A', CURTIME), BR;
echo 'E: ' . ENDTIME . ',' . str_repeat('&nbsp', 6) . date(DATE_ATOM, ENDTIME) . BR;
echo "<hr>";




/**
 * 自定义调试方法
 * 调试专用
 * @param  [type]  $var  数据
 * @param  boolean $die  是否终止
 * @param  [type]  $dump 强制打印方式
 * @param  string  $html HTML显示样式
 */
function debug($var, $die = false, $dump = false, $html = '<hr>')
{
    $type = gettype($var);
    switch ($type) {
        case 'integer':
        case 'double': //float
        case 'string': $dp = 'echo'; break;
        case 'array': $dp = 'var_export'; break;
        case 'NULL':
        case 'boolean':
        case 'object':
        case 'resource':
        default: $dp = 'var_dump'; break;
    }
    $dp = is_string($dump) ? $dump : $dp;

    if (!$dump && $dp == 'echo') {
        echo $var,BR;
    } else {
        echo '<pre>';
        call_user_func($dp, $var);
        echo '</pre>';

        /*object*/
        // $std = new stdClass();
        // var_export($std,false);//返回合法的PHP代码。true有返回
        // print_r($std);
        // var_dump($std);
    }

    if ($die) {exit(); }
}
