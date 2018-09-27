<?php 
require('./inc/xhead.php');
if($_POST['id']!=0)
{
	$query = "select cp.id,cp.mc from sys_cp cp where cp.yn=1 and cp.id=".$_POST['id'];//直接根据id选一个
	$result=sqlsrv_query($conn,$query);
	$cpid=0;
	$cpmc="";
	if($line=sqlsrv_fetch_array($result))
	{
	$cpid=$line[0];
	$cpmc=$line[1];
	}
	sqlsrv_free_stmt($result);
}
else//模糊选取一个
{
	$str=iconv("UTF-8","GBK",$_POST["spbh"]); 
	$query = "select top 1 cp.id,cp.mc from sys_cp cp where cp.yn=1 and cp.bh+cp.mc+isnull(cp.piny,'') like '%".$str."%'  order by cp.bh";
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
	$cpid=$line[0];
	$cpmc=$line[1];
	}
	sqlsrv_free_stmt($result);
}
$jg="";
$beiz="";
$query="select top 1 b.sellprice,b.beiz from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.leix=25 and b.cpid=".$cpid." and a.unitid=".$_POST['khid']." order by b.id desc";
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
		$jg=$line[0];//客户分类价格
		$beiz=$line[1];
}       
sqlsrv_free_stmt($result);
echo $cpid,"@",$cpmc,"@",$jg,"@",$beiz,"@";
?>
