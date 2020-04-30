<?php
require '_lib/func.php';
### 荣誉室
// $k='a';$v='1';$a = "{$k}={$v}$&";echo $a;//变量解析
// echo 8/2*(2+2);//16
// echo 1|2|4|8;//位运算符
// echo 1 <=> 2;//PHP7太空船操作符
// $id = [1]; var_dump($id>1);//比较判断
// echo sprintf('%04d', rand(0,999));//生成4位数，不足前面补0
// $cool='A'; $cool++; echo $cool;//字母亦可以递增
// $c = 'z'; echo ++$c . "\n";//aa的字典顺序是小于z的
// $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ#'; echo $chars[0],$chars{1},PHP_EOL;//连着写，dump也可以; 字符串当作数组取值;
/*$arr = array(['name'=>'张三'], ['name'=>'李四','age'=>1]);
array_walk($arr,function(&$v,$k,$p){$v=array_merge($v,$p);},array('sex'=>'男','age'=>19));//遍历*/
// $otk = function($data,$msg='Empty!'){if(!$data)echo $msg;};//匿名函数，结尾有分号
// $a=null; print_r(is_null($a)?:'b');//三目运算。is_null($a)作为值返回
// $a = 'ABC';$pose = 'strtolower';echo $pose($a);//函数赋值到变量里
/*$d = <<<EOF
特殊语言结构：定界符
EOF;*/
// goto a; echo 'Foo'; a:echo 'Bar';//断点语句

### 测试区
// echo ROOT;
// switch (false) 与 if 哪个效率高
#Redis缓存 _test\8dev\redis.php

### Git探索 E:\WXS\Tools\3安装软件\8版本控制器\Git\Git探索.md

// 排个序
$a = '276,231,271,223,269,261,221,233,217,239,181,180,183,132,178,159,144,157,241,164,140,193,154,203,249,267,133,134,137,146,156,177,136,257,162,170,172,243,211';
// $a = explode(',', $a);
// sort($a);
// $a = implode(',', $a);
// debug($a);

$a = ['a'=>['bbb','asas'],1,'b'=>'123','aa'=>'aac'];
// $a = '140,333,1223';


debug(json_decode('{"saleprop":{"147":{"price":"3","stock":"100","icon":"","pic":""},"148":{"price":"3","stock":"100","icon":"","pic":""},"props":{"propids":"22","propnames":"Colors"}}}',true));
























;;;
/**
 * 特征索引 - 常用
 *
 * &$
 * };
 * bcscale bcdiv
 * strtotime
 * preg_match preg_replace
 * serialize json_
 * iconv
 * strstr strpos
 * substr str_split
 * mkdir
 * explode implode
 * array_merge array_diff
 * sort(
 * curl_init
 * Memcache Redis
 *
 */
http://wenshu.court.gov.cn/website/wenshu/181217BMTKHNT2W0/index.html?s7=最高法执监167号
### 调试用debug()
// $a = 'b'; $b = 'a'; echo ${$a};//类中也一样 __set(),__get()
// $a['k'] = 'key';
// echo "'%$a[k]%'",BR;
// echo "'%{$a['k']}%'",BR;
// echo "'%{$a[k]}%'",BR;
// echo '\'%'.$a['k'].'%\'',BR;

/*Number*/
// var_dump(ENT_QUOTES);//int(3)
// echo md5(rand(1,999));
// echo intval('0.00');
// if ('0.00'<=0) echo "err"; else echo "string";echo '<br>';
// if('0.00'<=0): echo "err"; else: echo "string"; endif;echo '<br>';
// $c = null;if ($c==0) echo 'ok';else echo 'err';

/*String*/
// 字符实体
// echo 'n&#1288;i';

/*Array/Object*/
// $arr = range('a','z');
// $arr = ['你','好','吗','？'];
$arr = array(3, 45, 60, 9);
// sort($arr);
// natsort($arr);
// debug($arr);

// 交换
// list($a, $b) = array($b, $a);
// 分片
// $u = [1,2,3,'a'=>4,5,9,'1'=>8];$r = 3;$c = count($u);
// $u1 = array_slice($u,1,$r,true);
// $c = $c-$r;$uu = array_slice($u,$r+1,$c,true);
// debug($u);debug($u1);debug($uu);
//
// $a = array('a','b');$b=array_pop($a);print_r($a);echo $b;
// $path = substr($path,0,strrpos($path,'-'));echo $path;

/*Other*/

?>
<?php
/*临时处理*/
// echo 'class file <div 看不见> not found!';
// echo md5('pzy110995');
// $dir = 's/c/s/a/y';
// $dir = 's/c/s/a/y.txt';
// if (stripos($dir,'.')) {
//  $dir = dirname($dir);
// }
// echo $dir;

