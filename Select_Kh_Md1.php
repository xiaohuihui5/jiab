<?php
require('./inc/xhead.php');
$tmp=iconv("UTF-8","GBK",$_POST["cxtj"]);
if($_POST['cwho']==1)//����ѡ�е��ұ�
	$query="select unit.id,isnull(unit.usercode,'')+isnull(unit.shortname,'') from sys_unit unit where unit.mode=2 and unit.yn=1 and unit.id in(".$_POST['selid'].") order by unit.typea,unit.usercode";
else if($_POST['cwho']==0)//�������
	{
		$TJ="";
		if($tmp!="")
			$TJ.=" and (unit.usercode like '%".$tmp."%' or unit.shortname like '%".$tmp."%')";
		if(isset($_POST['typea']) and $_POST['typea']!="")
			$TJ.=" and unit.typea in(".$_POST['typea'].") ";
		if(isset($_POST['typeb']) and $_POST['typeb']!="")
			$TJ.=" and unit.typeb in(".$_POST['typeb'].") ";
		if(isset($_POST['typec']) and $_POST['typec']!="")
			$TJ.=" and unit.typec in(".$_POST['typec'].") ";
		$query="select unit.id,isnull(unit.usercode,'')+isnull(unit.shortname,'') from sys_unit unit where unit.mode=2 and unit.yn=1 ".$TJ." and unit.id not in(".$_POST['selid'].") order by unit.typea,unit.usercode";
	}
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
		echo "ob.options[ob.options.length] = new Option('".$line[1]."','".$line[0]."');\n";
}       
sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
