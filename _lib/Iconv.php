<?php
header('Content-Type:text/html;charset=UTF-8');

/**
 * 字符编码转换
 */
class Iconv
{
    // Unicode 转 UTF-8
    public static function unescape($str)
    {
        $str = rawurldecode($str);
        preg_match_all("/(?:%u.{4})|&#x.{4};|&#\d+;|.+/U", $str, $r);
        $ar = $r[0];
        //print_r($ar);
        foreach ($ar as $k => $v) {
            if (substr($v, 0, 2) == '%u') {
                $ar[$k] = iconv('UCS-2BE', 'UTF-8', pack('H4', substr($v, -4)));
            } elseif (substr($v, 0, 3) == '&#x') {
                $ar[$k] = iconv('UCS-2BE', 'UTF-8', pack('H4', substr($v, 3, -1)));
            } elseif (substr($v, 0, 2) == '&#') {

                $ar[$k] = iconv('UCS-2BE', 'UTF-8', pack('n', substr($v, 2, -1)));
            }
        }
        return join('', $ar); // join() 函数是 implode() 函数的别名。
    }

    //汉字 转 UNICODE
    public static function unicode_encode($name)
    {
        $name = iconv('UTF-8', 'UCS-2BE', $name);
        $len  = strlen($name);
        $str  = '';
        for ($i = 0; $i < $len - 1; $i = $i + 2) {
            $c  = $name[$i];
            $c2 = $name[$i + 1];
            if (ord($c) > 0) {
                $str .= '\u' . base_convert(ord($c), 10, 16) . base_convert(ord($c2), 10, 16); // 两个字节的文字
            } else {
                $str .= $c2;
            }
        }
        return $str;
    }

    // UNICODE 转 汉字
    public static function unicode_decode($name)
    {
        // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
        $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
        preg_match_all($pattern, $name, $matches);
        if (!empty($matches)) {
            $name = '';
            for ($j = 0; $j < count($matches[0]); $j++) {
                $str = $matches[0][$j];
                if (strpos($str, '\\u') === 0) {
                    $code  = base_convert(substr($str, 2, 2), 16, 10);
                    $code2 = base_convert(substr($str, 4), 16, 10);
                    $c     = chr($code) . chr($code2);
                    $c     = iconv('UCS-2BE', 'UTF-8', $c);
                    $name .= $c;
                } else {
                    $name .= $str;
                }
            }
        }
        return $name;
    }

    /**
     * 字符串编码转换
     * iconv() mb_convert_encoding() 的区别
     * 特殊参数：iconv('UTF-8','GB2312//IGNORE',$str)
     * mb_convert_encoding 开启这个函数低版本需要开启mb扩展
     * 
     * @param  [type] $str        待转码的字符串，可以是文件
     * @param  string $outCharset 目标编码
     *         GBK UTF-8 大小写均可
     * @param  string $inCharset  原编码
     *         原编码未知时，通过mb_convert_encoding()的auto自动检测
     * @param  string $extra       额外参数
     * @return string
     */
    public static function convert($str, $outCharset = 'utf-8', $inCharset = 'auto', $extra = '//IGNORE')
    {
        if (is_string($str)) {
            return mb_convert_encoding($str, $outCharset, $inCharset);
            // return iconv($inCharset, $outCharset.$extra, $str);// 不能自动识别原编码
        } elseif (is_array($str)) {
            $arr = array();
            foreach ($str as $v) {
                $arr[] = mb_convert_encoding($v, $outCharset, $inCharset);
            }
            return $arr;
        }
        return $str;
    }
}


/*测试*/
// echo Iconv::unescape('紫星蓝');

// $name         = 'Mine,测试！';
// $unicode_name = Iconv::unicode_encode($name);
// echo '<h3>' . $unicode_name . '</h3>';

// echo $unicode_name . ' 转为汉字为： ' . Iconv::unicode_decode($unicode_name);
// echo '<hr>' . Iconv::unicode_decode('\u6211\u548c\u4f60\uff1');