### QQ聊天
// echo '<a href="http://wpa.qq.com/msgrd?v=3&uin=115346489&site=qq&menu=yes">QQ聊天</a>';
// echo '<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=115346489&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2::53" alt="Q我" title="Q我"/>QQ聊天</a>';

/*执行其他命令*/
// $dir = `ls`;// shell bash
// $dir = `dir /-w`;// DOS
// $dir = `dir /b`; // DOS
// debug($dir);
// $dir = iconv('gb2312', 'utf-8', $dir);
// echo $dir;
// debug(explode(PHP_EOL,trim($dir)));
// debug(explode("\n",trim($dir)));

### 交换数值
// $a='a';
// $b='b';
// echo '交换前 $a:'.$a.',$b:'.$b.'<br />';
// $a=$a^$b;
// $b=$b^$a;
// $a=$a^$b;
// echo '交换后$a:'.$a.',$b:'.$b.'<br />';
// echo '-----------------------<br/>';
// function mynull($a=''){
//  return $a;
// }
// var_dump(mynull());
### 获取文本内容，序列化操作
// echo file_put_contents("test.txt","Hello World. Testing!");
// $a = 'a:4:{s:5:"extra";a:1:{s:8:"customid";s:1:"2";}s:5:"style";s:4:"code";s:4:"html";s:115:"<a href="" class="ad"><img src="/source/plugin/_public/image/ad2.png" alt="广告位2" width="424" height="50"></a>";s:12:"displayorder";s:0:"";}';
// $a = 'a:4:{s:5:"extra";a:1:{s:8:"customid";s:1:"3";}s:5:"style";s:4:"code";s:4:"html";s:13:"分v色粉色";s:12:"displayorder";s:0:"";}';
// $a = 'a:4:{s:5:"extra";a:1:{s:8:"customid";s:1:"2";}s:5:"style";s:4:"code";s:4:"html";s:115:"<a href="/" class="ad"><img src="source/plugin/_public/image/ad2.png" alt="广告位1" width="424" height="50"></a>";s:12:"displayorder";s:0:"";}';
// $b = unserialize($a);
// var_dump($b);
?>
<?php
/*PHP特性*/
/*存在性判断*/
// if (class_exists('myclass')) {
//  echo 'is_class';
// } else {
//  echo "null";
// }
// if (function_exists('mysql_connect')) {
//  echo 'Is Mysql';
// } else {
//  echo "Is Mysqli";
// }

/*区分大小写*/
$l = 'abcdefghijkmnpqrstuvwxyz';
$L = 'ABCDEFGHIJKMNPQRSTUVWXYZ';
$a = 'l';
$a = 'L';
// if ($a == 'l') {
//  echo $l;
// } elseif ($a=='L') {
//  echo $L;
// }
// php 变量区分大小写，方法不区分大小写
// $a = 1; $A = 2;
// echo $a; echo $A;
// function a() {
//  return 1;
// }
// function A() {
//  return 2;
// }
// echo a(); echo A();
// 递归简单示例
// function iii($i=0)
// {
//  // ++$i;return $i;
//  if ($i<9) {
//      ++$i;
//      return iii($i);
//  } else {
//      return $i;
//  }
// }
// echo iii();

/*php的引用 &$a*/
function exam(&$var1)
{
    $var1++;
    echo "In Exam:" . $var1 . "<br />";
}
// $var1 = 1; echo $var1 . BR;
// exam($var1); echo $var1 . "<br />";
// 指针操作
// $data = ['a','b','c'];
// foreach ($data as $key => $val) { $val = &$data[$key]; debug($data); }
// $符的复用
$a = 'b';
$b = 'c';
$c = 'd';
// echo $$$a;
$$a = 'c2';
// echo $b;
// $$a.'thumb' = '/image/enrol/1.jpg';// 这是错误的
// $($a.'thumb') = '/image/enrol/1.jpg';// 这是错误的
$bt  = $a . 'thumb';
$$bt = '/image/enrol/1.jpg';
// echo $bthumb;
?>
<?php
/*URL处理测试*/
// $url = 'www.baidu.com?/s=% 特殊字符%~转义^……&打 印#<br>';
$url = ' ';
// $uue = convert_uuencode($url);//转为可打印的数据
// $uud = convert_uudecode($uue);
// echo $uue;echo "<br>";
// $urle = urlencode($url);
// $urld = urldecode($urle);
// echo $urle;echo "<br>";
// $rawe = rawurlencode($url);
// $rawd = rawurldecode($rawe);
// echo $rawe;
// 从上面的执行结果可以看出，urlencode和rawurlencode两个方法在处理字母数字，特殊符号，中文的时候结果都是一样的，唯一的不同是对空格的处理，urlencode处理成“+”，rawurlencode处理成“%20”。

