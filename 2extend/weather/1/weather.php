<?php
header('content-type:text/html;charset=utf-8');

// 定义天气城市代码
$cityCodeDict = [
    "北京" => 101010100, "上海" => 101020100, "天津"   => 101030100, "重庆"  => 101040100, "哈尔滨" => 101050101,
    "长春" => 101060101, "沈阳" => 101070101, "呼和浩特" => 101080101, "石家庄" => 101090101, "太原"  => 101100101,
    "西安" => 101110101, "济南" => 101120101, "乌鲁木齐" => 101130101, "拉萨"  => 101140101, "西宁"  => 101150101,
    "兰州" => 101160101, "银川" => 101170101, "郑州"   => 101180101, "南京"  => 101190101, "武汉"  => 101200101,
    "杭州" => 101210101, "合肥" => 101220101, "龙岩"   => 101230701, "南昌"  => 101240101, "长沙"  => 101250101,
    "贵阳" => 101260101, "成都" => 101270101, "广州"   => 101280101, "深圳"  => 101280601, "昆明"  => 101290101, "南宁" => 101300101,
    "海口" => 101310101, "香港" => 101320101, "澳门"   => 101330101, "台北"  => 101340102, "厦门"  => 101230201,
];
$cityCode = $cityCodeDict['合肥']; //得到城市代码

$host = 'http://www.weather.com.cn/';
$url  = sprintf('weather1d/%d.shtml', $cityCode); // 今天
// $url  = sprintf('weather/%d.shtml', $cityCode); // 7天
// $url  = sprintf('weather15d/%d.shtml', $cityCode); // 8-15天
// $url  = sprintf('weather40d/%d.shtml', $cityCode); // 40天
$url  = sprintf('data/sk/%d.html', $cityCode); // json数据
$url = $host . $url;

$data    = file_get_contents($url);
$weather = json_decode($data, true);
if (is_array($weather)) {
    echo json_encode($weather['weatherinfo']);exit;
}

// 如果是HTML
// <ul id="someDayNav" class="clearfix cnav"></ul>
/*preg_match('/<ul id=\"someDayNav\".*?>(.*?)<\/ul>/ism', $data, $match);
preg_match_all('/<li.*?>(.*?)<\/li>/ism', $match[1], $matches);
var_dump($matches);*/

$myRule = function ($pattern = '', $subject) {
    preg_match($pattern, $subject, $match);
    if (isset($match[1])) {return $match[1];}
    if (isset($match[0])) {return $match[0];}
    return '';
};

// <div class="today clearfix" id="today">
// <div class="left-div">
$text = $myRule('/<div class=\"today.*? id=\"today\">.*?<div class="left-div">/ism', $data);
// 城市
$city = $myRule('/class="xyn-delete">.*?<span>(.*?)<\/span>/u', $text);
// 更新时间
$time = $myRule('/<input type="hidden" id="update_time" value="(.*?)"\/>/', $text);
// hidden_title
$title = $myRule('/id="hidden_title" value="(.*?)" \/>/u', $text);
// 日出时间 sunUp
$sunUp = $myRule('/<p class="sun sunUp">([\w\W]*?)<\/p>/', $text);
// 日落时间 sunDown
$sunDown = $myRule('/class="sun sunDown">([\w\W]*?)<\/span>/', $text);

$weather = [];
$th = explode(',', 'city,time,title,sunUp,sunDown');
foreach ($th as $v) {
    $val = '';
    if (isset($$v)) {
        $val = trim(strip_tags($$v));
    }
    $weather[$v] = $val;
}
echo json_encode($weather);exit;


