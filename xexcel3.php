<?php 
require("inc/xhead.php");
require_once dirname(__FILE__) . './PHPExcel-1.8/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator('www.chinause.cn');
$CS=explode('#',$_SESSION['mac']);
$HJ=explode(',',$CS[1]);
$KD=explode(',',$CS[2]);
$AL=explode(',',$CS[3]);
$LM=explode(',',$CS[4]);
$Column=count($HJ);
?>
<?php 
$first_blank_row=2;//前面空置的行,一般指标题+列这两行
$lie=array('','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);//字体加粗
$objPHPExcel->getActiveSheet()->getStyle('A2:'.$lie[$Column-1].'2')->getFont()->setBold(true);//字体加粗
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',iconv('gbk','utf-8',$CS[5]));
$objPHPExcel->getActiveSheet()->mergeCells('A1:'.$lie[$Column-1].'1');//合并标题
$objPHPExcel->getActiveSheet()->getStyle('A1:'.$lie[$Column-1].'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//居中
if($CS[6]!="")
{
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2',iconv('gbk','utf-8',$CS[6]));$first_blank_row+=1;
	$objPHPExcel->getActiveSheet()->mergeCells('A2:'.$lie[$Column-1].'2');//合并
}
if($CS[7]!="")
{
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3',iconv('gbk','utf-8',$CS[7]));$first_blank_row+=1;
	$objPHPExcel->getActiveSheet()->mergeCells('A3:'.$lie[$Column-1].'3');//合并
}
for($i=1;$i<$Column;$i++)
{
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($lie[$i].$first_blank_row,iconv('gbk','utf-8',$LM[$i]));
	$objPHPExcel->getActiveSheet()->getStyle($lie[$i].$first_blank_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}
$query=$CS[0];
$result=sqlsrv_query($conn,$query);
$row=0;$heb="";$heb_beg=$first_blank_row+1;$tp1="";$mid=1;$mid2=1;$tmp=0;
while($line=sqlsrv_fetch_array($result))
{
	if($line[1].$line[2]!=$heb && $heb!="")//纵向合并
	{
		//if($mid>1)
		//	$heb_tmp=$row+$first_blank_row+1;
		//else
			$heb_tmp=$row+$first_blank_row;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$heb_beg.':A'.$heb_tmp);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$heb_beg.':A'.$heb_tmp)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
		if($mid>1)
			$heb_beg=$heb_tmp+2;
		else
			$heb_beg=$heb_tmp+1;
	}

	$row=$row+1;$tmp=$row+$first_blank_row;$heb_tmp=$row+$first_blank_row;
	if($tp1!=$line[1].$line[2] && $tp1!="" && $mid>1)//插入小计_beg
	{
		$objPHPExcel->getActiveSheet()->getStyle('A'.$tmp.':'.$lie[$Column-1].$tmp)->getFont()->setBold(true);//字体加粗
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$tmp.':'.$lie[$HJ[0]].$tmp);//小计合并
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$tmp,iconv('gbk','utf-8',$tp1.'小计'));
		$objPHPExcel->getActiveSheet()->getStyle('A'.$tmp.':'.$lie[$Column-1].$tmp)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		for($i=$HJ[0]+1;$i<$Column;$i++)
		{
			if($HJ[$i]==1)
				$objPHPExcel->getActiveSheet()->setCellValue($lie[$i].$tmp,iconv('gbk','utf-8',$XJ[$i]));
			else
				$objPHPExcel->getActiveSheet()->setCellValue($lie[$i].$tmp,iconv('gbk','utf-8',''));
		}
	$row=$row+1;$tmp=$row+$first_blank_row;$heb_tmp=$row+$first_blank_row+1;
		for($i=1;$i<$Column;$i++)
		{
			$objPHPExcel->getActiveSheet()->setCellValue($lie[$i].$tmp,iconv('gbk','utf-8',$line[$i]));
			if($HJ[$i]==1)
			{
				$ZJ[$i]+=$line[$i];
				$XJ[$i]=$line[$i];
			}	
		}
	$mid=1;
	$mid2=2;//标示如果只有一个小计的时候就不用显示小计直接显示合计
	}//插入小计_end
	else
	{
		if($tp1!=$line[1].$line[2])
			$mid=1;
		else
			$mid+=1;
		for($i=1;$i<$Column;$i++)
		{
			$objPHPExcel->getActiveSheet()->setCellValue($lie[$i].$tmp,iconv('gbk','utf-8',$line[$i]));
			if($HJ[$i]==1 && $tp1!=$line[1].$line[2])
			{
			$ZJ[$i]+=$line[$i];
			$XJ[$i]=$line[$i];
			}	
			else
			{
			$ZJ[$i]+=$line[$i];
			$XJ[$i]+=$line[$i];
			}	
		}
	}
	$tp1=$line[1].$line[2];
	$heb=$line[1].$line[2];
}
sqlsrv_free_stmt($result);

if($row>0)
{
	if($mid>1 && $mid2>1)
	{
	$row=$row+1;$tmp=$row+$first_blank_row;
	$objPHPExcel->getActiveSheet()->getStyle('A'.$tmp.':'.$lie[$Column-1].$tmp)->getFont()->setBold(true);//字体加粗
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$tmp,iconv('gbk','utf-8',$tp1.'小计'));
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$tmp.':'.$lie[$HJ[0]].$tmp);//小计合并
	$objPHPExcel->getActiveSheet()->getStyle('A'.$tmp.':'.$lie[$Column-1].$tmp)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		for($i=$HJ[0]+1;$i<$Column;$i++)
		{
			if($HJ[$i]==1)
				$objPHPExcel->getActiveSheet()->setCellValue($lie[$i].$tmp,iconv('gbk','utf-8',$XJ[$i]));
			else
				$objPHPExcel->getActiveSheet()->setCellValue($lie[$i].$tmp,iconv('gbk','utf-8',''));
		}
	}
	$tmp=$row+$first_blank_row;
	$tmp=$tmp+1;
	$objPHPExcel->getActiveSheet()->getStyle('A'.$tmp.':'.$lie[$Column-1].$tmp)->getFont()->setBold(true);//字体加粗
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$tmp,iconv('gbk','utf-8','合 计'));
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$tmp.':'.$lie[$HJ[0]].$tmp);//合并
	$objPHPExcel->getActiveSheet()->getStyle('A'.$tmp.':'.$lie[$Column-1].$tmp)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	for($i=$HJ[0]+1;$i<$Column;$i++)
	{
		if($HJ[$i]==1)
			$objPHPExcel->getActiveSheet()->setCellValue($lie[$i].$tmp,iconv('gbk','utf-8',$ZJ[$i]));
		else
			$objPHPExcel->getActiveSheet()->setCellValue($lie[$i].$tmp,iconv('gbk','utf-8',''));
	}
}

$styleThinBlackBorderOutline = array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF000000'),
		),
	),
);
$objPHPExcel->getActiveSheet()->getStyle('A'.$first_blank_row.':'.$lie[$Column-1].$tmp)->applyFromArray($styleThinBlackBorderOutline);//设置边框

$first_blank_row+=1;//取第一行数据值的宽度作为每列宽度
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setAutoSize(true);//自动宽度
for($i=1;$i<$Column;$i++)
{
	$value=$objPHPExcel->getActiveSheet()->getCell($lie[$i].$first_blank_row)->getValue();
	$width=4+mb_strwidth($value);//Return the width of the string
	$objPHPExcel->getActiveSheet()->getColumnDimension($lie[$i])->setWidth($width);
}

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle(iconv('gbk','utf-8',$CS[5]));
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