/*URL参数简化*/
$url = 'http://tx.ext1/medium_category.php?id=5&page=1&a=4&';
// $url = 'id=5&page=1&a=4&';
// $url = strstr($url,'?');
// $url = preg_replace('/?/', '', $url, 1);
// $url = explode('?', $url)[1];
// parse_str($url);
// debug($id);
// debug($page);
// debug($a);

$url = 'http://wiki.ubuntu.org.cn/Netbeans#.E5.AE.98.E7.BD.91.E4.B8.8B.E8.BD.BD.E5.AE.89.E8.A3.85';
// $param = explode('#', $url)[1];
// $parameters = explode('.', $param);
// debug($parameters);
// $split = str_split($param,3);
// debug($split);
?>



<?php
/*字符 匹配、替换、截取、转化*/
// $a = 'a.';
// $b = 'string';
// $c = 333;
// echo "$a$b$c";
// $d = str_repeat('&nbsp;',4);
// echo $d;
// strrev($b);

// 字符处理
$jumpext  = '002000000|0~3|>3|5';
$jumpext2 = '>9>=8=5<=4<31~2';
$numeric  = strstr($jumpext, '|', true);
$string   = strstr($jumpext, '|');
// $string = strrchr(strrev($jumpext),'|');

$string = preg_replace('/~/', '@', $jumpext2);
// $string = preg_replace('/^\|/','',$string);
// $string = preg_replace('/\|/','',$string,1);//同上面效果
// debug($string);
#多次替换 拿pattern里的每一个模式依次去匹配subject里的每一个元素，匹配到了就用与pattern对应的那个replace对换，如上例，可能不止一次替换
$subject = array('1', 'a', '2', 'b', '3', 'A', 'B', '4'); //array('A:C:1','B:C:a','A:2','B:b','A:3','A','B','A:4')
$subject = array('1', 'a', '2', 'b', '3', 'A', 'B', '4'); //'A:C:1', 'B:C:a', 'A:2', 'B:b', 'A:3', 'A', 'B', 'A:4'
$pattern = array('/\d/', '/[a-z]/', '/[1a]/');
$replace = array('A:$0', 'B:$0', 'C:$0');
// echo "preg_replace returns\n<pre/>";
// print_r(preg_replace($pattern, $replace, $subject));

// $stringArr = explode('|',$string);
// debug($numeric);
// debug($string);
// debug($stringArr);

### 字符打散成数组
// $letter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
// $box = str_split($letter,5);
// print_r($box);

### 随机数
// mb_strlen();
rand(1, 999);
### 截取
// $str = "1,2,3,4,5,6,";
$str = "abcdefghijklmn";
// 截掉第一个
// $newstr = substr($str, 1); //bcdefghijklmn
// 保留最后一个
// $newstr = substr($str, -1); //n
// 保留第一个
// $newstr = substr($str,0,1);//a
// $newstr = substr($str,0,-(strlen($str)-1));//a
// 截掉最后一个
// $newstr = substr($str,0,-1);//abcdefghijklm
// $newstr = substr($str,0,strlen($str)-1);//abcdefghijklm
// echo $newstr;
### 字符匹配(匹对/过滤/正则)、匹配
// $s = stripos('a&b&c&c','c',5);
// echo $s;
// $upfile_type = 'png,jpg,gif,rar,zip,pdf';
// $ftype = 'p';
// $res = stripos($upfile_type, $ftype);// 匹配最先出现的位置
// // $res = strripos($upfile_type, $ftype);// 匹配最后出现的位置
// $res = strrchr('haystack', 'a');// 匹配最后并返回它及后面的字符
// var_dump($res);
// if ($res === false) {
//  echo "is_false";
// } else {
//     echo 'is_true';
// }
// filter_input(type, variable_name);// 从脚本外部获取输入，并进行过滤。
// preg_match(pattern, subject, matches);
// preg_match_all(pattern, subject, matches);
###
// if (preg_match('/[a-zA-Z]+/','a')) {
//     echo true;
// } else {
//     echo 'err';
// }
###
$subject = '123"abc"456';
// 利用先行和后发断言规则： (?<=").*?(?=")
$pattern = '/(?<=").*?(?=")/ism';
preg_match($pattern, $subject, $result);
// print_r($result);
### 姓名
$ch = 'sas';
$ch = '111';
$ch = '你好中国';
function is_ChineseName($name)
{
    if (preg_match('/^([\xe4-\xe9][\x80-\xbf]{2}){2,4}$/', $name)) {
        return true;
    } else {
        return false;
    }
}
// if (is_ChineseName($ch)) {
//  echo "是姓名";
// } else {
//  echo "不是姓名";
// }
### 匹配替换
// $subject = 'img/jpg';
// $subject = str_replace('/', '_', $subject);
// print_r($subject);
// $content = file_get_contents('http://www.hujiang.com/ciku/basic/');
// preg_match_all('/<div class=\"base-cnt\">([\s\S]*?)<\/div>/', $content, $matches);
// print_r($matches);
// 下面的例子演示了将文本中所有 <pre></pre> 标签内的关键字（php）显示为红色。
// $str = "<pre>学习php是一件快乐的事。</pre><pre>所有的phper需要共同努力！</pre>";
// $kw = "php";
// preg_match_all('/<pre>([\s\S]*?)<\/pre>/',$str,$mat);
// print_r($mat);
// for($i=0;$i<count($mat[0]);$i++){
//  $mat[0][$i] = $mat[1][$i];
//  $mat[0][$i] = str_replace($kw, '<span style="color:#ff0000">'.$kw.'</span>', $mat[0][$i]);
//  $str = str_replace($mat[1][$i], $mat[0][$i], $str);
// }
// echo $str;
### 数组替换
// $find = array("Hello","world");
// $replace = array("B");
// $subject = array("Hello","world","!");
// $find = array('a.','b.');
// $replace = array();
// $replace = '';
// $subject = 'a.id,b.name,c.addtime';
// print_r(str_replace($find,$replace,$subject));
?>
<?php
/*类、方法处理测试*/
/*自动加载*/
/*if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
spl_autoload_register('YAutoload', true, true);
} else {
spl_autoload_register('YAutoload');
}
} else {
function __autoload($classname)
{
YAutoload($classname);
}
}
function YAutoload($classname)
{
# code...
}*/

