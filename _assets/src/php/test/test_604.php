 <?php
header('Content-Type:text/html;charset=UTF-8');
/*

 */
$a = strpos('this is a test!', 'is');
echo substr('this is a test!',$a,11)."<br>";
echo mb_substr('曾经年少爱追梦', 4,3,'utf-8')."<br>";
echo mb_substr('曾经年少爱追梦', 1,3,'gb2312')."<br>";
echo "<br>";
echo rand(0,100)."<br>";
echo mt_rand(0,100)."<br>";
echo "<br>";
echo uniqid()."<br>";
echo uniqid("img_",true)."<br>";
echo "<br>";
echo strip_tags("Hello <b><i>World!</i></b>","<i>")."<br>";
echo strip_tags("Hello <b><i>World!</i></b>","<b>")."<br>";
echo "<br>";
echo ("I'm OK!")."<br>";
echo addslashes("I'm OK!")."<br>";
echo ("I\'ll be back!")."<br>";
echo stripslashes("I\'ll be back!")."<br>";
$m='1=1\' password=\'admin';
//addslashes($m);
echo "select * from user where name='".$m."';"."<br>";
echo "<br>";
$n="<";
echo $n;
echo htmlspecialchars($n,ENT_NOQUOTES,'UTF-8')."<br>";
echo "<br>";
echo ("it's so easy")."<br>";
echo ucfirst("it's so easy")."<br>";
echo ucwords("it's so easy")."<br>";
echo strtoupper("it's so easy")."<br>";
echo "<br>";
echo str_repeat("&nbsp",12);
echo ("I'm OK!")."<br>";
echo "<br>";
echo strrev('abcd')."<br>";
$z='abcdefg';
function demo($z){
	return strrev($z);
}
echo demo($z);
echo "<br>"."<br>"."<br>"."<br>"."<br>";
/* 作业604
	倒序
*/

?>