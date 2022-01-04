<?php
// echo "Ok";
// print_r($_FILES);
$filename = $_POST['name'];
$name = iconv('utf-8', 'gbk', getcwd().'/'.$filename);
echo $name;
if(file_exists($name)){
	$tmp = file_get_contents($_FILES['part']['tmp_name']);
	file_put_contents($name, $tmp, FILE_APPEND);
}else{
	move_uploaded_file($_FILES['part']['tmp_name'], $name);
}
?>