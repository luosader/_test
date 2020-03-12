<?php
//便捷影视传媒，源码提供！http://i6x.cn/
ini_set("error_reporting","E_ALL & ~E_NOTICE");
if(isset($_GET['w'])){
	$w=addslashes(htmlspecialchars($_GET['w']));
	$url = "http://soso.music.qq.com/fcgi-bin/fcg_search_xmldata.fcg?source=20&w=".$w."&type=qry_song&out=json&p=1&perpage=20&ie=utf-8&uin=0&inCharset=GB2312&outCharset=GB2312&hostUin=0&notice=0&needNewCode=0&format=jsonp&platform=musicbox&jsonpCallback=searchJsonCallback&g_tk=5381";
	$title = $w."的搜索结果";
}elseif(isset($_GET['i'])){
	$geti = explode('i6xcn',stripslashes($_GET['i']));
	$title = base64_decode(str_replace(" ","+",$geti[0]));
	$id = $geti[1] + 30123123;
	//128kb：id+30000000.mp3 | 高品质ogg：id+40000000.ogg | 320kb：id.mp3 | m4a：id.m4a 
	$mp3 = "http://tsmusic128.tc.qq.com/".$id.".mp3";//官方播放地址
	$jssc = "'音乐外链地址：','".$mp31."'";
}else{
	$p=isset($_GET['p'])?intval($_GET['p']):1;
	$last = $p-1; //上页
	$next = $p+1; //下页
	$title = "QQ音乐外链";
	if($last<1){
		$page = "<a class=\"Btn\">上一页</a>&nbsp;&nbsp;<a href=\"?p=".$next."\" class=\"Btn\">下一页</a>";
	}else{
		is_numeric($_GET['p']) or die('地址错误！！');
		$page = "<a href=\"?p=".$last."\" class=\"Btn\">上一页</a>&nbsp;&nbsp;<a href=\"?p=".$next."\" class=\"Btn\">下一页</a>";
		$title = "第".$p."页";
	}
	$url = "http://music.qq.com/musicbox/shop/v3/data/random/1/random".$p.".js";
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title><?php echo $title?> - i6x.cn </title>
<style>
*{margin:0;border:0;padding:0;}
body{font-family:"Microsoft Yahei";font-size:12px;background-color:#fff;}
.div2{position:fixed;width:521px;padding:20px;background-color:#fff;border: 1px dashed #ccc;z-index:999;margin:auto;left:0; right:0;top:0px;_position:absolute;_bottom:auto;_top:expression(eval(document.documentElement.scrollTop));}
.main{width:521px;padding:20px;border: 1px dashed #ccc;margin:10px auto}
input{border:1px solid #00aff0;width:90px;}
input:focus{background:#F9FADA;}
a{color:#000;text-decoration:none;}
.Btn{margin:0 auto;width:35px;padding:0px 5px;border-radius:3px;background-color:#f60;color:#fff;}
.Btn:hover{background-color:#9c3;color:#fff;cursor:pointer;}
.an{outline:none;background:#00aff0;color:#fff;padding:5px;margin:0px 5px;}
.an:hover{background:#9c3;}
</style>
</head>
<body>
<div id="div2" class="main">
<a href="./" class="an">首页</a>

<span style="float:right;"><?php echo $page; ?> <a href="http://t.cn/R4lxXRR" target="_blank"><img src="http://static.sae.sina.com.cn/image/poweredby/117X12px.gif" title="感谢新浪云SAE提供云计算支持！" /></a></span>
</div>
<div class="main">
感谢使用 <a href="http://i6x.cn/" target="_blank" style="color:#e53333;text-decoration:none;">便捷影视传媒</a> 提供的免费音乐外链获取程序<span style="float:right;"><form method="get" name="get" target="_blank" onsubmit="return qqget();"><input type="text" name="w" value="<?php echo $w;?>"><input type="submit" class="Btn" value="搜索" /></form></span></div>
<?php
if(isset($_GET['i'])){
	echo "<div class=\"main\"><h2 style=\"margin-bottom:15px;\">$title</h2>
	<p style=\"text-align:center;margin-bottom:15px;\"><a href=\"http://i8.tietuku.com/d63425870e84300d.png\" target=\"_blank\" style=\"color:#e53333;text-decoration:none;\">如何免费添加QQ空间背景音乐?</a> 如果不能播放，请在上面搜索歌曲名，换个试试！</p>
	<p><audio style=\"width:300px;\" autoplay=\"autoplay\" controls=\"controls\" loop=\"loop\" preload=\"auto\" src=\"$mp3\"><embed src=\"http://s.xnimg.cn/swf/player.swf?&auto_play=1&url=$mp3\" type=\"application/x-shockwave-flash\" width=\"300\" height=\"30\" wmode=\"transparent\"></embed></audio>
	<span style=\"border:0px;float:right;background:#093;color:#fff;padding:5px;margin:0px 5px;\">右键获取音乐外链</span></p>
	</div>";
	
	$baiduuk=htmlspecialchars(urlencode($title));
	$baidustr=file_get_contents("http://music.baidu.com/search/lrc?key=".$baiduuk."");
	preg_match_all('/<p id="lyricCont-0">(.*?)<\/p>/is',$baidustr,$baiduarr);
	foreach ($baiduarr[1] as $k => $v){}
	if($v){
		echo "<div class=\"main\" style=\"text-align:center;overflow-y:auto;height:200px;\">".preg_replace('/[0-9]{5,}/','59230756',trim($v))."</div>";
	}else{
		echo "<div class=\"main\" style=\"text-align:center\">没有找到《".$title."》的歌词！</div>";
	}
	echo "<SCRIPT language=\"JavaScript\">
	function click(){
	if(event.button==2){
		var val = prompt($jssc);
	}
	}
	document.onmousedown=click
	</SCRIPT>";

}elseif(isset($_GET['w'])){
	$str = file_get_contents($url);
	$text = mb_convert_encoding($str, 'utf-8', 'gbk'); //把gbk改成utf-8
	$num = explode('},{',stripslashes($text)); //分组
	for ($j=0;$j<count($num);$j++){
	preg_match('/songid:(.*?),/', $num[$j], $id);
	preg_match('/singername:"(.*?)",/', $num[$j], $gs);
	preg_match('/songname:"(.*?)",/', $num[$j], $gq);
	preg_match('/size:(.*?),/', $num[$j], $sz);
	if($id[1]){
		$title = $gs[1]." - ".$gq[1];
		$i= $j+1;
		$songid = $id[1] - 123123; //简单加密 给id减去123123 解析的时候加上123123
		$href = base64_encode($title)."i6xcn".$songid;
		$size = formatsize($sz[1]);
		echo "<div class=\"main\" onmouseover=\"this.style.backgroundColor='#BFFFFE'\" onmouseout=\"this.style.backgroundColor='#FFF'\"><a href=\"?i=".$href."\" target=\"_blank\">".$i."、<font color=\"#00AFF0\">『试听』</font>".$gs[1]." - ".str_replace($w,"<font color=\"red\">".$w."</font>",$gq[1])."</a><span style=\"float:right;\">".$size."</span></div>";
	}
	}
}else{
	$str = file_get_contents($url);
	$text = mb_convert_encoding($str, 'utf-8', 'gbk'); //把gbk改成utf-8
	$num = explode('},{',stripslashes($text)); //分组
	for ($j=0;$j<count($num);$j++){
	preg_match('/id:"(.*?)",/', $num[$j], $id);
	preg_match('/singerName:"(.*?)",/', $num[$j], $gs);
	preg_match('/songName:"(.*?)",/', $num[$j], $gq);
	preg_match('/playtime:"(.*?)"/', $num[$j], $sz);
	if($id[1]){
		$title = $gs[1]." - ".$gq[1];
		$i= ($p-1)*20 +$j+1; //每页20个 序号算法
		$songid = $id[1] - 123123; //简单加密 给id减去123123 解析的时候加上123123
		$href = base64_encode($title)."i6xcn".$songid;
		$f = floor($sz[1] / 60)."分";
		$m = $sz[1]-($f*60)."秒";
		echo "<div class=\"main\" onmouseover=\"this.style.backgroundColor='#BFFFFE'\" onmouseout=\"this.style.backgroundColor='#FFF'\"><a href=\"?i=".$href."\" target=\"_blank\">".$i."、<font color=\"red\">『试听』</font>".$title."</a><span style=\"float:right;\">".$f.$m."</span></div>";
	}
	}
}
function formatsize($size) {
	$prec=3;
	$size = round(abs($size));
	$units = array(0=>" B ", 1=>" KB", 2=>" MB", 3=>" GB", 4=>" TB");
	if ($size==0) return str_repeat(" ", $prec)."0$units[0]";
	$unit = min(4, floor(log($size)/log(2)/10));
	$size = $size * pow(2, -10*$unit);
	$digi = $prec - 1 - floor(log($size)/log(10));
	$size = round($size * pow(10, $digi)) * pow(10, -$digi);
	return $size.$units[$unit];
}
?>
<script type="text/javascript">
window.onscroll=function(){ 
    var t=document.documentElement.scrollTop||document.body.scrollTop;  
    var div2=document.getElementById("div2"); 
    if(t>= 100){ 
        div2.className = "div2";
    }else{
        div2.className = "main";
    } 
}
function qqget(){
if(get.w.value==""){
alert("请输入歌曲名称!");
get.w.focus();
return false;
}
}
</script>
<div style="display:none;">
<script src="https://s5.cnzz.com/stat.php?id=2311126&web_id=2311126" language="JavaScript"></script>
</div>
</body>
</html>