<?php
echo 'pdftojpg<br>';
/**
 * PDF2PNG
 * @param $pdf 待处理的PDF文件
 * @param $path 待保存的图片路径
 * @param $page 待导出的页面 -1为全部 0为第一页 1为第二页
 * @return 保存好的图片路径和文件名
 */
function pdf2png($pdf, $path, $page = -1)
{
    if (!extension_loaded('imagick')) {
        echo '!extension_loaded<br>';
        return false;
    }
    if (!file_exists($pdf)) {
        return false;
    }
    $im = new Imagick();
    $im->setResolution(120, 120);
    $im->setCompressionQuality(100);
    if ($page == -1) {
        $im->readImage($pdf);
    } else {
        $im->readImage($pdf . "[" . $page . "]");
    }

    foreach ($im as $Key => $Var) {
        $Var->setImageFormat('png');
        $filename = $path . "/" . md5($Key . time()) . '.png';
        if ($Var->writeImage($filename) == true) {
            $Return[] = $filename;
        }
    }
    return $Return;
}

$pdf  = __DIR__ . '/pdf.pdf';
$path = __DIR__ . '/'; //请确保当前目录下有这个文件夹，由于一直要用，所以就不加检测了
echo $pdf,'<br>';
$s = pdf2png($pdf, $path);
var_dump($s);
$scount = count($s);
for ($i = 0; $i < $scount; $i++) {
    echo "<div align=center><font color=red>Page " . ($i + 1) . "</font><br><a href=\"" . $s[$i] . "\" target=_blank><img border=3 height=120 width=90 src=\"" . $s[$i] . "\"></a></div>";
}