/*注册函数*/
// if(DISCUZ_CORE_DEBUG) {
//     register_shutdown_function(array('Debug','fatalError')); //定义PHP程序执行完成后执行的函数
//     set_error_handler(array('Debug','appError')); // 设置一个用户定义的错误处理函数
//     set_exception_handler(array('Debug','appException')); //自定义异常处理。
// }
?>
<?php
/*数组处理测试*/
// echo max(-1, 'a');
// $a=1;
// print_r((array)$a);
// $a = array('a'=>1,'b'=>2);
// $a = $a['a'];
// print_r($a);
// foreach ((array)$a as $k => $v) {
//  echo $v;
// }

// php5.3以上版本 array() 可写成 []
// $h = 123;
// function aa()
// {
//  return array('1'=>1,2=>'ok',3=>'中国');
// }
// echo aa()[3];// php5.5以下版本不兼容
// $head_title = (isset($loid)?'修改':'新增').$h;
// echo $head_title;

/*判断是否为空数组*/
$a = array(
    array(
        array(
            array(
                array(1 => 'a'),
            ),
        ),
    ),
    array(),
    '',
);
// var_dump($a);
// $a = array('a'=>array(),'sx'=>'2%3','','', );
// $a = implode("",$a);
function arr_emp($arr, $res = '')
{
    foreach ($arr as $v) {
        if (is_array($v)) {
            // return $v;
        } else {
            $res .= $v;
        }
        if (is_array($v)) {
            arr_emp($v, $res);
        }
    }
    return $res;
}
$a = arr_emp($a);
// var_dump($a);
// if (!empty($a)) {
//  var_dump($a);
// } else{
//  echo "Is_empty";
// }

/*更多测试*/
$sign = array(
    'resource1' => array('table' => 'tableA', 'field_filter' => 'images', 'field_path' => 'imagespath'),
    'resource2' => array('table' => 'tableB', 'field_filter' => 'files', 'field_path' => 'filespath'),
);
$sign2 = array(
    'resource1' => array('tableA', 'images', 'imagespath'),
    'resource2' => array('tableB', 'files', 'filespath'),
);
$sign3 = array(
    array('根路径', '文件信息'),
    array('/', 'attach'),
);
$sign4 = array(
    array('表名', '主键', '字段'),
    array('tableA', 'lokey_pic', 'field_picpath'),
    array('tableB', 'lokey_pdf', 'field_pdfpath'),
    array('tableC', 'lokey_attach', 'field_attachpath'),
);
$sign5 = array('a' => '!', 'b' => '@');
$sign6 = array(1, 2);
//合并数组
$combine = array_merge($sign2, $sign3, $sign5, $sign6); // 合并键名，生成二位数组
// 合并
// debug($sign+$sign2);
// debug(array_merge($sign,$sign2));
// debug(array_push($sign,$sign2));

/*差集比较处理*/
// 差集 一维数组
// $diff1 = array_diff($old,$new);//要修改的
// $diff2 = array_diff($new,$old);//新增的
// 示例：
// $attr_old = [1,3];
// // $attr_old = [1=>3,2=>[3,5]];
// $attr = [
//  1 => ['a','b'],
//  2 => [8]
// ];
// $attr = array_keys($attr);
// $diff1 = array_diff($attr_old,$attr);
// $diff2 = array_diff($attr,$attr_old);
// debug($diff1);
// debug($diff2);

