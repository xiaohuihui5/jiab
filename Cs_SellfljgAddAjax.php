<?php 
require('./inc/xhead.php');
if($_POST['id']!=0)
{
	$query = "select id,fenlmc from sys_khfenl where id=".$_POST['id'];//ֱ�Ӹ���idѡһ��
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
	$query = "select top 1 id,fenlmc from sys_khfenl where yn=1 and  bianh+fenlmc+isnull(piny,'') like '%".$str."%' order by bianh";
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