<?php
$str = "php编程";
echo $str.'<br>';
// $pattern = '/^([\x{4e00}-\x{9fa5}·s]{1,20}|[a-zA-Z.s]{1,20})+$/u';
// $pattern = "/^[\x{4e00}-\x{9fa5}·0-9A-z]+$/u";
$pattern = "/^[\x{4e00}-\x{9fa5}]+$/u";//匹配汉字的正确姿势
$pattern = "/^[".chr(0xa1)."-".chr(0xff)."A-Za-z0-9_]+$/";//GB2312汉字/字母/数字/下划线正则表达式
$pattern = "/^[\x{4e00}-\x{9fa5}A-Za-z0-9_.]+$/u";//UTF-8汉字/字母/数字/下划线/点正则表达式
if (preg_match($pattern, $str)) {
    print("该字符串全部是中文");
} else {
    print("该字符串不全部是中文");
}
echo '<br><hr>';

$action = trim(@$_GET['action']);
if ($action == "sub") {
    $str = $_POST['dir'];
    if (!preg_match($pattern, $str)) 
    {
        echo "<font color=red>您输入的[" . $str . "]含有违法字符</font>";
    } else {
        echo "<font color=green>您输入的[" . $str . "]完全合法,通过!</font>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="?action=sub">
        输入字符(数字,字母,汉字,下划线):
        <br>
        <input type="text" name="dir" value="">
        <input type="submit" value="提交">
    </form>
</body>
</html>
