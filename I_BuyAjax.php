<?php 
require('./inc/xhead.php');
if($_POST['id']!=0)
{
	$query = "select cp.id,cp.mc,cp.dw from sys_cp cp where cp.yn=1 and cp.id=".$_POST['id'];//ֱ�Ӹ���idѡһ��
	$result=sqlsrv_query($conn,$query);
	$cpid=0;
	$cpmc="";
	if($line=sqlsrv_fetch_array($result))
	{
	$cpid=$line[0];
	$cpmc=$line[1];
	$cpdw=$line[2];
	}
	sqlsrv_free_stmt($result);
}
else//ģ��ѡȡһ��
{
	$str=iconv("UTF-8","GBK",$_POST["spbh"]);
	$query = "select top 1 cp.id,cp.mc,cp.dw from sys_cp cp where cp.yn=1 and cp.bh+cp.mc+isnull(cp.piny,'') like '%".$str."%'  order by cp.bh";
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
	$cpid=$line[0];
	$cpmc=$line[1];
	$cpdw=$line[2];
	}
	sqlsrv_free_stmt($result);
}
$jg="";
//�ɹ��۸�
$query="select top 1 b.sellprice from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.lx=26 and b.cpid=".$cpid." and a.unitid=".$_POST['khid']." and '".$_POST['RQ']."' between a.brq and a.erq";
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
	$jg=$line[0];
}       
sqlsrv_free_stmt($result);
//�ɹ��۸�
echo $cpid,"@",$cpmc,"@",$jg,"@",$cpdw,"@";
?>
