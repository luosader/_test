<?php
//查找淄博天气情况
//接口自带编写的数组
$showapi_appid  = '46435'; //替换此值,在官网的"我的应用"中找到相关值
$showapi_secret = '7c55aef4ede442ffa49b24c2c808e523'; //替换此值,在官网的"我的应用"中找到相关值
$paramArr       = array(
    'showapi_appid'    => $showapi_appid,
    'areaid'           => "",
    'area'             => "淄博",
    'needMoreDay'      => "",
    'needIndex'        => "",
    'needHourData'     => "",
    'need3HourForcast' => "",
    'needAlarm'        => "",
    //添加其他参数
);

//创建参数(包括签名的处理)接口自带编写的数组
function createParam($paramArr, $showapi_secret)
{
    $paraStr = "";
    $signStr = "";
    ksort($paramArr);
    foreach ($paramArr as $key => $val) {
        if ($key != '' && $val != '') {
            $signStr .= $key . $val;
            $paraStr .= $key . '=' . urlencode($val) . '&';
        }
    }
    $signStr .= $showapi_secret; //排好序的参数加上secret,进行md5
    $sign = strtolower(md5($signStr));
    $paraStr .= 'showapi_sign=' . $sign; //将md5后的值作为参数,便于服务器的效验

    return $paraStr;
}

$param = createParam($paramArr, $showapi_secret);
$url   = 'http://route.showapi.com/9-2?' . $param;

//获取json格式的数据
$result = file_get_contents($url);

//对json格式的字符串进行编码
$arr = (json_decode($result));
var_dump($arr);die;

$v    = $arr->showapi_res_body;
$attr = $v->f1;
var_dump($attr);

//所需要的数据进行调用
$arr1 = $attr->day_weather;
$arr2 = $attr->night_weather;
$arr3 = $attr->night_air_temperature;
$arr4 = $attr->day_air_temperature;
$arr5 = $attr->day_wind_direction;
$arr6 = $attr->night_weather_pic;
echo $arr6;
?>

<?php
// //将所需要的数据添加到数据库
// require_once "./DBDA.class.php";
// $db = new DBDA();

// $sql = "insert into weather values('','{$arr1}','{$arr2}')";
// $arr = $db->query($sql);
?>