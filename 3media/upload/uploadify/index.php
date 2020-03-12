<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>UploadiFive Test</title>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="jquery.uploadify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="uploadify.css">
    <style type="text/css">
    body {
        font: 13px Arial, Helvetica, Sans-serif;
    }
    </style>
</head>

<body>
    <h1>Uploadify Demo</h1>
    <form>
        <div id="queue"></div>
        <input id="file_upload" name="file_upload" type="file" multiple="true">
    </form>
    <script type="text/javascript">
    <?php $timestamp = time();?>
    $(function() {
        $('#file_upload').uploadify({
            'formData': {
                'timestamp': '<?php echo $timestamp;?>',
                'token': '<?php echo md5('
                unique_salt ' . $timestamp);?>'
            },
            'swf': 'uploadify.swf',
            'uploader': 'uploadify.php'
        });
    });
    </script>
</body>

</html>