/*交换*/
// $arraykey = array_diff_key($sign, $sign2);// 找出键名差集
// $flip = array_flip($sign3);// 键值对互换，当有一样的值时会以最后一个为准
// print_r($flip);
// if (!is_resource($sign)) {
//  foreach ($sign as $k => $v) {
//      $arraykey = array_keys($v);// 返回键名组成的数组
//      print_r($arraykey);
//      foreach ($v as $key => $val) {
//          var_dump($key.'=>'.$val);
//      }
//      die;
//  }
// } else {echo "string";}

/*in_array()、list()*/
/*$strExt_ids = ',2,13,';
$arrExt_ids = explode(',', $strExt_ids);
$arrExt_ids = array_filter($arrExt_ids);
if (in_array('2',$arrExt_ids)) {
echo "是在";
} else {
echo "不在";
}*/
// $str = 'li_ost_goll_';
$str = 'li_ost';
$str = '';
$arr = explode('_', $str);
// implode(',',array());
// implode(array(),',');//反写亦可
// var_dump($arr);
// list($c,$a,$b) = $arr;
// echo $a;
// $where = array(
//      array('start',1),
//      '',
//      array(),
//      array('keyword',4444),
//      array('uid',55555),
//  );
// @list($start,$end,$key,$keyword,$uid) = $where;
/*// $a = @$end[1];
if (empty($a)) {
print_r('end<br>');
} else {
print_r($a);
}*/
// if (!$key) {
//  print_r(@$key[0]);
// }
// echo $uid[1] ? trim($uid[1]) : 'uid<br>';

/*模拟关联处理*/
// $step2_field = array('0'=>'prono',1=>'aa');
// $step2_operator = array('0'=>'=',1=>'<');
// $step2_value = array(0=>'111',1=>'祥');
// $step2_relation = array(0=>'AND',1=>'OR');
// $arsort = krsort($step2_field);
// print_r($step2_field);
/*$last = count($step2_relation);
$wh = array();
foreach ($step2_field as $k => $v) {
$wh[$k] = $v.' ';
}
foreach ($step2_operator as $k => $v) {

$wh[$k].= $v.' ';
}
foreach ($step2_value as $k => $v) {
if (is_numeric($v)) {
$wh[$k].= $v.' ';
} else {
$wh[$k].= '\''.$v.'\' ';
}
}
foreach ($step2_relation as $k => $v) {
if ($k!=($last-1)) {
$wh[$k].= $v.' ';
}
}*/
// print_r($wh);
// foreach ($step2_field as $k => $v) {
//  $wh[$k]['field'] = $v;
// }
// foreach ($step2_operator as $key => $v) {
//  $wh[$k]['operator']= $v;
// }
// foreach ($step2_value as $key => $v) {
//  $wh[$k]['value']= $v;
// }
// foreach ($step2_relation as $key => $v) {
//  $wh[$k]['relation']= $v;
// }
// foreach ($wh as $key => $v) {
//  # code...
// }
?>
<?php
/*字符处理测试*/
$a = 1;
$a = '1';
$a = 0.1;
$a = -0.1;
$a = 1.1;
$a = 'Orz';
$a = intval($a);
$a = (string) $a;
$a = (array) $a;
$a = (object) $a;
// 0、空值、null、布尔判断
$a = 0; // int
$a = ''; // string
$a = null; // NULL
$a = false; // bool
// var_dump($a);
// echo "<hr>";
/*类型判断*/
// if (isset($a)) echo 'isset()==true<br>';
// if ($a) echo '$a==true<br>';
// if (empty($a)) echo 'empty()==true<br>';
// if (is_null($a)) echo 'is_null()==true<br>';
// if (is_bool($a)) echo 'is_bool()==true<br>';
// echo (is_numeric('-0.1')?'num':'string');
// if (is_numeric($a)) echo '是数字 is_numeric()==true<br>'; else echo '不是数字 is_numeric()==false<br>';// 检测是否为数字字符串，可为负数和小数
// if (ctype_digit($a)) echo "是自然数 ctype_digit()==true<br>";
// else echo "不是自然数 ctype_digit()==false<br>";// 检测字符串中的字符是否都是数字，负数和小数会检测不通过
// if (is_string($a)) echo 'is_string()==true<br>';
// if (is_array($a)) echo 'is_array()==true<br>';
// if (is_object($a)) echo 'is_object()==true<br>';
//预定义变量数组：空字符，字符0，数组0，null，布尔false，空数组
// $arr_var = array('', '0', 0, null, false, array());
// foreach ($arr_var as $value) {
//     echo '<br>传入值为：' . $value . '<br>';
//     if (!isset($value)) {
//         echo 'isset()==false<br>';
//     }
//     if (empty($value)) {
//         echo 'empty()==true<br>';
//     }
//     if (!$value) {
//         echo 'self==false<br>';
//     }
//     if (is_null($value)) {
//         echo 'is_null()==true<br>';
//     }
// }
?>
<?php
/*数字处理测试*/
// echo intval(-1.02);
// echo 8%-2.5;
// print_r(['a'=>11,'ds'=>'fwew']);
// 圆周率
// echo pi(2);
// echo "START\tEND";

