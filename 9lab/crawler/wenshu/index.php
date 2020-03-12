<?php
// header('Access-Control-Allow-Origin:*');  //支持全域名访问，不安全，部署后需要固定限制为客户端网址
// header('Access-Control-Allow-Origin:http://192.168.0.212');
// header('Access-Control-Allow-Credentials:true');
// header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE'); //支持的http 动作
// header('Access-Control-Allow-Headers:x-requested-with,content-type');  //响应头 请按照自己需求添加。

// echo 'string';die;

/**
 * 获取目标资源
 * @param  string $url     目标地址
 * @param  array  $data    参数
 * @param  string $referer 伪造来源
 */
function ot_curl($url = '', $data = array(), $referer = 'http://wenshu.court.gov.cn')
{
    // $data = array('name' => 'Hagrid', 'age' => '36');
    $data_string = json_encode($data);

    $ch      = curl_init($url);
    $options = array(
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => 1,
        // CURLOPT_SSL_VERIFYPEER => false,
        // CURLOPT_SSL_VERIFYHOST => false,
        // CURLOPT_POST           => 1, //POST方式
        // CURLOPT_POSTFIELDS     => $data,
        CURLOPT_CUSTOMREQUEST  => 'POST', //自定义POST方式
        CURLOPT_POSTFIELDS     => $data_string,
        CURLOPT_HTTPHEADER     => array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
        ),
        CURLOPT_HEADER         => 0,
        CURLOPT_REFERER        => $referer,
    );
    curl_setopt_array($ch, $options);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

$url  = 'http://wenshu.court.gov.cn/website/parse/rest.q4w';
$data = $_POST;
// echo json_encode($data);die;

$res = ot_curl($url, $data);
echo $res;die;
echo json_encode($res);die;
echo json_encode(json_decode($res));die;
