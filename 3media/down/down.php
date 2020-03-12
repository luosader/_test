<?php 
/**
 * 文件下载 
 * 断点续传 http://www.jb51.net/article/55523.htm
 */
header('Content-Type:text/html;charset=UTF-8');//设置字符集,纯PHP中使用
require 'FileDownload.class.php';

if (!empty($_POST)) {
	echo "<pre>";
	print_r($_FILES);
	print_r($_POST);

	$upfile = 'myfile';
	$file = $_FILES[$upfile]['tmp_name'];
	$name = explode('.', $_FILES[$upfile]['name']); // 将上传前的文件以“.”分开取得文件类型
	$img_count = count($name); // 获得截取的数量
	$img_type = $name[$img_count - 1]; // 取得文件的类型
	$name = time().$img_type;
	$obj = new FileDownload();

	// $flag = $obj->download($file, $name);
	$flag = $obj->download($file, $name, true); // 断点续传 
	if(!$flag){ echo 'file not exists'; }

	unset($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>下载 - 断点续传</title>
</head>
<body>
	<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" name="myfile">
		<button type="submit">断点续传式下载</button>
	</form>
</body>
</html>