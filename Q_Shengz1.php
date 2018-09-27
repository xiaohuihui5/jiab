<?php require('./inc/xhead.php');?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<BODY>
<form action="" method="post" name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="gysid" value="<?php echo isset($_POST['gysid'])?$_POST['gysid']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<table border="0" class="tableborder3">
<?php 
$TJ="";
$TJ1="";
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$_SESSION['DT1']=$_POST['dt1'];
	$_SESSION['DT2']=$_POST['dt2'];
}
$TJ.=" and a.daohrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
$TJ1.=" and a.jiagrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
if(isset($_POST['gysid']) and $_POST['gysid']!="")
{
	$TJ.=" and b.id in(".$_POST['gysid'].") ";
	$TJ1.=" and b.id in(".$_POST['gysid'].") ";
}
$query="select CONVERT(varchar(10),a.caigrq,120),a.unit,a.pinz,case a.maozz when 0 then null else cast(cast((a.bianzz+a.neiz1+a.fengz)/a.maozz*100 as decimal(10,2)) as varchar)+'%' end from sys_jiagsc a,sys_unit b where a.lx=1 and a.unit=b.shortname ".$TJ1;
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$chengl[$line[0]][$line[1]][$line[2]]=$line[3];
}
sqlsrv_free_stmt($result);
	$query="select a.zt,a.id,CONVERT(varchar(10),a.daohrq,120),b.shortname,cp.mc,isnull(tous,0),isnull(a.chuczl,0),isnull(daohzl,0),isnull(a.chucj,0),isnull(a.danj,0),isnull(a.yunzf,0),a.pinz,a.unit,isnull(a.nongb,0),isnull(a.kounb,0),a.jine,a.zongcb,beiz,b.phone,a.cheph from sys_shengz a,sys_unit b,sys_cp cp where a.lx=20 and a.unit=b.id and a.pinz=cp.id ".$TJ." order by a.id desc";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$TMP_STR="<TR class=relativeTag><TD align=center class=fixedHeaderCol width=7%>".$line[2]."</TD><TD width=8% align=center class=fixedHeaderCol>".$line[3]."</TD>";
				$TMP_STR=$TMP_STR."<td align=right width=6%>".$line[4]."</td>";
				$TMP_STR=$TMP_STR."<td align=right width=4%>".@sprintf("%1.2f",$line[5])."</td>";
				$TMP_STR=$TMP_STR."<td align=right width=6%>".@sprintf("%1.2f",$line[6])."</td>";
				$TMP_STR=$TMP_STR."<td align=right width=6%>".@sprintf("%1.2f",$line[7])."</td>";
				$TMP_STR=$TMP_STR."<td align=right width=5%>".@sprintf("%1.2f",$line[8])."</td>";
				$TMP_STR=$TMP_STR."<td align=right width=5%>".@sprintf("%1.2f",$line[9])."</td>";
				$TMP_STR=$TMP_STR."<td align=right width=6%>".@sprintf("%1.2f",$line[7]*$line[8])."</td>";
				$TMP_STR=$TMP_STR."<td align=right width=7%>".@sprintf("%1.2f",$line[10])."</td>";
				$TMP_STR=$TMP_STR."<td align=right width=8%>".@sprintf("%1.2f",$line[15])."</td>";
				$TMP_STR=$TMP_STR."<td align=right width=8%>".@sprintf("%1.2f",($line[7]-$line[6])/$line[5])."</td>";
				$TMP_STR=$TMP_STR."<td align=center width=6%>".$chengl[$line[2]][$line[3]][$line[11]]."</td>";
				$TMP_STR=$TMP_STR."<td align=right width=8%>".$line[18]."</td>";
				$TMP_STR=$TMP_STR."<td width=10%>".$line[17].$line[19]."</td>";
		echo $TMP_STR."</TR>";
$daohts+=$line[5];
$chuczl+=$line[6];
$daohzl+=$line[7];
$yunzf+=$line[10];
$zongcb+=$line[15];
$jine+=$line[7]*$line[8];
	}
sqlsrv_free_stmt($result);
		$TMP_STR="<TR class=relativeTag><TD  align=center class=fixedHeaderCol colspan=3><font color=red>ºÏ¼Æ</TD>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".$daohts."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$chuczl)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$daohzl)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>&nbsp;</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>&nbsp;</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$jine)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$yunzf)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$zongcb)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>&nbsp;</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>&nbsp;</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>&nbsp;</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>&nbsp;</td>";
		echo $TMP_STR."</TR>";
?>
</TABLE></BODY></HTML>



