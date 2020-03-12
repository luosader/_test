<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Ajax异步传输</title>
	<script type="text/javascript" src="../../_assets/static/js/jquery-1.11.0.min.js" ></script>
	<style type="text/css">
		#showmessage{margin-top: 10px;color:#F00;font-size: 26px;font-family: '微软雅黑';}
	</style>
</head>
<body>
	<div>Ajax异步传输，执行PHP命令，写日志</div><br>
	<img src="backend.php" /><br>
	<form method="post" action="">
		<input type="button" value="发送异步指令" id="send" />
		<input type="button" value="清除记录" id="clear" />
	</form>
	<div id="showmessage"></div>
</body>
<script type="text/javascript">
	$(function(){
		$('#send').click(function(){
			$.ajax({
				url:'backend.php',
				type:'POST',
				data:{cmd:'send',callback:'指令发送成功！'},
				// dataType:'json',
				success:function(data){
					$('#showmessage').html(data);
				}
			})
		})
		$('#clear').click(function(){
			$.ajax({
				url:'backend.php',
				type:'POST',
				data:{cmd:'clear',callback:'清除记录成功！'},
				// dataType:'json',
				success:function(data){
					$('#showmessage').html(data);
				}
			})
		})
	})
</script>
</html>