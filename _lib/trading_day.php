<?php
date_default_timezone_set('prc');
// 节假日判断
// https://www.oschina.net/code/snippet_202258_44946
// https://blog.csdn.net/xinit1/article/details/72833988
// https://blog.csdn.net/u013748736/article/details/52583294

/**
 * 求取从某日起经过一定天数后的日期,
 * 排除周六周日和节假日
 * @param $start       开始日期
 * @param $offset      经过天数
 * @param $exception 例外的节假日
 * @param $allow       允许的日期(预留参数)
 * @return
 *  examples:输入(2010-06-25,5,''),得到2010-07-02
 */
function getendday($start = 'now', $offset = 0, $exception = '', $allow = '')
{
    //先计算不排除周六周日及节假日的结果
    $starttime = strtotime($start);
    $endtime   = $starttime + $offset * 24 * 3600;
    $end       = date('y-m-d', $endtime);
    //然后计算周六周日引起的偏移
    $weekday   = date('n', $starttime); //得到星期值：1-7
    $remain    = $offset % 7;
    $newoffset = 2 * ($offset - $remain) / 7; //每一周需重新计算两天
    if ($remain > 0) {
        //周余凑整
        $tmp = $weekday + $remain;
        if ($tmp >= 7) {
            $newoffset += 2;
        } else if ($tmp == 6) {
            $newoffset += 1;
        }
        //考虑当前为周六周日的情况
        if ($weekday == 6) {
            $newoffset -= 1;
        } else if ($weekday == 7) {
            $newoffset -= 2;
        }
    }
    //再计算节假日引起的偏移
    if (is_array($exception)) {
        //多个节假日
        foreach ($exception as $day) {
            $tmp_time = strtotime($day);
            if ($tmp_time > $starttime && $tmp_time <= $endtime) {
                //在范围(a,b]内
                $weekday_t = date('n', $tmp_time);
                if ($weekday_t <= 5) {
                    //防止节假日与周末重复
                    $newoffset += 1;
                }
            }
        }
    } else {
        //单个节假日
        if ($exception != '') {
            $tmp_time = strtotime($exception);
            if ($tmp_time > $starttime && $tmp_time <= $endtime) {
                $weekday_t = date('n', $tmp_time);
                if ($weekday_t <= 5) {
                    $newoffset += 1;
                }
            }
        }

    }
    //根据偏移天数，递归做等价运算
    if ($newoffset > 0) {
        #echo "[{$start} -> {$offset}] = [{$end} -> {$newoffset}]"."<br />n";
        return getendday($end, $newoffset, $exception, $allow);
    } else {
        return $end;
    }
}

/**
 * 暴力循环方法
 */
function getendday2($start = 'now', $offset = 0, $exception = '', $allow = '')
{
    $starttime = strtotime($start);
    $tmptime   = $starttime + 24 * 3600;

    while ($offset > 0) {
        $weekday = date('n', $tmptime);
        $tmpday  = date('y-m-d', $tmptime);
        $bfd     = false; //是否节假日
        if (is_array($exception)) {
            $bfd = in_array($tmpday, $exception);
        } else {
            $bfd = ($exception == $tmpday);
        }
        if ($weekday <= 5 && !$bfd) {
            //不是周末和节假日
            $offset--;
            #echo "tmpday={$tmpday}"."<br />";
        }
        $tmptime += 24 * 3600;
    }

    return $tmpday;
}


/*测试*/
$exception = array(
    '2010-01-01', '2010-01-02', '2010-01-03',
    '2010-04-03', '2010-04-04', '2010-04-05',
    '2010-05-01', '2010-05-02', '2010-05-03',
    '2010-06-14', '2010-06-15', '2010-06-16',
    '2010-09-22', '2010-09-23', '2010-09-24',
    '2010-10-01', '2010-10-02', '2010-10-03', '2010-10-04',
    '2010-10-05', '2010-10-06', '2010-10-07',

);
//echo getendday('2010-08-27',3,'');
//echo getendday('2010-06-25',15,'2010-07-07');
$t1 = microtime();
echo getendday('2010-05-12', 66, $exception) . "<br />";
$t2 = microtime();
echo "use " . ($t2 - $t1) . " s <br />";

echo getendday2('2010-05-12', 66, $exception) . "<br />";
$t3 = microtime();
echo "use " . ($t3 - $t2) . " s <br />";