// 计算
$m = 3;
$n = 2;
$l = 4;
// echo $l%$m;
// echo 2%3;
// echo 5%3;
// 高精度计算
// $res = bcdiv(5.9999, 6.111111,2);
// if ($m or $n && $l<4) {
//  echo "ok";
// } else {
//  echo "no";
// }

/*进制转换*/
// $ret = apache_getenv("SERVER_ADDR");
// echo $ret;
// dechex('十转十六');hexdec('十六转十');
// $n = '001';
// $n = '015';
// $n = 999;
// $n = -999;
// $n = '3e7';
// echo dechex($n);//3e7 fffffc19
// echo "<br>";
// echo hexdec($n);//2457
// var_dump('0~3');
?>
<?php
/*文件处理测试*/
// $img = pathinfo('dads/dadas/rr/dog..png');
// print_r($img);

// 遍历
// print_r(glob('*'));
// foreach (glob('*') as $k => $v) {
//     echo '编号：'.($k+1).str_repeat('&nbsp',4);
//     echo '<a href="http://demo.wincomtech.cn/'.$v.'">'.$v.'</a><br>';
// }
// 目录创建
// $dir = 'ZZZZZ/aa/bb/cc';
// if (!file_exists($dir)) {
//  $mk = mkdir($dir,0777);
//  if ($mk) {
//      echo "创建成功！";
//  }
// }
// $dir2 = 'ZZZZ';
// if (file_exists($dir2)) {
//  rmdir($dir2);
// }
// $file = 'D:/WWW/discuz/source/plugin/lodatasheet/upload/datasheet/pic/2017-01-22/art大元素使.jpg';
// $file = 'http://discuz.32/source/plugin/lodatasheet/upload/datasheet/pic/2017-01-22/art大元素使.jpg';
// if($file!="" && is_file(iconv("utf-8","gb2312",$file))==true){ //判断文件是否存在
//  $file_name=iconv("utf-8","gb2312",$file); //编码转换
//  if(file_exists($file_name)){
//      if(is_writable($file_name)){ //判断文件是否具备写的权限
//          $fp=fopen($file_name,"w+"); //打开指定的文件
//          if(fwrite($fp,$file_content)){ //执行写入的操作
//              echo"<script>alert('文件写入成功!');</script>";
//          }else{
//              echo"<script>alert('文件写入失败!');</script>";
//          }
//          fclose($fp); //关闭文件
//      }elseif(is_readable($file_name)){ //判断文件是否具备读的权限
//          echo"<script>alert('文件只具备读权限!');</script>";
//      }else{
//          echo"<script>alert('文件不具备读、写权限!');</script>";
//      }
//  }else{
//      echo"<script>alert('文件不存在!');</script>";
//  }
// }else{
//  echo"<script>alert('请输入正确的文件路径!');</script>";
// }
// print_r(iconv_get_encoding());
// echo mb_detect_encoding($file);
// echo "<br>";
// $file = iconv("utf-8","gb2312",$file);
// echo $file."<br>";
// echo mb_detect_encoding($file);
// echo "<br>";
// 当前只针对中文编码的文件删除
// if (file_exists($file)) {
//  echo "file_exists：".$file;
//  // echo unlink($file);
// }
// if (is_file($file)) {
//  echo "is_file：".$file;
// }
?>


<?php
/*JSON 特性，与其它序列化*/
/*$a = array(
'top'=>'定点',
'down'=>'xiazai',
'up'=>'上去',
);// 解码后为对象
$a = array(
array(1,2),
array(2,3)
);// 解码后为数组
// $a = array(1,2,3);// 解码后为数组
// $a = 1;// 解码后为数字
// var_dump($a);
echo "<br>";
$b = json_encode($a);
// $b = '["2","13"]';
var_dump($b);
echo BR;
$c = json_decode($b);
print_r((array)$c);
echo "<br>";
var_dump($c);
// echo $c[0];*/

