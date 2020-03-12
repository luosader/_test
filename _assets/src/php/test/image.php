<?php
	header('Content-Type:image/gif');
	verify(90,30,4);
	function verify($width,$height,$num){
		$font = dirname(__FILE__).'/font/Amerika_Sans.ttf';
		$text = "";
		$fontsize = 20;$fontx = 1;$fonty = 23;$margin = 22;

		$img = imagecreatetruecolor ($width,$height);
		$bgcolor = imagecolorallocate($img,mt_rand(130,255),mt_rand(130,255),mt_rand(130,255));
		imagefilledrectangle($img,0,0,$width,$height,$bgcolor);

		$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
		for ($i=0; $i < $num; $i++) { 
			$text .= substr($str, mt_rand(0,61),1);
		}
		for ($j=0; $j < $num; $j++) { 
			$txt = substr($text, $j,1);

			$textcolor = imagecolorallocate($img,mt_rand(0,128),mt_rand(0,128),mt_rand(0,128));
			imagefttext($img,$fontsize,0,$fontx,$fonty,$textcolor,$font,$txt);
			$fontx += $margin;
		}
		

		for ($s=0; $s < 200; $s++) { 
			$spotcolor = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imagesetpixel($img, mt_rand(1,$width), mt_rand(1,$height), $spotcolor);
		}

		for ($k=0; $k < 6; $k++) {
			$linecolor = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255)); 
			imagearc($img, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), 0, 360, $spotcolor);
		}


		imagegif($img);
		imagedestroy($img);

	}

?>