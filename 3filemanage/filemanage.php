<?php
// header('Content-Type:text/html;charset=UTF-8');
// include_once('connect.php');
// hash(algo, data)
// echo "<br>";


// 二、解析路径：
$pathfile = "test/rule.ini";
$pathfolder = "test";
$filename = "test/rule.ini";

$file = basename($pathfile,".php"); //获得文件名
$file = dirname($pathfolder); //得到目录部分
$pathinfo = pathinfo($pathfile); //得到路径关联数组 dirname basename extension filename
// var_dump($pathinfo);echo "<br>";
$stat = stat($pathfile);
// print_r($stat);echo "<br>";

// $con = file_get_contents($pathfile);
// echo $con;
$con = file($pathfile);
// print_r($con);

$b=array();
// while ($h = mysql_fetch_assoc($result)) {
// $b[] = $h;
// }
foreach ($con as $key => $value) {
	$a = explode('@', $value);
	$b[]=array($a[1]=>$a[2].' - '.$a[3]);
}
print_r($b);



// $dir = "d:/www/1/";
// $dirs = opendir($dir);
// while($file = readdir($dirs)){
//   $filepath = $dir.$file;
//   $a = is_dir($filepath);
//   if(!$a){
//     $newfile = ereg_replace(",","_",$file);
//     rename($filepath,$dir.$newfile);
//     // rename($filepath,$dir."1_".$file);
//   }
// }


// 二、类型
// echo filetype('test/rule.ini').'<br/>'; // file
// echo filetype('test').'<br/>'; // dir

// 2. file 把整个文件读入一个数组中(此函数是很有用的)
// 和 file_get_contents() 一样，只除了 file() 将文件作为一个数组返回。数组中的每个单元都是文件中相应的一行，包括换行符在内。如果失败 file() 返回 FALSE。
// $lines = file($pathfile);
// 在数组中循环，显示 HTML 的源文件并加上行号。
// foreach ($lines as $line_num => $line) {
// 	echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
// }
// 另一个例子将 web 页面读入字符串。参见 file_get_contents()。
// $html = implode('', file ('http://www.example.com/'));







// ?、遍历
// 1、匹配目录下.txt后缀的文件
// foreach (glob("*.php") as $filename) {
// 	// $filename = iconv('utf-8','gbk',$filename);//报错
// 	// $filename = iconv("UTF-8","GB2312//IGNORE",$filename);
// 	echo "$filename size " . filesize($filename) . "<br>";
// }


// 2、实现兼容大小写匹配
// $pattern = sql_regcase("*.php");
// var_dump(glob($pattern));
// foreach (array_merge(glob("*.php"),glob("*.PHP")) as $filename) {
// 	echo "$filename n<br>";
// }


// 3、匹配所有
// (1)、匹配所有文件
// $dirArr=glob("*.php");
// $dirArr = glob('../05-15/1*.php');
// $files = array_map('realpath',$dirArr);//按绝对路径
// print_r($files);
// rsort($dirArr);//按键值倒序
// arsort($dirArr);//按键值倒序，保持键值对顺序
// krsort($dirArr);//按键名倒序
// foreach ($dirArr as $filename) {
// 	echo $filename.'<br>';
// }

// (2)、匹配所有(包括根目录,带..的)
// $dirArr = glob('{,.}*', GLOB_BRACE);
// var_dump($dirArr);

//老版本中使用，新版本用foreach
// while((list($key,$value)=each($dirArr))){
//  echo $key."=>".$value;
//  echo "<br/>";
// }


// 4、获取目录下的所有子目录
// (1)、
// function listdirs($dir='') {
// 	static $alldirs = array();
// 	$dirs = glob($dir . '/*', GLOB_ONLYDIR);
// 	if (count($dirs) > 0) {
// 		foreach ($dirs as $d) $alldirs[] = $d;
// 	}
// 	foreach ($dirs as $dir) listdirs($dir);
// 	return $alldirs;
// }
// (2)、
// $list = glob("p*.php");
// foreach ($list as $l) {
// 	if (preg_match("~^p+\.php$~",$file))
// 		$files[] = $l;
// }







// 三、目录






// 四、大小
// 1、返回一个目录的磁盘总大小
function dir_size($dir='test'){
	$dir_size = 0;
	if($dh = @opendir($dir)){
		while(($filename = readdir($dh)) != false){
			if($filename !='.' and $filename !='..'){
				if(is_file($dir.'/'.$filename)){
					$dir_size +=filesize($dir.'/'.$filename);
				}else if(is_dir($dir.'/'.$filename)){
					$dir_size +=dir_size($dir.'/'.$filename);
				}
			}
		}
	}
	@closedir($dh);
	return $dir_size;
}
// echo dir_size();

// 2、获得目录所在磁盘分区的可用空间（字节单位）
//包含根目录下可用的字节数
// $df = disk_free_space("/");
//在 Windows 下:
// $df = disk_free_space("E:");
// echo $df;

// 3、转换文件大小
function transByte($size) {
  $arr = array ("Byte", "KB", "MB", "GB", "TB", "EB" );
  $i = 0;
  while ( $size >= 1024 ) {
    $size /= 1024;
    $i ++;
  }
  return round ( $size, 2 ) ."\n". $arr[$i];
}
// echo transByte(filesize($filename));

function realsize($size){
 $size = $size ? $size : 0;
	 if($size > 1073741824) {
		  $size = round($size / 1073741824 , 2).' GB';
		 } elseif($size > 1048576) {
		  $size = round($size / 1048576 , 2).' MB';
		 } elseif($size > 1024) {
		  $size = round($size / 1024 , 2).' KB';
		 } else {
		  $size = $size . ' Byte';
		 }
	 return $size;
}












// 十、其它
// array_map(unlink,$dirArr);//删除a目录及旗下文件
// rmdir("a");







// 四、注意事项
// 1，不能作用于远程文件，被检查的文件必须通过服务器的文件系统访问。
// 2，使用 glob("[myfolder]/*.txt")将不能匹配，解决方法为 glob("[myfolder]/*.txt")，注意[]字符应用。
// 3，其次是第二个参数flags有效标记说明
// （1）GLOB_MARK - 在每个返回的项目中加一个斜线
// （2）GLOB_NOSORT - 按照文件在目录中出现的原始顺序返回（不排序）
// （3）GLOB_NOCHECK - 如果没有文件匹配则返回用于搜索的模式
// （4）GLOB_NOESCAPE - 反斜线不转义元字符
// （5）GLOB_BRACE - 扩充 {a,b,c} 来匹配 'a'，'b' 或 'c'
// （6）GLOB_ONLYDIR - 仅返回与模式匹配的目录项 注意: 在 PHP 4.3.3 版本之前 GLOB_ONLYDIR 在 Windows 或者其它不使用 GNU C 库的系统上不可用。
// （7）GLOB_ERR - 停止并读取错误信息（比如说不可读的目录），默认的情况下忽略所有错误 注意: GLOB_ERR 是 PHP 5.1 添加的。

// glob()函数的典型应用是读取数据表文件，如获取某个目录下的.sql后缀文件，这种在单元测试中非常实用，可实现读取sql文件重建数据库等，具体请参与PHP手册，请关注下一期PHP内置函数研究系列







?>