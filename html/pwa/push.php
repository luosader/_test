<?php
/**
 * 推送服务器
 */

$apiKey = $_GET['apiKey'];
$act    = $_GET['act'];
// echo $apiKey;exit;

if ($act == 'detail') {
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // 模拟数据
    $data = [
        1 => ['title' => 'PHP', 'url' => '/', 'img' => '', 'desc' => 'PHP content'],
        2 => ['title' => 'MySQL', 'url' => '/', 'img' => '', 'desc' => 'MySQL content'],
        3 => ['title' => 'JavaScript', 'url' => '/', 'img' => '', 'desc' => 'JavaScript content'],
        4 => ['title' => 'Python', 'url' => '/', 'img' => '', 'desc' => 'Python content'],
    ];
    $data['techcrunch'] = ['title' => 'techcrunch', 'url' => '/', 'img' => '', 'desc' => 'techcrunch content'];

    // return $data[$id];exit;
    echo json_encode($data[$id]);exit;
    // var_export($data[$id]);exit;
    // echo var_export($data[$id], true);exit;
    // var_dump($data[$id]);exit;

} else {

    // 模拟数据
    $data = [
        ['id' => 1, 'name' => 'PHP'],
        ['id' => 2, 'name' => 'MySQL'],
        ['id' => 3, 'name' => 'JavaScript'],
        ['id' => 4, 'name' => 'Python'],
    ];

    // $jsonData = json_encode($data);

    // return $data;exit;
    echo json_encode($data);exit;
    // var_export($data);exit;
    // echo var_export($data, true);exit;
    // var_dump($data);exit;
}
