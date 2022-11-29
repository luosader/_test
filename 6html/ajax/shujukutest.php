<?
$db_conn = mysqli_connect("localhost",'root','root','huaran');
$db_conn->query("set names utf8");
$sql = "select cover_id from xiaobing360_document where id>158";
$result = $db_conn->query($sql);
$ids = '';
while ($thin = $result->fetch_array(MYSQL_ASSOC)) {
	# code...
	$ids .= $thin['cover_id'].',';
}
$ids = substr($ids, 0,-1);
echo $ids;
$sql = "select id,path from xiaobing360_picture where id in (".$ids.")";
$result = $db_conn->query($sql);
while ($thin = $result->fetch_array(MYSQL_ASSOC)) {
	# code...
	$path = str_replace('big_','thumb_',$thin['path']);
	$sql = "update xiaobing360_picture set path='".$path."' where id=".$thin['id'];
	$db_conn->query($sql);
	echo $thin['id']. ' is ok';
}
?>