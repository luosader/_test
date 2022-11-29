<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title></title>
</head>
<body>
<div id="test">

</div>
</body>
</html>


<script src="jquery-1.11.3.min.js"></script>
<script type="text/javascript">
	
	$.ajax({
			url:'1.php',
			success:function(r){

				$("#test").html(r);

			}

	})
</script>

