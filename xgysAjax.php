<?php 
require('./inc/xhead.php');
if($_POST['id']!=0)
{
	$query = "select id,shortname from sys_unit where id=".$_POST['id'];//ֱ�Ӹ���idѡһ��
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
else//ģ��ѡȡһ��
{
	$str=iconv("UTF-8","GBK",$_POST["spbh"]); 
	$query = "select top 1 id,shortname from sys_unit where mode=1 and yn=1 and isnull(usercode,'') like '%".$str."%' order by usercode";
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
