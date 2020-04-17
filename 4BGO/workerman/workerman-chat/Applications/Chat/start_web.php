<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Protocols\Http\Response;
use Workerman\Worker;

require_once __DIR__ . '/../../vendor/autoload.php';

// WebServer
$web        = new Worker('http://0.0.0.0:55151');
$web->count = 2; // WebServer进程数量
$web->name  = 'ChatClient'; //

define('WEBROOT', __DIR__ . DIRECTORY_SEPARATOR . 'Web');

$web->onMessage = function (TcpConnection $connection, Request $request) {
    // 载入前台页面
    $path = $request->path();
    if ($path === '/') {
        $connection->send(exec_php_file(WEBROOT . '/index.php')); // 未指定时的默认
        return;
    }
    $file = realpath(WEBROOT . $path);
    if (false === $file) {
        $connection->send(new Response(404, array(), '<h3>404 Not Found</h3>')); // 文件不存在
        return;
    }
    // Security check! Very important!!!
    if (strpos($file, WEBROOT) !== 0) {
        $connection->send(new Response(400));
        return;
    }
    if (\pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        $connection->send(exec_php_file($file));
        return;
    }

    if (!empty($if_modified_since = $request->header('if-modified-since'))) {
        // Check 304.
        $info          = \stat($file);
        $modified_time = $info ? \date('D, d M Y H:i:s', $info['mtime']) . ' ' . \date_default_timezone_get() : '';
        if ($modified_time === $if_modified_since) {
            $connection->send(new Response(304));
            return;
        }
    }
    $connection->send((new Response())->withFile($file));
};

function exec_php_file($file)
{
    \ob_start();
    // Try to include php file.
    try {
        include $file;
    } catch (\Exception $e) {
        echo $e;
    }
    return \ob_get_clean();
}

// 如果不是在根目录启动，则运行runAll方法
if (!defined('GLOBAL_START')) {
    Worker::runAll();
}
