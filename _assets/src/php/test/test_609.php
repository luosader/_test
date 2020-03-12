 <?php
header('Content-Type:text/html;charset=UTF-8');
$str = "gdggguusiudlasvchttp://bbs.kyit.netklkdkgsdhhhttp://www.sina.com";
$pcre = "/http:\/\/(www|bbs)(.*?)(com|net)/";//子模式(www|bbs) ; .*? 是非贪婪匹配
//$arr = preg_match_all($pcre, $str);//匹配到的个数
//print_r(preg_split($pcre, $str));//分隔字符串，以$pcre为规则分隔符，把这之外的内容分开显示出来
preg_match_all($pcre, $str, $arr);//全局匹配
echo preg_match_all($pcre, $str, $arr);//显示找到的个数
print_r($arr);
echo "<br>"."<br>";

$str = "6AAaa4d5 93 6f99 8j";
$pcre = "/\s/";//输出\s空白字符
$pcre = "/.*?(k$)/";//以k结尾的
$pcre = "/(\b)\w*(\b)/";//匹配空格以外的
$pcre = "/(93(\w))/";//改变原子大小
$pcre = "/a/i";//i大小写不敏感;m多行;s换行;v;x
preg_match_all($pcre, $str, $arr);
print_r($arr);
echo "<br>"."<br>";

$str = "1a8d7 15t51 fj1536k";
//$pcre = "/\d/";//\d数字[0-9]，输出所有数字
$pcre = "/\d?/";
$pcre = "/\d{2}?/";
$pcre = "/\d.*/";
$pcre = "/(^\d).*/";

//$pcre="/\D/";
preg_match_all($pcre, $str, $arr);
print_r($arr);
echo "<br>"."<br>";

$str = "18715511536";
$pcre = "/\d{11}/";//\d数字[0-9]，输出所有数字;{11}匹配连续的11个
preg_match_all($pcre, $str, $arr);
print_r($arr);
echo "<br>"."<br>";

echo "原始的：";
echo "dg34iudl a98svchttp://bbs.kyit.netk56d msg sd2hhhttp://www.sina.coms8mlhttp://www.nbystudy.netjly".'<br>';
echo '替换后：';
$subject = "dg34iudl a98svchttp://bbs.kyit.netk56d msg sd2hhhttp://www.sina.coms8mlhttp://www.nbystudy.netjly";
$pattern = "/http:\/\/(www|bbs)(.*?)(com|net)/";
$replace = "[网址]";
print_r(preg_replace($pattern, $replace, $subject));
echo "<br>"."<br>"."<br>";

$str = preg_quote('(银子)'); 
$txt = '我的呢称(银子)'; 
echo preg_replace("/($str)/","<span style='color:#f00;'>$1</span>",$txt); 
echo "<br>"."<br>";
$str = quotemeta('(银子)'); $txt = '我的呢称(银子)'; 
echo preg_replace("/($str)/","<span style='color:#f00;'>$1</span>",$txt); 
echo "<br>"."<br>";
$str = '(银子)'; $txt = '我的呢称(银子)'; 
echo preg_replace("/($str)/","<span style='color:#f00;'>$1</span>",$txt); 
/*作业609 正则字符串查找、替换
preg_match — 匹配一个正则表达式
	preg_match(匹配的规则,需要匹配的字符串)
preg_split — 通过一个正则表达式分隔字符串
	preg_split(匹配的规则,需要匹配的字符串)
preg_replace()通过一个正则表达式替换字符串
	preg_replace(haystack正则表达式,new_needle替换用的字符串,needle要被替换的字符串,count替换次数【默认-1,无限】)
*/
?>