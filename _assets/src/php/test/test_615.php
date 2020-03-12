<?php
header('Content-Type:text/html;charset=UTF-8');
//作业615  在Html中遍历数组

	$arr = array(array('title'=>'第一个文章标题','author'=>'admin','time'=>'1434077500','content'=>'你好','href'=>'about:cehome'),array('title'=>'第二个文章标题','author'=>'张三','time'=>'1434076500','content'=>'慕课网-国内最大的IT技能学习平台','href'=>'http://www.imooc.com'),array('title'=>'第三个文章标题','author'=>'游客','time'=>'1434066500','content'=>'你好','href'=>''));
	$rep = str_repeat("&nbsp",15);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>array</title>
	<style type="text/css">

	</style>

	<script type="text/javascript"></script>

</head>
<body>
	<div class="main">
		<?php foreach ($arr as $v) {?>
		<div class="post">
			<h3><?php echo  $v['title'] ?></h3>
			<p><?php echo $v['author']; echo $rep; //print_r($rep) ?><?php echo date('Y-m-d H:i:s',$v['time']) ?></p>
			<p><?php echo $v['content']; echo $rep ?><a target="_blank" href="<?php echo $v['href']?>">相关链接</a></p>
		</div>
		<?php } ?>
	</div>
	
</body>
</html>