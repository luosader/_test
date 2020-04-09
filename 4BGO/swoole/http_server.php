<?php
/**
 * HTTP 服务器
 * https://wiki.swoole.com/#/start/start_http_server
 */

$http = new Swoole\Http\Server("0.0.0.0", 9501);

$http->on('request', function ($request, $response) {
    // 请求两次问题，/favicon.ico，可以在代码中响应 404 错误。
    if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
        $response->end();
        return;
    }

    // URL 路由
    // list($controller, $action) = explode('/', trim($request->server['request_uri'], '/'));
    // //根据 $controller, $action 映射到不同的控制器类和方法
    // (new $controller)->$action($request, $response);

    var_dump($request->get, $request->post);
    $response->header("Content-Type", "text/html; charset=utf-8");
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});

$http->start();

// 测试： php http_server.php
// 可以打开浏览器，访问 http://127.0.0.1:9501 查看程序的结果。
// 也可以使用 Apache ab 工具对服务器进行压力测试