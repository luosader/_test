<?php
if(isset($argv[1]) && ($argv[1] == '-h' || $argv[1] == '-help')) {
    help();
}

$url      = isset($argv[1]) ? $argv[1] : '';
$floorNum = isset($argv[2]) ? $argv[2] : 5;
$stepNum  = isset($argv[3]) ? $argv[3] : 10;
$ceilNum  = isset($argv[4]) ? $argv[4] : 100;

if(empty($url)) {
    help();
}

$cn = cn($floorNum,$stepNum,$ceilNum);

if(empty($cn)) {
    help();
}

$result = ab($url,$cn);

saveData($result,$url);

/**
 * 保存结果
 */
function saveData($result,$url) {
    $data = "";
    foreach ($result as $key => $value) {
        $data .= "
        <tr>
            <td>".(++$key)."</td>
            <td>{$value['c']}</td>
            <td>{$value['n']}</td>
            <td>".ceil(100-$value['failedRequests']/$value['completeRequests']*100)."%</td>
            <td>{$value['requestsPerSecond']}</td>
            <td>{$value['timePerRequest']}</td>
            <td>{$value['percentage']}</td>
        </tr>
        ";
    }
    $tmp = parse_url($url);
    $name = isset($tmp['host']) ? $tmp['host'] : date('Y-m-d-H-i-s');
    $html = <<<EOF
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{$url}</title>
</head>
<body>
<style>
    table.gridtable {
        font-family: verdana,arial,sans-serif;
        font-size:11px;
        color:#333333;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
    }
    table.gridtable th {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #666666;
        background-color: #dedede;
    }
    table.gridtable td {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #666666;
        background-color: #ffffff;
    }
    h2{
        margin: 0;
    }
</style>
<h2>{$url}</h2>
<hr>
<table class="gridtable">
    <tr>
        <th>序号</th>
        <th>-c</th>
        <th>-n</th>
        <th>成功率</th>
        <th>秒并发数</th>
        <th>平均毫秒数</th>
        <th>99%的请求完成毫秒数</th>
    </tr>
    {$data}
</table>
</body>
</html>
EOF;
    file_put_contents($name.'.html', $html);
}

/**
 * 压测
 */
function ab($url,$cn) {
    $result = array();
    $counter = count($cn);
    foreach ($cn as $key => $value) {
        $ab = "ab -c {$value['c']} -n {$value['n']} {$url}";
        echo 'total ',$counter,' current ',$key+1," last ",$counter - ($key+1),"\r\n";
        echo $ab,"\r\n";
        exec($ab,$output,$code);
        echo "\r\n";
        if($code != 0) {
            help();
            break;
        }
        $data = array('c'=>$value['c'],'n'=>$value['n']);
        foreach ($output as $key2 => $value2) {
            if(stripos($value2, 'Complete') === 0) {
                $tmp = explode(':', $value2);
                $data['completeRequests'] = intval(array_pop($tmp));
            }

            if(stripos($value2, 'Failed') === 0) {
                $tmp = explode(':', $value2);
                $data['failedRequests'] = intval(array_pop($tmp));
            }

            if(stripos($value2, 'Requests') === 0) {
                $tmp = explode(':', $value2);
                $data['requestsPerSecond'] = intval(array_pop($tmp));
            }

            if(stripos($value2, 'Time per request') === 0) {
                $tmp = explode(':', $value2);
                if(!isset($data['timePerRequest'])) $data['timePerRequest'] = intval(array_pop($tmp));
            }

            if(stripos($value2, '99%') !== false) {
                $data['percentage'] = intval(str_replace('99%','',$value2));
            }
        }
        $result[] = $data;
        sleep(3); //等待3秒，进入下一个压测
    }

    echo 'complete ',++$key,"\r\n";

    return $result;
}


/**
 * 生成压测url
 * @param  [type]  $url      [url]
 * @param  integer $floorNum [起始人数]
 * @param  integer $stepNum  [每阶段增加人数]
 * @param  integer $ceilNum  [最大人数]
 * @return [type]            [返回ab命令的 -c -n ]
 */
function cn($floorNum,$stepNum,$ceilNum) {
    $result = array();
    $step = 1;
    for($i=$floorNum;$i<=$ceilNum;$i+=$stepNum) {
        $n = $step*$i+$i;
        $result[] = array('c'=>$i,'n'=>$n);
        $step+=3;
    }
    return $result;
}

/**
 * 打印帮助信息
 */
function help() {
    echo "\r\nExample: php bench http://www.test.com/ 5 10 100\r\n";
    echo "Parameter 1 is a url\r\n";
    echo "Parameter 2 is the number of start\r\n";
    echo "Parameter 3 is increasing number\r\n";
    echo "Parameter 4 is the total number of\r\n";
    die();
}