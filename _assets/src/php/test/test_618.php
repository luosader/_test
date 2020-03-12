<?php
/*作业618	1、高级验证码  验证码+干扰元素
			2、添加水印
*/
// include_once('');
// header('Content-Type:text/html;charset=UTF-8');

//verify
	header('Content-Type:image/gif');//文本类型

	$font = dirname(__FILE__).'./font/Amerika_Sans.ttf';// 外部字体路径
	$text = "";

	$width = 90;//图片宽度
	$height = 30;//图片高度

	$num = 4;//验证码个数
	$fontsize = 20;//字体大小
	$fontx = 1;//文字初始x轴位置
	$fonty = 23;//文字初始y轴位置
	$margin = 22;//

//=========================================================
//创建图像并填充
	$img = imagecreatetruecolor ($width,$height);//新建一个真彩色图像 imagecreatetruecolor(width, height)
	$bgcolor = imagecolorallocate($img,mt_rand(130,255),mt_rand(130,255),mt_rand(130,255));//填充背颜色,由三原色构成 imagecolorallocate(image, red, green, blue)
	imagefilledrectangle($img,0,0,$width,$height,$bgcolor);//画一矩形并填充 imagefilledrectangle(image, x1, y1, x2, y2, color)
	//imagefill($img, 0, 0, $bgcolor);//区域填充 imagefill(image, x, y, color) 比imagefilledrectangle多了x,y轴,为横纵方向的具体位置开始

//在图上加字
	//imagechar($img, 5, x, y, '你好！', blue)//水平地画一个字符 imagechar(image, font, x, y, c, color) 系统最大字号font为5。
	//imagestring(image, font, x, y, string, color)//imagestring — 水平地画一行字符串
	
	$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
	for ($i=0; $i < $num; $i++) { 
		$text .= substr($str, mt_rand(0,61),1);
	}
	for ($j=0; $j < $num; $j++) { 
		$txt = substr($text, $j,1);
		$textcolor = imagecolorallocate($img,mt_rand(0,128),mt_rand(0,128),mt_rand(0,128));
		imagefttext($img,$fontsize,mt_rand(-30,30),$fontx,$fonty,$textcolor,$font,$txt);//使用 FreeType 2 字体将文本写入图像 imagefttext(image, size, angle, x, y, color, fontfile, text)  图像、大小、角度、位置、颜色、字体路径、文本边框
		$fontx += $margin;
	}
	
	


//干扰元素
	//画椭圆弧  imagearc(image, cx, cy, width, height, start, end, color); 以 cx，cy（图像左上角为 0, 0）为中心在 image 所代表的图像中画一个椭圆弧。w和 h 分别指定了椭圆的宽度和高度，起始和结束点以 s 和 e参数以角度指定。0°位于三点钟位置，以顺时针方向绘画。
	for ($s=0; $s < 6; $s++) { 
		$linecolor = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
		imagearc($img, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), 0, 360, $linecolor);
	}

	//加点 imagesetpixel(image, x, y, color);
	for ($k=0; $k < 200; $k++) { 
		$spotcolor = imagecolorallocate($img,mt_rand(0,220),mt_rand(0,220),mt_rand(0,220));
		imagesetpixel($img, mt_rand(1,$width), mt_rand(1,$height), $spotcolor);
	}



	// imagecolortransparent($img);//改变透明度
	imagegif($img);//将图片在网页上显示
	imagedestroy($img);//销毁图片

?>


