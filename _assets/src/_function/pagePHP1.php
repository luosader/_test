<?php
    include_once('php/connect.php');

    //每页的帖子数
    $num = 10;
    //获取帖子总页数
    $sql = 'select pid from tr_post where tag<>0;';
    $result = mysql_query($sql);
    $count = mysql_num_rows($result);//算出已删帖子的总数
    $page = ceil($count/$num);//ceil割舍取整
    //获取帖子当前页数
    if (empty($_GET['pl'])) {
        $pl = 1;
    }else{
        $pl = $_GET['pl'];
    }
    //计算起始记录数 
        $start = ($pl-1)*$num;

    // 
    $sql = 'select * from tr_post where tag<>0 order by pid desc limit '.$start.','.$num.' ; ';
    $result = mysql_query($sql);
    $postl = array();
    while ($h = mysql_fetch_assoc($result)) {
        $postl[] = $h;
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP实现分页</title>
</head>
<body>
    <div class="page">
        <!-- 首页处理 -->
        <?php if ($pl != 1) { ?>
            <a href="postlist.php?pl=1">首</a>
        <?php } ?>

        <!-- 上三页 -->
        <?php for($i = $pl-4;$i < $pl ; $i++) { ?>
            <?php if ($i > 0) { ?>
                <!--a标签里嵌套php-->
                <a  href="postlist.php?pl=<?php echo $i ?> " ><?php echo $i ?></a>
            <?php } ?>
        <?php } ?>
        <!-- 当前页 -->
            <a style="background-color: #009241;color: #FFF;" href="postlist.php?pl=<?php echo $pl ?> " ><?php echo $pl ?></a>
        <!-- 下三页 -->
        <?php for($i = $pl+1;$i < $pl+5 ; $i++) { ?>
            <?php if ($i <= $page) { ?>
                <a  href="postlist.php?pl=<?php echo $i ?> " ><?php echo $i ?></a>
            <?php } ?>
        <?php } ?>
        <!-- 尾页处理 -->
        <?php if ($pl != $page) { ?>
            <a href="postlist.php?pl=<?php echo $page ?>">尾</a>
        <?php } ?>
    </div>
</body>
</html>