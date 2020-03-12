<?php 

require("./WeCh.class.php");
define('APPID', 'wx8df1831e48ba0b9d');
define('APPSECRET', '4ee1d147f25b87b48f41a8ad790ee030');
define('TOKEN','123456');
$wc = new WeCh(APPID,APPSECRET,TOKEN);

$menu = <<<JSON
	{
    "button": [
        {
            "name": "扫码", 
            "sub_button": [
                {
                    "type": "scancode_waitmsg", 
                    "name": "扫码带提示", 
                    "key": "rselfmenu_0_0", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "scancode_push", 
                    "name": "扫码推事件", 
                    "key": "rselfmenu_0_1", 
                    "sub_button": [ ]
                }
            ]
        }, 
        {
            "name": "发图", 
            "sub_button": [
                {
                    "type": "pic_photo_or_album", 
                    "name": "拍照或者相册发图", 
                    "key": "rselfmenu_1_1", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "pic_weixin", 
                    "name": "微信相册发图", 
                    "key": "rselfmenu_1_2", 
                    "sub_button": [ ]
                }
            ]
        }, 
        {
            "name": "快捷操作", 
			"sub_button":[
				{
					"name":"地理位置",
					"type":"location_select",
					"key":"location_select"
				},
				{
					"name":"查看URL",
					"type":"view",
					"url":"http://www.baidu.com/"
				}				
			]
        }
    ]
}
JSON;


$result = $wc->menuSet($menu);
var_dump($result);
 ?>