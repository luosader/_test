<?php
$filename = $_FILES['file']['name'];
if ($filename) {
    move_uploaded_file($_FILES["file"]["tmp_name"],
      "uploads/" . $filename);
}
// $key = $_POST['key'];
// $key2 = $_POST['key2'];
// echo $key2;

// session_start();
// $_SESSION['fileselect'] = "uploads/" . $filename;
echo "uploads/" . $filename;
// exit();
?>