<?php
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<script type="text/javascript">
// 创建一个 websocket 连接
var ws = new WebSocket("ws://127.0.0.1:8080");

// websocket 创建成功事件
ws.onopen = function () {
};

// websocket 接收到消息事件
ws.onmessage = function (e) {
    var msg = JSON.parse(e.data);
}

// websocket 错误事件
ws.onerror = function () {
};

// 发送消息也很简单，直接调用 ws.send(msg) 方法就行了。
ws.send(msg);


function confirm(event) {
    var key_num = event.keyCode;
    if (13 == key_num) {
        send();
    } else {
        return false;
    }
}
</script>
</body>
</html>