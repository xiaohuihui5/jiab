<?php 
require('./inc/xhead.php');
$CS=explode("#",$_SESSION['mac']);//0语句1数值2宽度3对齐4列名5标题6中眉7右眉
$query=$CS[0];
$HJ=explode(",",$CS[1]);
$KD=explode(",",$CS[2]);
$AL=explode(",",$CS[3]);
$LM=explode(",",$CS[4]);
$ZJ=explode(",","0,0,0,0,0,0,0,0,0,0,0");
$XJ=explode(",","0,0,0,0,0,0,0,0,0,0,0");
?>
<head>
<?php 
echo "<title>".$CS[5]."</title>";
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<style>
table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
@page
	{margin:.39in .2in .39in .2in;
	mso-header-margin:0in;
	mso-footer-margin:0in;
	mso-horizontal-page-align:center;}
</style>
</head>
<body>
<table width="100%">
<tr><td align=center>
<br><font size=4><b><?php echo $CS[5];?></b></font><br><?php echo $CS[6];?>
<br><?php echo $CS[7];?>
</td></tr>
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
<?php 
for($i=1;$i<=400;$i++)
{
	$dat[$i]=0;//上期
	$sell[$i]=0;//销售
}
$query="select  dh.unitid,unit.shortname,CONVERT(varchar(10),dh.brq,120),CONVERT(varchar(10),dh.erq,120) from sys_selljg dh,sys_unit unit where unit.id=dh.unitid and dh.id=".$_REQUEST['dhid'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$unitid=$line[0];
$unitmc=$line[1];
$brq=$line[2];
$erq=$line[3];
sqlsrv_free_stmt($result);
//特价取上期分类售价
	$dan=0;
	$query="select max(id) from sys_selljg where leix=35 and unitid=".$unitid." and erq<'".$brq."'";
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
		if($line[0]!="")
			$dan=$line[0];
	}
	sqlsrv_free_stmt($result);
	$query = "select sj.cpid,sj.sellprice from sys_selljgsj sj,sys_selljg dh where sj.dhid=dh.id and sj.dhid=".$dan;
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
		{
		$dat[$line[0]]=$line[1];
		}
	sqlsrv_free_stmt($result);
//特价取上期分类售价
//取实际销售均价
	$query = "select sj.mc,sum(sj.shisje)/sum(sj.shisl) from sys_jhdh dh,sys_jhsj sj where dh.id=sj.dhid and dh.lx=2 and dh.dhrq between '".$brq."' and '".$erq."' and sj.shisje>0 and sj.shisl>0 group by sj.mc";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
		{
		$sell[$line[0]]=sprintf("%1.2f",$line[1]);
		}
	sqlsrv_free_stmt($result);
//取实际销售均价
$TMP="<tr>";
for($i=1;$i<count($LM);$i++)
	{
		$TMP.="<td align=center><b>".$LM[$i]."</b></td>";
	}
echo $TMP,"</tr>";
$Column=count($HJ);
$query=$CS[0];
$result=sqlsrv_query($conn,$query);
$row=0;
while($line=sqlsrv_fetch_array($result))
{
	$row=$row+1;
	$TMP="<tr><td width=".$KD[1]." align=".$AL[1]." height=20>".$row."</td>";
	for($i=2;$i<$Column;$i++)
	{
		if($i==6)
		{
			if($dat[$line[1]]>0)
				$TMP.="<td width=".$KD[$i]." align=".$AL[$i].">".$dat[$line[1]]."</td>";
			else
				$TMP.="<td width=".$KD[$i]." align=".$AL[$i]."></td>";
		}
		else if($i==7)
		{
			if($dat[$line[1]]>0 && $line[8]-$dat[$line[1]]!=0)
				$TMP.="<td width=".$KD[$i]." align=".$AL[$i].">".sprintf("%1.1f",100*($line[8]-$dat[$line[1]])/$line[8])."%"."</td>";
			else
				$TMP.="<td width=".$KD[$i]." align=".$AL[$i]."></td>";
		}
		else if($i==10)
		{
			if($sell[$line[1]]>0)
				$TMP.="<td width=".$KD[$i]." align=".$AL[$i].">".$sell[$line[1]]."</td>";
			else
				$TMP.="<td width=".$KD[$i]." align=".$AL[$i]."></td>";
		}
		else if($i==11)
		{
			if($sell[$line[1]]>0 && $line[8]-$sell[$line[1]]!=0)
				$TMP.="<td width=".$KD[$i]." align=".$AL[$i].">".sprintf("%1.1f",100*($line[8]-$sell[$line[1]])/$sell[$line[1]])."%"."</td>";
			else
				$TMP.="<td width=".$KD[$i]." align=".$AL[$i]."></td>";
		}
		else
			$TMP.="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
	}
	echo $TMP,"</tr>";
}
sqlsrv_free_stmt($result);
?>
</table>
<p align=left><?php echo @$CS[8];?></p>
</body>
<script lanuage ="javascript">
	window.print();
</script>