// json 与 serialize
// $jo ='{"id":"1","sel":"Xlsx","Scode":["ProjectNo","ProjectName","SecurityMark","Level","BorrowerName","SuccLoanTimes","FailedTimes","Total","APR","Term","Repayment","Progress","Bidders","RemainTime","Status","Balance","ResidenceAuth","EducationAuth","CreditCert","Details","PayOff","LessThan15Days","MoreThan15Days","TotalAmount","PendingAmount","Receivables","FirstSuccLoaning","Registration"],"where":{"f":[""],"o":["="],"v":[""],"r":["and"]}}';
// $ser = 'a:2:{i:0;s:1:"2";i:1;s:2:"13";}';
// $jo = '["11","10","9","8","7","6"]';
// $to_unser = unserialize($ser);
// var_dump($to_unser);
// $to_obj = json_decode($jo);
// $to_arr = (array)$to_obj;
// var_dump($to_obj);
// var_dump($to_arr);
// $letter = 'a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,aa,ab,ac,ad,ae,af,ag,ah,ai,aj,ak,al,am,an,ao,ap,aq,ar,as,at,au,av,aw,ax,ay,az,ba,bb,bc,bd';
// $upper = strtoupper($letter);
// // $upper = strtolower($letter);
// $box = explode(',', $upper);
// $total = count($box);
// echo $total;
// print_r($box);
// $cates = array(1,2);
// $firms = array('a'=>3,'b'=>'loc');
// $firms1 = serialize($firms);
// $firms1 = unserialize($firms1);
// $firms2 = json_encode($firms);
// $firms2 = '{"display":"显隐","col":"收藏","zan":"点赞","cai":"踩","down":"下载"}';
// $firms2 = json_decode($firms2);
// $firms2 = (array)$firms2;
// print_r($firms);
// echo "<br>";
// print_r($firms1);
// echo "<br>";
// print_r($firms2);
// $ajax = json_decode('{"display":"显隐","col":"收藏","zan":"点赞","cai":"踩","down":"下载"}');
// foreach ((array)$ajax as $k => $v) {
//  $tab['ajax'][] = array('&pluginop=ajax&sign='.$k.'&loid=', $v, $k);
// }
// print_r($tab);
// 超级全局变量
// $_COOKIE['cates'] = serialize($cates);// 不会生效的cookie
// setcookie('firms', serialize($firms), time()+3600);
// session_start();
// $_SESSION['sid'] = rand(1,9);
// $_SESSION['arr'] = array(1,9);
// 在test2.php里测试
//防止数据重复提交
// if($_POST['sid']!='' && $_POST['sid']==$_SESSION['sid']){
//  unset($_SESSION['sid']);
//  echo '提交成功！';
// } else {
//  echo '请勿重复提交！';
// }
// $_REQUEST['nickname'] = 'lothar';
?>


<?php
// 模拟支付宝支付
// $reinfo = array(
//         'buyer_email' => '915273691@qq.com',
//         'buyer_id' => '2088702363744512',
//         'exterface' => 'create_direct_pay_by_user',
//         'is_success' => 'T',
//         'notify_id' => 'RqPnCoPT3K9%2Fvwbh3InZcX1zAKAgc3Tp%2FaXllHzxdKx09%2BKcIh4jKEanfk%2F3yWYp%2FZcZ',
//         'notify_time' => '2016-12-26 14:28:27',
//         'notify_type' => 'trade_status_sync',
//         'out_trade_no' => '1482737614',
//         'payment_type' => 1,
//         'seller_email' => '531597796@qq.com',
//         'seller_id' => '2088221764857453',
//         'subject' => 'Order Sn : 1482737614 (爱杰网站管理系统)',
//         'total_fee' => '0.01',
//         'trade_no' => '2016122621001004510218046939',
//         'trade_status' => 'TRADE_SUCCESS',
//         'sign' => '03b6af4b2fb918f46fb59f727c772bdf',
//         'sign_type' => 'MD5'
//  );
// $str = '';
// foreach ($reinfo as $key => $value) {
//  $str .= $str ? '&'.$key.'='.$value : $key.'='.$value;
// }
// echo '<a href="http://dou.aijie/include/plugin/alipay/return_url.php?'.$str.'">爱杰模拟支付</a>';
?>
<?php
/*
百度站长工具:
链接提交=>php推送示例
http://zhanzhang.baidu.com/linksubmit/index?site=http://discuz.wowlothar.cn/
 */
// $urls = array(
//     'http://www.wowlothar.cn/test/wangfei.html',
// );
// $api = 'http://data.zz.baidu.com/urls?site=www.wowlothar.cn&token=vx500lB9NsETpKCN';
// $ch = curl_init();
// $options =  array(
//     CURLOPT_URL => $api,
//     CURLOPT_POST => true,
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_POSTFIELDS => implode("\n", $urls),
//     CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
// );
// curl_setopt_array($ch, $options);
// $result = curl_exec($ch);
// $result = json_decode($result);
// var_dump((array)$result);
?>
<?php
/*缓存、压力测试*/
/*Memcache测试*/
// $m = new Memcache;
// $m->connect("http://hielec.wincomtech.cn", 11211);
// $val = $m->get('9*nwod');
// debug($val);
// memcache本身没有限制IP的功能，可能被外网利用
// $mem= new Memcache;
// // $mem->connect('192.168.0.178');
// $mem->connect('www.wincomtech.cn');
// var_dump($mem->get('zz'));
// var_dump($mem->get('company'));
/*压力测试*/
// Apache ab abs

