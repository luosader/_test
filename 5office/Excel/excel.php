<?php
	session_start();//全局会话
	header('Content-Type:text/html;charset=utf-8');//设置文本类型和编码
	date_default_timezone_set('PRC');//时区设置
	// include_once('php/connect.php');

	//GBK编码时需要转换
	function convertUTF8($str){
		if(empty($str)) return '';
		return  iconv('gb2312', 'utf-8', $str);
	}

	require_once('PHPExcel/Classes/PHPExcel.php');
	require_once('PHPExcel/Classes/PHPExcel/IOFactory.php');
	$objPHPExcel = new PHPExcel();
	$iofactory= new PHPExcel_IOFactory();

//获得数据---一般是从数据库中获得数据
	$data=array(
		0=>array('oid'=>'2013','name'=>'张某某','age'=>21,'time'=>'2012-12-25 03:15:25'),
		1=>array('oid'=>'kill','name'=>'徐老师','age'=>36,'time'=>'2012.12.25 03:15'),
		2=>array('oid'=>'201','name'=>'EVA','age'=>26,'time'=>'2012/6/25')
		);
	$obj = $objPHPExcel->setActiveSheetIndex(0);
//设置excel列名
    $obj->setCellValue('A1',convertUTF8('编号'));
    $obj->setCellValue('B1',convertUTF8('姓名'));
    $obj->setCellValue('C1',convertUTF8('年龄'));
    $obj->setCellValue('D1',convertUTF8('时间'));
//把数据循环写入excel中
	foreach($data as $key => $value){
		$key+=2;
		$obj->setCellValue('A'.$key,$value['oid']);
		$obj->setCellValue('B'.$key,$value['name']);
		$obj->setCellValue('C'.$key,$value['age']);
		$obj->setCellValue('D'.$key,$value['time']);
	}


/**
样式
*/
###列宽
// $objPHPExcel->getActiveSheet()->getColumnDimension()->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
###设置对齐方式
// $objPHPExcel->getActiveSheet()->getStyle('D11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);//右对齐
$objPHPExcel->getActiveSheet()->getStyle()->getAlignment('A3')->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);//左对齐


//excel保存在根目录下
    // $objPHPExcel->getActiveSheet() -> setTitle('SetExcelName');
    // $objPHPExcel-> setActiveSheetIndex(0);
    // $objWriter = $iofactory -> createWriter($objPHPExcel, 'Excel2007');
    // $objWriter -> save('SetExcelName.xlsx');
//导出为文件，代码
	$objPHPExcel->getActiveSheet() -> setTitle('SetExcelName');
	$objPHPExcel-> setActiveSheetIndex(0);
	$objWriter = $iofactory -> createWriter($objPHPExcel, 'Excel5');
	$filename = 'SetExcelName.xls';
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control:must-revalidate, post-check=0, pre-check=0, max-age=0");
	header("Content-Type:application/force-download");
	header("Content-Type:application/vnd.ms-execl");
	header("Content-Type:application/octet-stream");
	header("Content-Type:application/download");
	header('Content-Disposition: attachment; filename="' . $filename . '"');
	header("Content-Transfer-Encoding:binary");
	$objWriter -> save('php://output');

