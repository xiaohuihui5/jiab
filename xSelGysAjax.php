<?php 
require('./inc/xhead.php');
if($_POST['id']!=0)
{
	$query = "select id,shortname from sys_unit where id=".$_POST['id'];//直接根据id选一个
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
else if($_POST["spbh"]!="")//模糊选取一个
{
	$str=iconv("UTF-8","GBK",$_POST["spbh"]); 
	$query = "select top 1 id,shortname from sys_unit where mode=1 and yn=1 and usercode+shortname+isnull(name,'')+isnull(piny,'') like '%".$str."%' order by usercode";
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
	$cpid=$line[0];
	$cpmc=$line[1];
	}
	sqlsrv_free_stmt($result);
}
echo $cpid,"@",$cpmc,"@";
?>
