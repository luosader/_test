<?php
    // 响应 Response
    // http://localhost/_test/1api/apiResponse.php
    $token = 'YRL8sDk#bvk7IshN0rBdp4D9D2FAhw$p';
    /**
     * 获取API签名
     * @param  array  $data 接口传递的参数
     * @param  string $key  密钥
     * @return string
     */
    function getApiSign($data = [], $key = '')
    {
        $signature = '';
        if ($data && $key) {
            $data['token'] = $key;
            //按照首字母大小写顺序排序
            sort($data, SORT_STRING);
            //拼接成字符串
            $str = implode($data);
            //进行加密
            $hash = hash('sha256', $str);
            //转换成大写
            $signature = strtoupper($hash);
            return $signature;
        } else {
            return false;
        }
    }

    /**
     * 发送HTTP请求方法，目前只支持CURL发送请求
     * @param string $url 请求URL
     * @param array $params 请求参数
     * @param string $method 请求方法GET/POST
     * @param array $header
     * @param bool $multi
     * @return array  $data   响应数据
     * @throws \Exception
     */
    function http($url, $params, $method = 'POST', $header = [], $multi = false)
    {
        $opts = [
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER     => $header,
        ];

        /* 根据请求类型设置特定参数 */
        switch (strtoupper($method)) {
            case 'GET':
                $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
                break;
            case 'POST':
                //判断是否传输文件
                $params                   = $multi ? $params : http_build_query($params);
                $opts[CURLOPT_URL]        = $url;
                $opts[CURLOPT_POST]       = 1;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            default:
                throw new Exception('不支持的请求方式！');
                // exit('不支持的请求方式！');
        }
        // print_r($opts);die;

        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ($error) {
            throw new Exception('请求发生错误：' . $error);
            // exit('请求发生错误：' . $error);
        }

        return $data;
    }

    // if (isset($_POST['_action'])) {
    //     // print_r($_POST);die;
    //     $prms = $_POST;
    //     $action = $prms['_action'];
    //     unset($prms['_action']);
    //     $sign = getApiSign($prms, $token);
    //     $prms['sign'] = $sign;
    //     // print_r($action);die;
    //     // print_r($prms);die;
    //     // $data = http($action, $prms, 'POST');
    //     $data = file_get_contents('http://mmoexp.test/api/itemlist.html');
    //     print_r($data);die;
    //     return $data;
    // }

    // $url  = 'http://mmoexp.test/api/index.html';
    // $prms = ['sign' => ''];
    // // $data = http($url, $prms, 'GET');
    // header("Location:$url");exit;
    // // var_dump($data);

    // $root = 'http://api.1ddian.cn/';//可自定义域名
    // $url  = $root . $_REQUEST['client_url'];
    // $url  = 'http://mmoexp.test/api/index.html';
    $url  = 'http://localhost/_test/1api/apiRequest.php';
    //用curl实现Post请求，可跨域
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);  
    curl_setopt($ch, CURLOPT_URL, $url);  
    curl_setopt($ch, CURLOPT_POSTFIELDS, $_REQUEST);  //传送参数
    ob_start();  
    curl_exec($ch);  
    $result = ob_get_contents() ;  
    ob_end_clean();  
    print_r(json_decode($result)); //中文返回的是unicode编码，decode后方便阅读

?>