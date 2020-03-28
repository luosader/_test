<?php
    $host = '192.168.0.212'; //192.168.0.212
    $port = 2020;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <script type="text/javascript">
        // var url = 'ws://192.168.0.212:2020';
        var url = 'ws://<?= $host ?>:<?= $port ?>';
    </script>
</body>
</html>