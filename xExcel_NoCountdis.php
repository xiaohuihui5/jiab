<?php 
require('./inc/xhead.php');
require_once dirname(__FILE__) . './PHPExcel-1.8/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator('www.chinause.cn');
$CS=explode("#",$_SESSION['mac']);//0语句1数值2宽度3对齐4列名5标题6中眉7右眉$query=$CS[0];
$HJ=explode(",",$CS[1]);
$KD=explode(",",$CS[2]);
$AL=explode(",",$CS[3]);
$LM=explode(",",$CS[4]);
$Column=count($HJ);//取的总列数
?>
<?php
$first_blank_row=2;//前面空置的行,一般指标题+列这两行
$lie=array('','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',iconv('gb2312','utf-8',$CS[5]));
$objPHPExcel->getActiveSheet()->mergeCells('A1:'.$lie[$Column-1].'1');//合并标题
$objPHPExcel->getActiveSheet()->getStyle('A1:'.$lie[$Column-1].'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//居中
if($CS[6]!="")
{
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2',iconv('gb2312','utf-8',$CS[6]));$first_blank_row+=1;
	$objPHPExcel->getActiveSheet()->mergeCells('A2:'.$lie[$Column-1].'2');//合并
}
if($CS[7]!="")
{
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3',iconv('gb2312','utf-8',$CS[7]));$first_blank_row+=1;
	$objPHPExcel->getActiveSheet()->mergeCells('A3:'.$lie[$Column-1].'3');//合并
}
//$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20); //设置默认行高
//$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);//行高
for($i=1;$i<$Column;$i++)
{
	//$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);//设置宽度
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($lie[$i].$first_blank_row,iconv('gb2312','utf-8',$LM[$i]));
	//$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($lie[$i])->setAutoSize(true);//自动宽度
	//$objPHPExcel->getActiveSheet()->getStyle($lie[$i].$first_blank_row)->getAlignment()->setWrapText(true);//自动换行
	$objPHPExcel->getActiveSheet()->getStyle($lie[$i].$first_blank_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}
$query=$CS[0];
$result=sqlsrv_query($conn,$query);
$row=0;$heb="";$heb_beg=$first_blank_row+1;
while($line=sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC))
{
	if($line[2]!=$heb && $heb!="")//合并
		{
		$tmp=$row+$first_blank_row;
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$heb_beg.':B'.$tmp);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$heb_beg.':B'.$tmp)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
		$heb_beg=$tmp+1;
		}
	$row=$row+1;$tmp=$row+$first_blank_row;
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$tmp,$row);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$tmp)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//居中
	for($i=2;$i<$Column;$i++)
		$objPHPExcel->getActiveSheet()->setCellValue($lie[$i].$tmp,iconv('gb2312','utf-8',$line[$i]));
	$heb=$line[2];
}
if($row>0)
{
		$tmp=$row+$first_blank_row;
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$heb_beg.':B'.$tmp);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$heb_beg.':B'.$tmp)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
}
sqlsrv_free_stmt($result);

$styleThinBlackBorderOutline = array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF000000'),
		),
	),
);
$objPHPExcel->getActiveSheet()->getStyle('A'.$first_blank_row.':'.$lie[$Column-1].$tmp)->applyFromArray($styleThinBlackBorderOutline);//设置边框
//$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

//$value=$objPHPExcel->getActiveSheet()->getCell('D3')->getValue();
//$width=mb_strwidth($value);//Return the width of the string
//$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth($width);

$first_blank_row+=1;//取第一行数据值的宽度作为每列宽度
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setAutoSize(true);//自动宽度
for($i=2;$i<$Column;$i++)
{
	$value=$objPHPExcel->getActiveSheet()->getCell($lie[$i].$first_blank_row)->getValue();
	$width=4+mb_strwidth($value);//Return the width of the string
	$objPHPExcel->getActiveSheet()->getColumnDimension($lie[$i])->setWidth($width);
}

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle(iconv('gb2312','utf-8',$CS[5]));
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$CS[5].'.xls"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
