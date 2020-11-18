<?php
header('Content-Type:text/html;charset=UTF-8');
define('DS', DIRECTORY_SEPARATOR);

//获取到页面传递的文件路径, 需要查询的字符串
$dir   = $_POST['checkDir'];
$check = $_POST['checkStr'];
// 判断目录结尾
$dir = ((strrchr($dir, DS) == DS) || (strrchr($dir, '/') == '/')) ? $dir : $dir . DS;
//去掉字符串中的所有空格, 回车, tab缩进
$check = str_replace(array(' ', "\r\n", "\t"), '', $check);

$handle = openDir($dir); //打开目录
$data   = [];
while ($file = readdir($handle)) {
    $path = $dir . $file;
    if (filetype($path) != 'dir') {
        $out = file_get_contents($path);
        $out = str_replace(array(' ', "\r\n", "\t"), '', $out);

        $row['status'] = strstr($out, $check) ? 1 : 0;
        $row['href']   = $path;
        $row['name']   = $file;
        $row['size']   = filesize($path);
        $row['type']   = filetype($path);
        $row['time']   = date('Y-n-t', (filemtime($path)));
        $data[]        = $row;
    }
}
closedir($handle); //关闭目录
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>检索结果</title>
    <style type="text/css">
        .table{width:100%;max-width:100%;margin-bottom:20px;}
    </style>
</head>
<body>
    <h3>全文检索结果</h3>
    <hr>
    <table class="table" id="allFile">
        <thead>
            <tr align="center">
                <th class="listNum">Num</th>
                <th >Status</th>
                <th >File Name</th>
                <th >File Size</th>
                <th >File Type</th>
                <th >Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $vo): ?>
            <tr align="center">
                <td><?= $key + 1?></td>
                <td>
                    <?php if (empty($vo['status'])): ?>
                        <span class="red">X</span>
                    <?php else: ?>
                        <span>√</span>
                    <?php endif;?>
                </td>
                <td><a href="<?= $vo['href'] ?>" target="_blank"><?= $vo['name'] ?></a></td>
                <td><?= $vo['size'] ?> byte</td>
                <td><?= $vo['type'] ?></td>
                <td><?php echo $vo['time']; ?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</body>
</html>