<?php
require('./inc/xhead.php');
require_once dirname(__FILE__) . './PHPExcel-1.8/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator('www.chinause.cn');

$TJ="";
$TJ1="";
if(isset($_REQUEST['dt1']) and $_REQUEST['dt1']!="")
{
	$_SESSION['DT1']=$_REQUEST['dt1'];
	$_SESSION['DT2']=$_REQUEST['dt2'];
	$chaxrq=$_REQUEST['dt1'];
	$TJ.=' and dh.dhrq between \''.$_REQUEST['dt1'].'\' and \''.$_REQUEST['dt2'].'\' ';
}
else
{
 	$TJ.=" and dh.dhrq between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
	$chaxrq=date('Y-m-d');
}
if(isset($_REQUEST['cpflid']) and $_REQUEST['cpflid']!="")
	$TJ1.=" and cp.dfl in(".$_REQUEST['cpflid'].") ";
if(isset($_REQUEST['cpid']) and $_REQUEST['cpid']!="")
	$TJ1.=" and cp.id in(".$_REQUEST['cpid'].") ";
if(isset($_REQUEST['cxtj']) and $_REQUEST['cxtj']!="")
	$TJ1.=" and cp.bh+cp.mc like '%".$_REQUEST['cxtj']."%' ";
$first_blank_row=2;
$lie=array('','A','B','C','D','E','F','G','H','I');
$LM=array('','序','编号','产品名称','单位','起初库存','本期入库','本期出库','期末库存','库存金额');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A1',iconv('gb2312','utf-8',$_SESSION['DT1']."至".$_SESSION['DT2']."库存统计表"));
$objPHPExcel->getActiveSheet()->mergeCells('A1:'.$lie[9].'1');//合并标题
$objPHPExcel->getActiveSheet()->getStyle('A1:'.$lie[9].'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//居中

for($i=1;$i<10;$i++)
{
	$objPHPExcel->getActiveSheet()->getStyle($lie[$i].$first_blank_row)->getFont()->setBold(true);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($lie[$i].$first_blank_row,iconv('gb2312','utf-8',$LM[$i]));
	$objPHPExcel->getActiveSheet()->getStyle($lie[$i].$first_blank_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}

//取最近盘点日期
	$query="select CONVERT(varchar(10),max(dhrq),120) from sys_jhdh where lx=32 and dhrq<='".$chaxrq."'";
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
		if($line[0]!='')
			$pandrq=$line[0];
	}       
	sqlsrv_free_stmt($result);
//取最近盘点日期

//期初库存
//1.最近盘点数据
	$query="select cp.id,sum(sj.songhl),sum(shisje) from sys_jhdh dh,sys_cp cp,sys_jhsj sj where sj.dhid=dh.id and dh.lx in(32) and dh.dhrq='".$pandrq."' and sj.mc=cp.id group by cp.id";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$qickc[$line[0]]=$line[1];
		$qicje[$line[0]]=$line[2];
	}
	sqlsrv_free_stmt($result);
//1.最近盘点数据
      //本期入库 
	$query="select cp.id,sum(sj.songhl),sum(sj.shisje) from sys_jhdh dh,sys_cp cp,sys_jhsj sj where sj.dhid=dh.id and dh.lx in(7) and dh.dhrq>'".$pandrq."' and dh.dhrq<'".$_SESSION['DT1']."' and sj.mc=cp.id group by cp.id";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$qickc[$line[0]]+=$line[1];
		$qicje[$line[0]]+=$line[2];
	}
	sqlsrv_free_stmt($result);
     //本期出库
	$query="select cp.id,sum(sj.songhl),sum(sj.shisje) from sys_jhdh dh,sys_cp cp,sys_jhsj sj where sj.dhid=dh.id and dh.lx in(8) and dh.dhrq>'".$pandrq."' and dh.dhrq<'".$_SESSION['DT1']."' and sj.mc=cp.id group by cp.id";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$qickc[$line[0]]-=$line[1];
		$qicje[$line[0]]-=$line[2];
	}
	sqlsrv_free_stmt($result);
//计算期初库存
      //本期入库 
	$query="select cp.id,sum(sj.songhl),sum(sj.shisje) from sys_jhdh dh,sys_cp cp,sys_jhsj sj where sj.dhid=dh.id and dh.lx in(7) and sj.mc=cp.id  ".$TJ1.$TJ." group by cp.id";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$ruksl[$line[0]]=$line[1];
		$rukje[$line[0]]=$line[2];
	}
	sqlsrv_free_stmt($result);
//入库数量
//出库数量
     //本期出库
	$query="select cp.id,sum(sj.songhl),sum(sj.shisje) from sys_jhdh dh,sys_cp cp,sys_jhsj sj where sj.dhid=dh.id and dh.lx in(8) and sj.mc=cp.id  ".$TJ1.$TJ." group by cp.id";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$chuksl[$line[0]]=$line[1];
		$chukje[$line[0]]=$line[2];
	}
	sqlsrv_free_stmt($result);
//出库数量
$qckczl_hj=0;
$rukzl_hj=0;
$chukzl_hj=0;
$kczl_hj=0;
$kcje_hj=0;

$query="select cp.id,ltrim(cp.mc),cp.dw,cp.bh from sys_cp cp where cp.yn=1 ".$TJ1." group by cp.mc,cp.dw,cp.id,cp.bh order by cp.mc";
$result=sqlsrv_query($conn,$query);
$row=2;
while($line=sqlsrv_fetch_array($result))
{
   $kucsl[$line[0]]=($qickc[$line[0]]+$ruksl[$line[0]]-$chuksl[$line[0]]);
   $kucje[$line[0]]=($qicje[$line[0]]+$rukje[$line[0]]-$chukje[$line[0]]);
	if($kucsl[$line[0]]<>0 || $qickc[$line[0]]<>0 )
	{
$row+=1;

	$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setWrapText(true);//自动换行
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold();//字体加粗
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,iconv('gb2312','utf-8',$row-2));
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//居中

	$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getFont()->setBold();
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,iconv('gb2312','utf-8',$line[3]));
	$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getFont()->setBold();
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,iconv('gb2312','utf-8',$line[1]));
	$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getFont()->setBold();
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row,iconv('gb2312','utf-8',$line[2]));
	$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getFont()->setBold();
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row,iconv('gb2312','utf-8',$qickc[$line[0]]));
	$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getFont()->setBold();
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row,iconv('gb2312','utf-8',$ruksl[$line[0]]));
	$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setBold();
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,iconv('gb2312','utf-8',$chuksl[$line[0]]));
	$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getFont()->setBold();
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,iconv('gb2312','utf-8',$kucsl[$line[0]]));
	$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getFont()->setBold();
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row,iconv('gb2312','utf-8',$kucje[$line[0]]));
	$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$qckczl_hj+=$qckczl[$line[0]];
$rukzl_hj+=$ruksl[$line[0]];
$chukzl_hj+=$chuksl[$line[0]];
$kczl_hj+=$kucsl[$line[0]];
$kcje_hj+=$kucje[$line[0]];
	}
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
$objPHPExcel->getActiveSheet()->getStyle($lie[1].$first_blank_row.':'.$lie[9].$row)->applyFromArray($styleThinBlackBorderOutline);//设置边框

$objPHPExcel->getActiveSheet()->setTitle('123333');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="库存统计表.xls"');
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
