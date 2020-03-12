<meta charset="utf-8">
<?php 
$fp = fopen("https://sf.taobao.com/download_attach.do?attach_id=32AELSLIEMLCC", "r");
header("Content-type: application/pdf");
fpassthru($fp);
fclose($fp);
?>