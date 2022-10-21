<?php
### 形式一：
/* 请求 curl_post.php */
// 设置请求的POST地址，必须是包含网址的域名，不能是相对路径
$url = 'http://localupload/upload.php';
$filepath = iconv('UTF-8', 'GBK//IGNORE', 'E:/WXS/待处理/临时数据/pm-logo-4.jpg');
$pic_data = file_get_contents($filepath);
// dump($pic_data);die;
$data = [
  'username=chafang_'.rand(100, 999),
  'password='.md5('123456'),
  'pic=' => $pic_data, // 这里存放图片数据
];
// 使用 '#####' 进行分割数组
$strData = implode('#####', $data);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
//设置头文件的信息作为数据流输出
curl_setopt($curl, CURLOPT_HEADER, 0);
//设置获取的信息以文件流的形式返回，而不是直接输出。
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//设置post方式提交
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $strData);
$data = curl_exec($curl);
curl_close($curl);
// 显示post的返回值
echo ($data);
die;


/* 接收 post.php */
$content = file_get_contents("php://input");
$domain = 'http://www.xxx.com/';
// 注意这里需要有写权限
$filename = 'update/'.time().'_'.rand(100000, 999999).'.jpg';
$data = explode('#####', $content, 3);
$count = count($data);
$result = [];
// 如果文件写入成功
if (file_put_contents($filename, $data[$count - 1]))
{
  // 删除数据中最后一个元素（就是图片）
  unset($data[$count - 1]);
  foreach ($data as $val)
  {
    // 返回参数，且参数值不能存在 '=' 号
    $tmp = explode('=', $val, 2);
    $result[$tmp[0]] = $tmp[1];
  }
  // 组合图片访问地址
  $result['pic'] = $domain.$filename;
}
echo json_encode($result);


### 形式二
/*请求 */
/**
* PHP's curl extension won't let you pass in strings as multipart file upload bodies; you
* have to direct it at an existing file (either with deprecated @ syntax or the CURLFile
* type). You can use php://temp to get around this for one file, but if you want to upload
* multiple files then you've got a bit more work.
* This function manually constructs the multipart request body from strings and injects it
* into the supplied curl handle, with no need to touch the file system.
*
* @param $ch resource curl handle
* @param $boundary string a unique string to use for the each multipart boundary
* @param $fields string[] fields to be sent as fields rather than files, as key-value pairs
* @param $files string[] fields to be sent as files, as key-value pairs
* @return resource the curl handle with request body, and content type set
* @see http://stackoverflow.com/a/3086055/2476827 was what I used as the basis for this
**/
function buildMultiPartRequest($ch, $boundary, $fields, $files)
{
    $delimiter = '-------------' . $boundary;
    $data = '';

    foreach ($fields as $name => $content) {
        $data .= "--" . $delimiter . "\r\n"
        . 'Content-Disposition: form-data; name="' . $name . "\"\r\n\r\n"
        . $content . "\r\n";
    }

    //modify it
    foreach ($files as $name => $content) {
        $data .= "--" . $delimiter . "\r\n"
        . 'Content-Disposition: form-data; name="' . $name . '"; filename="' . $content['fileName'] . '"' . "\r\n\r\n"
        . $content['fileContent'] . "\r\n";
    }

    $data .= "--" . $delimiter . "--\r\n";

    curl_setopt_array($ch, [
        CURLOPT_POST => TRUE,
        CURLOPT_HTTPHEADER => [
            'Content-Type: multipart/form-data; boundary=' . $delimiter,
            'Content-Length: ' . strlen($data)
        ],
        CURLOPT_POSTFIELDS => $data
    ]);

    return $ch;
}

$file_full_path = iconv('UTF-8', 'GBK//IGNORE', 'E:/WXS/待处理/临时数据/pm-logo-4.jpg');

$ch = curl_init('http://localupload/upload.php');
$ch = buildMultiPartRequest($ch, uniqid(), ['key' => 'value', 'key2' => 'value2'], ['upfile' => ['fileName' => 'upload.jpg', "fileContent" => file_get_contents($file_full_path)]]); //modify it, here
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
echo curl_exec($ch);
curl_close($ch);
die;

/*接收*/
echo "<pre>";
print_r($_POST); //检查上传信息

print_r($_FILES); //检查上传信息
die;

### 形式三





