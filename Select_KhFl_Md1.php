<?php
require('./inc/xhead.php');
$tmp=iconv("UTF-8","GBK",$_POST["cxtj"]);
if($_POST['cwho']==1)//生成选中的右边
	$query="select cpfenl.id,cpfenl.fenlmc from sys_khfenl cpfenl where cpfenl.yn=1 and cpfenl.id in(".$_POST['selid'].") order by cpfenl.bianh,cpfenl.fenlmc";
else if($_POST['cwho']==0)//生成左边
	{
		$TJ="";
		if($tmp!="")
			$TJ.=" and cpfenl.fenlmc like '%".$tmp."%' ";
		if(isset($_POST['cpfl']) and $_POST['cpfl']!="")
			$TJ.=" and cpfenl.dafl in(".$_POST['cpfl'].") ";
		$query="select cpfenl.id,cpfenl.fenlmc from sys_khfenl cpfenl where cpfenl.yn=1 ".$TJ." and  cpfenl.id not in(".$_POST['selid'].") order by cpfenl.bianh,cpfenl.fenlmc";
	}
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
		echo "ob.options[ob.options.length] = new Option('".$line[1]."','".$line[0]."');\n";
}       
sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
