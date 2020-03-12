<?php 
// // FPDF	DomPDF	TCPDF	mpdf
// $fp = fopen("HTTP.pdf", "r");
// header("Content-type: application/pdf");
// fpassthru($fp);
// // fpassthru(handle) 函数输出文件指针处的所有剩余数据。
// // 该函数将给定的文件指针从当前的位置读取到 EOF，并把结果写到输出缓冲区。
// fclose($fp);


header("Content-type: application/pdf");
$con = file_get_contents("HTTP.pdf");
echo $con;



?>
