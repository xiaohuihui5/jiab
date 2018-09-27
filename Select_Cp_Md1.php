<?php
require('./inc/xhead.php');
$tmp=iconv("UTF-8","GBK",$_POST["cxtj"]);
if($_POST['cwho']==1)//生成选中的右边
	$query="select cp.id,cp.mc from sys_cp cp where cp.yn=1 and cp.id in(".$_POST['selid'].") order by cp.typec,cp.bh";
else if($_POST['cwho']==0)//生成左边
	{
		$TJ="";
		if($tmp!="")
			$TJ.=" and cp.bh+cp.mc+cp.piny like '%".$tmp."%' ";
		if(isset($_POST['dafl']) and $_POST['dafl']!="")
			$TJ.=" and cp.typeb in(".$_POST['dafl'].") ";
		if(isset($_POST['xiaofl']) and $_POST['xiaofl']!="")
			$TJ.=" and cp.typec in(".$_POST['xiaofl'].") ";
		$query="select cp.id,cp.mc from sys_cp cp where cp.yn=1 ".$TJ." and  cp.id not in(".$_POST['selid'].") order by cp.typec,cp.bh";
	}
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
		echo "ob.options[ob.options.length] = new Option('".$line[1]."','".$line[0]."');\n";
}       
sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
