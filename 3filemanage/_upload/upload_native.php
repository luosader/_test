<?php 
if (!empty($_FILES)) {
    $file = $_FILES['fvg'];
    var_dump($file);
    // move_uploaded_file();
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <!-- 可以美化样式  -->
    <input type="file" name="fvg" accept="audio/*|video/*|image/*|MIME_type">
    <button>提交</button>
</form>