?>
<?php
/*MySQL数据库操作*/

/*thinkCMF*/
// 插入新数据
function insertTD($it = '', $nums = 1)
{
    // $it = "INSERT INTO `cmf_shop_gav` (`goods_id`,`av_id`) VALUES ";
    $it = "INSERT INTO `cmf_usual_car` (`brand_id`,`serie_id`,`model_id`,`platform`,`shop_price`,`car_age`) VALUES ";
    error_log(date('Y-m-d H:i:s') . '---' . $it . "\r\n", 3, 'data/log.txt');

    for ($i = 0; $i < 50000; $i++) {
        // $it .= '('.rand(1,99999).','.rand(0,15).'),';
        $it .= '(' . rand(0, 185) . ',' . rand(0, 857) . ',' . rand(0, 14) . ',' . rand(1, 2) . ',' . rand(0, 100) . ',' . rand(0, 30) . '),';
    }
    $it = substr($it, 0, -1);
    // echo $it;die;
    error_log(date('Y-m-d H:i:s') . '---' . $i . "\r\n", 3, 'data/log.txt');

    $result = Db::query($it);
    error_log(date('Y-m-d H:i:s') . "\r\n\r\n", 3, 'data/log.txt');
    if ($result && $nums > 0) {
        $nums--;
        insertTD($it, $nums);
    } else {
        return $i;
    }
}

/*防sql注入*/
/*function inject_check($sql_str) {
$check = eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file |outfile', $sql_str);// 进行过滤 防止sql注入
if ($check) { exit("输入非法注入内容！"); }
return $sql_str;
}
$_GET['id'] = inject_check($_GET['id']);
//$_GET['id']=addslashes($_GET['id']);
$sql = "select * from `table` where `id`='$_GET[id]'";// 规范的sql echo $sql;*/

/*// 过滤转化
function check_input($value){
// 去除斜杠
if (get_magic_quotes_gpc()){
$value = stripslashes($value);
}
// 如果不是数字则加引号
if (!is_numeric($value)){
$value = '\''. mysql_real_escape_string($value) . "'";
}
return $value;
}*/

/*进行安全的 SQL*/
/*$con = mysql_connect('localhost', 'root', 'root');
if (!$con){
die('Could not connect: ' . mysql_error());
}
$user = check_input($_POST['user']);
$pwd = check_input($_POST['pwd']);
$sql = "SELECT * FROM users WHERE user=$user AND password=$pwd";
$query = mysql_query($sql);
mysql_close($con);*/
// 总结如下：
// 1. 对于magic_quotes_gpc=on的情况，
// 我们可以不对输入和输出数据库的字符串数据作
// addslashes()和stripslashes()的操作,数据也会正常显示。
// 如果此时你对输入的数据作了addslashes()处理，
// 那么在输出的时候就必须使用stripslashes()去掉多余的反斜杠。
// 2. 对于magic_quotes_gpc=off 的情况
// 必须使用addslashes()对输入数据进行处理，但并不需要使用stripslashes()格式化输出
// 因为addslashes()并未将反斜杠一起写入数据库，只是帮助mysql完成了sql语句的执行

/* 在 SQL 中增加 HAVING 子句原因是，WHERE 关键字无法与合计函数一起使用。*/
// $sql = "SELECT deptno,job,AVG(sal) FROM EMP GROUP BY deptno,job HAVING AVG(sal)>(SELECT sal FROM EMP WHERE ename='MARTIN');";
// $res = mysql_query($sql);
// $row = mysql_fetch_array($res);

/*$is_dspoints = true;//dspoints true开启分流
$is_pwecha_msg = false;//上级微信息 true开启微信消息
if (empty($is_dspoints)) {
echo "0";
// $record['puid1_money'] = $moeys;
// $dspoints = 0;
} else {
echo "1";
// $record['puid1_money'] = bcdiv(bcmul($moeys,$rts['fx_per_bonus'],6),100,6);
// $dspoints = bcdiv(bcmul($moeys,$rts['fx_per_shopping'],6),100,6);
// $this->App->insert('user_spoints_change',array('buyuid'=>$uid,'order_sn'=>$order_sn,'thismonth'=>$thismonth,'thism'=>$thism,'spoints'=>$dspoints,'changedesc'=>'购物返佣金('.$bi_name[1].')','time'=>mktime(),'uid'=>$parent_uid,'level'=>'1'));
}
if (!empty($is_pwecha_msg)) {
echo "string";
// $this->action('api','send',array('openid'=>$pwecha_id,'appid'=>$appid,'appsecret'=>$appsecret,'nickname'=>$nickname,'money'=>$moeys,'order_sn'=>$order_sn),'payreturnmoney');
}*/
?>