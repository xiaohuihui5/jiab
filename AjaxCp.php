<?php 
require('./inc/xhead.php');
if($_POST['id']!=0)
{
	$query = "select id,mc from sys_cp where id=".$_POST['id'];//直接根据id选一个
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
	$query = "select top 1 cp.id,cp.mc from sys_cp cp where cp.yn=1 and (cp.bh like '%".$str."%' or cp.mc like '%".$str."%' or cp.piny like '%".$str."%' or cp.dw like '%".$str."%' or cp.gg like '%".$str."%') order by cp.bh";
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
	$cpid=$line[0];
	$cpmc=$line[1];
	}
	sqlsrv_free_stmt($result);
}
$dj="";
//$query="select top 1 jg.sellprice from sys_selljgsj jg,sys_selljg dh where dh.id=jg.dhid and '".$_SESSION['DT1']."' between dh.brq and dh.erq and dh.lx=31 and jg.cpid=".$cpid;
//$a=$query;
//$result=sqlsrv_query($conn,$query);
//if($line=sqlsrv_fetch_array($result))
//{
	//$dj=$line[0];
//}
//sqlsrv_free_stmt($result);
$query="select top 1 b.sellprice,b.beiz from sys_selljg a,sys_selljgsj b,sys_khfenl c where c.id=a.unitid and a.unitid in(10) and a.id=b.dhid and a.lx=25 and b.cpid=".$cpid." order by b.id desc";
//$a=$query;
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
		$dj=$line[0];//分类价
		$beiz=$line[1];
}       
sqlsrv_free_stmt($result);


echo $cpid."@".$cpmc."@".$dj."@";
?>
