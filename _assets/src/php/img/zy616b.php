<?php
header('Content-Type:text/html;charset=gbk');
$filename = "D:\Program Files Professional\WampSever\www\php\img";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>file management</title>
<link rel="shortcut icon" href="img/Cat Portrait(64x64).jpg">
<link rel="stylesheet" type="text/css" href="css/icon.css" />
<script src="js/jquery-1.11.0.min.js"></script>
<style>
.{margin: 0px;padding:0px;}
body{background-color: #999;}
.main{width: 940px;height: auto;overflow: hidden;margin:0px auto; padding: 10px 20px;background-color: #EEE;}
.file{float:left;width: 940px;height: auto;overflow: hidden;padding: 10px 20px;}
</style>
<script type="text/javascript" language="javascript">

</script>
</head>
<body>
	<div class="main">
		<div class="file"><!-- 1、列出当前文件下面的所有文件和文件夹  -->
			<table class="" border="0" >
				<th >name</th><th>size</th>
				<?php foreach (glob ( "*" ) as $filename) {?>
	            <tr class="filetr" >
	                <td width="200" class="icon-file-text"><?php echo "&nbsp".$filename ?></td>
	                <td width="100" align="center"><?php echo round((filesize($filename)/1024),1).'KB' ?></td>
	            </tr>
	            <?php } ?>
			</table>
</body>
</html>
