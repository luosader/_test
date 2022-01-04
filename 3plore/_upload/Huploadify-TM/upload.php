<?php
$filename = $_FILES['file']['name'];
$file = getcwd().'/upload/'.$filename;
if (!empty($filename)) {
    move_uploaded_file($_FILES["file"]["tmp_name"], $file);
}
// $key = $_POST['key'];
// $key2 = $_POST['key2'];
// echo $key2;

// session_start();
// $_SESSION['fileselect'] = "uploads/" . $filename;
echo $file;
exit;
?>