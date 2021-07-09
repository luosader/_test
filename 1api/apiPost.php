<?php

    $gid = 464; //140
    $cid = 248;
    $data = [
        ['id' => 17144, 'price' => 1.1, 'unit' => ''],
        ['id' => 17146, 'price' => 1.2, 'unit' => ''],
        ['id' => 17148, 'price' => 1.3, 'unit' => ''],
    ];
    $datajson = json_encode($data);
    // htmlspecialchars_decode(string)
    // htmlspecialchars();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API请求</title>
    <script src="../_assets/static/js/jquery-1.12.1.min.js"></script>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="order_no" value="T0902107011952156736" placeholder="order no">
        <input type="text" name="status" value="2" placeholder="状态">
        <input type="text" name="delivery" value="100" placeholder="交货量">
        <input type="text" name="note" value="test" placeholder="说明">
        <button type="button" class="jq-qiuka-query" data-action="http://mmoexp.test/api/orderupdate.html">⦁订单状态变更</button>
    </form>
    <form action="" method="POST">
        <input type="text" name="gid" value="<?php echo $gid ?>" placeholder="游戏ID">
        <input type="text" name="cid" value="<?php echo $cid ?>" placeholder="类目ID">
        <input type="text" name="limit" value="0,3" placeholder="限定范围">
        <button type="button" class="jq-qiuka-query" data-action="http://mmoexp.test/api/itemlist.html">⦁球员卡查询</button>
    </form>
    <form action="" method="POST">
        <input type="text" name="gid" value="<?php echo $gid ?>" placeholder="游戏ID">
        <input type="text" name="data" value=<?php echo $datajson ?> placeholder="待更新的数据，json">
        <button type="button" class="jq-qiuka-query" data-action="http://mmoexp.test/api/itemupdate.html">⦁球员卡销售价格更新</button>
    </form>
</body>
<script type="text/javascript">
    // http://localhost/_test/1api/apiPost.php
    $('.jq-qiuka-query').click(function() {
        // var data = $(this).closest('form').serialize();
        var data = $(this).closest('form').serializeArray();
        var action = $(this).attr('data-action');

        // data.push({"name":"_action","value":action});
        // // var url = $(this).closest('form').attr('action');
        // var url = 'http://localhost/_test/1api/apiResponse.php';
        // $.post(url, data, function(back, textStatus, xhr) {
        //     console.log(back);
        // });

        // action = 'http://mmoexp.test/api/index.html';
        $.post(action, data, function(back, textStatus, xhr) {
            console.log(back);
        });
    });
</script>
</html>