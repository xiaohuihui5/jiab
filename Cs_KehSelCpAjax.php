<?php 
require('./inc/xhead.php');
if($_POST['id']!=0)
{
	$query = "select cp.id,cp.mc,cp.dw,cp.gg from sys_cp cp where cp.yn=1 and cp.id=".$_POST['id'];//ֱ�Ӹ���idѡһ��
	$result=sqlsrv_query($conn,$query);
	$cpid=0;
	$cpmc="";
	$cpdw="";
	$cpgg="";
	if($line=sqlsrv_fetch_array($result))
	{
	$cpid=$line[0];
	$cpmc=$line[1];
	$cpdw=$line[2];
	$cpgg=$line[3];
	}
	sqlsrv_free_stmt($result);
}
else//ģ��ѡȡһ��
{
	$str=iconv("UTF-8","GBK",$_POST["spbh"]); 
	$query = "select top 1 cp.id,cp.mc,cp.dw,cp.gg from sys_cp cp where cp.yn=1 and cp.bh+cp.mc+isnull(cp.piny,'') like '%".$str."%'  order by cp.bh";
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
	$cpid=$line[0];
	$cpmc=$line[1];
	$cpdw=$line[2];
	$cpgg=$line[3];
	}
	sqlsrv_free_stmt($result);
}
$jg="";
$beiz="";
echo $cpid,"@",$cpmc,"@",$jg,"@",$beiz,"@",$cpdw,"@",$cpgg,"@";
?>
