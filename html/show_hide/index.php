

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<script type="text/javascript" src="../_assets/static/js/jquery-1.11.0.min.js"></script>
</head>
<body>
	<a id="sel">有图</a>
	<span id="shows"></span>
</body>
</html>
<script type="text/javascript">
	
  $(function($){
      $("#sel").click(function(){
          var uid = $(this).attr("opus_id");
          var url="show.php?Uid="+uid;
          // alert(uid);
          // alert(url);
          $.ajax({
              url:url,
              type:"POST",
              data:{Uid:uid},
              success:function(msg){
                  //alert(msg);
                  $("#shows").html(msg);
              }
          })
      });

  })(jQuery);
</script>
