<?php
header('Content-Type:text/html;charset=UTF-8'); //GBK
// ini_set('display_errors','Off'); //关闭报错功能
// error_reporting(E_ALL ^ E_NOTICE); //只报告错误,忽略通知
// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); //显示除了E_NOTICE(提示)和E_WARNING(警告)外的所有错误
// error_reporting(E_ERROR); //只报错
// error_reporting(0); //错误级别：不报错

define('DS', DIRECTORY_SEPARATOR);
define('EOL', PHP_EOL);
define('BR', '<br>');
define('ROOT', dirname(__DIR__));

// 环境常量
define('IS_CLI', PHP_SAPI == 'cli' ? true : false);
define('IS_WIN', strpos(PHP_OS, 'WIN') !== false);

/**
 * 日期时间
 * ...\op\opcore\lib\func\TimeFunc.php
 * time()返回当前的unix时间戳
 * date()格式化一个本地时间/日期
 *     date('Y-n-j G:i:s')   => 1970-1-1 13:00:00
 *     date('Y-n-j G:i A')   => 1970-1-1 13:00 PM
 *     date('n-j-Y g:i A')   => 1-1-1970 1:00 PM
 *     date('F-d-Y')         => January-01-1970 01:00:00 PM
 *     date('M-d-Y')         => Jan-01-1970
 *     date('m/d/Y H:i:s')   => 01/01/1970 13:00:00
 * microtime()返回当前unix时间戳和微秒数
 * mktime()返回一个日期的 UNIX 时间戳。
 */
define('STARTTIME', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
define('CURTIME', time()); //echo strtotime("now"), PHP_EOL;
define('ENDTIME', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1);
echo 'S: ' . STARTTIME . ',' . str_repeat('&nbsp', 6) . date('Y-F-d H:i:s', STARTTIME), BR;
echo 'C: ' . CURTIME . ',' . str_repeat('&nbsp', 6) . date('Y-m-d h:i:s A', CURTIME), BR;
echo 'E: ' . ENDTIME . ',' . str_repeat('&nbsp', 6) . date(DATE_ATOM, ENDTIME) . BR;
echo "<hr>";

/**
 * think\Debug
 * 浏览器友好的变量输出
 * @access public
 * @param  mixed       $var   变量
 * @param  boolean     $echo  是否输出(默认为 true，为 false 则返回输出字符串)
 * @param  string|null $label 标签(默认为空)
 * @param  integer     $flags htmlspecialchars 的标志
 * @return null|string
 */
function dump($var, $echo = true, $label = null, $flags = ENT_SUBSTITUTE)
{
    $label = (null === $label) ? '' : rtrim($label) . ':';

    ob_start();
    var_dump($var);
    $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', ob_get_clean());

    if (IS_CLI) {
        $output = PHP_EOL . $label . $output . PHP_EOL;
    } else {
        if (!extension_loaded('xdebug')) {
            $output = htmlspecialchars($output, $flags);
        }
        $output = '<pre>' . $label . $output . '</pre>';
    }

    if ($echo) {
        echo ($output);
        return;
    }

    return $output;
}

// 打印变量
function p($arr, $flag = 1) {
    dump($arr);
    if ($flag) exit;
}

/**
 * 自定义终极调试……
 * @param  [type]  $var  数据
 * @param  boolean $die  是否终止
 * @param  [type]  $dump 强制打印方式
 * @param  string  $html HTML显示样式
 */
function debugging($msg = 0, ...$php)
{
    if (count($php) > 1) {
        $output = null;
        echo '<pre>';
        // 模拟实现 var_dump('a',['b'],(object)'c');
        // $chars = 'abcdefghijklmnopqrstuvwxyz';
        foreach ($php as $vo) {var_dump($vo);}
        echo '</pre>';
        $echo = $msg;
    } else {
        if (empty($php)) {
            $var  = $msg;
            $echo = true;
        } elseif (is_bool($php[0])) {
            $var  = $msg;
            $echo = $php[0];
        } else {
            $var  = $php[0];
            $echo = $msg;
        }
        $output = dump($var, $echo);
    }
    // var_export(expression);
    if ($echo) {
        is_string($echo) and exit($echo);
        $echo !== true and die;
    }
    return $output;
}
