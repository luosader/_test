<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JQ图片裁剪</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
	
</head>

<body>
  <div style="width:300px; padding:100px 0 0 0;margin:0 auto;">
	说明：上传头像请小于1M，格式为 jpg,gif,png 格式的图片，请勿上传反动、色情图片，以免帐户被删除 <br />
	<br />
	<form method="post" action="__URL__/cutimg" enctype="multipart/form-data">
		<input type="file" name="newico"   /><br />上传头像
		<br />
		<input type="submit" name="submit" value="好了，上传" />
	</form>
</div>
</body>
</html>