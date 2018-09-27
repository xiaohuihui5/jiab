<?php 
require("inc/xhead.php");
header("Content-Disposition: attachment; filename=".$_SESSION['DT1']."至".$_SESSION['DT2']."生猪采购数据.xls");
header("Content-Type: application/force-download");
?>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=gb2312" />
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
<p align=center><br><font size=4><b><?php echo $_SESSION['DT1']."至".$_SESSION['DT2']."生猪采购数据";?></b></font></p>
<BR>
<table width="100%" cellspacing=0 border=1 style="margin-top:-2;margin-left:-1">
<TR>
	<TH><font size=2>日期</TH>
	<TH><font size=2>供应商</TH>
<?php 
		$TMP_STR=$TMP_STR."<TH><font size=2>头数</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>出场重量</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>到厂重量</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>出场价</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>到厂价</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>运杂费</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>成数</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>扣成数</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>脓包</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>扣脓包</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>总成本</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>实际单位成本</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>应付猪款</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>路损(KG/头)</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>供应商电话</TH>";
		$TMP_STR=$TMP_STR."<TH><font size=2>备注</TH>";
	echo $TMP_STR;
$TJ="";
$TJ1="";
if(isset($_REQUEST['dt1']) and $_REQUEST['dt1']!="")
{
	$_SESSION['DT1']=$_REQUEST['dt1'];
	$_SESSION['DT2']=$_REQUEST['dt2'];
}
$TJ.=" and a.daohrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
$TJ1.=" and a.jiagrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
if(isset($_REQUEST['gysid']) and $_REQUEST['gysid']!="")
{
	$TJ.=" and b.id in(".$_REQUEST['gysid'].") ";
	$TJ1.=" and b.id in(".$_REQUEST['gysid'].") ";
}
$query="select CONVERT(varchar(10),a.jiagrq,120),a.unit,a.pinz,cast(cast((a.bianzz+a.neiz1+a.fengz)/a.maozz*100 as decimal(10,2)) as varchar)+'%' from sys_jiagsc a,sys_unit b where a.lx=1 and a.unit=b.shortname ".$TJ1;
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$chengl[$line[0]][$line[1]][$line[2]]=$line[3];
}
sqlsrv_free_stmt($result);

	$query="select a.zhuangt,a.id,CONVERT(varchar(10),a.daohrq,120),b.shortname,daohts,a.chuczl,daohzl,a.chucj,a.danj,case a.yunzf when 0 then null else a.yunzf end,a.pinz,a.koucs,a.nongb2,a.kounb,a.zongcb,a.jine,beiz,b.phone from sys_shengz a,sys_unit b where a.lx>0 and a.gongysid=b.id ".$TJ." order by a.id desc";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$TMP_STR="<TR class=relativeTag><TD  align=center class=fixedHeaderCol>".$line[2]."</TD><TD align=center class=fixedHeaderCol>".$line[3]."</TD>";
				$TMP_STR=$TMP_STR."<td align=right>".$line[4]."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".@sprintf("%1.2f",$line[5])."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".@sprintf("%1.2f",$line[6])."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".@sprintf("%1.2f",$line[7])."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".@sprintf("%1.2f",$line[8])."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".$line[9]."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".$chengl[$line[2]][$line[3]][$line[10]]."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".@sprintf("%1.2f",$line[11])."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".@sprintf("%1.2f",$line[12])."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".@sprintf("%1.2f",$line[13])."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".@sprintf("%1.2f",$line[5]*$line[7]+$line[9]-$line[11]-$line[13])."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".@sprintf("%1.2f",($line[5]*$line[7]+$line[9]-$line[11]-$line[13])/$line[6])."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".@sprintf("%1.2f",$line[5]*$line[7]-$line[11]-$line[13])."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".@sprintf("%1.2f",($line[6]-$line[5])/$line[4])."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".$line[17]."</td>";
				$TMP_STR=$TMP_STR."<td align=right>".$line[16]."</td>";
		echo $TMP_STR."</TR>";
$daohts+=$line[4];
$chuczl+=$line[5];
$daohzl+=$line[6];
$chucj+=$line[7];
$danj+=$line[8];
$yunzf+=$line[9];
$chengs+=$line[10];
$koucs+=$line[11];
$nongb2+=$line[12];
$kounb+=$line[13];
$zongcb+=$line[14];
$jine+=$line[15];
$ABC+=$line[5]*$line[7];
	}
		$TMP_STR="<TR class=relativeTag><TD  align=center class=fixedHeaderCol colspan=2><font color=red>合计</TD>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".$daohts."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$chuczl)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$daohzl)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>&nbsp;</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>&nbsp;</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$yunzf)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$chengs)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$koucs)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$nongb)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$kounb)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$ABC+$yunzf-$koucs-$kounb)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",($ABC+$yunzf-$koucs-$kounb)/$daohzl)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",$ABC-$koucs-$kounb)."</td>";
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".@sprintf("%1.2f",($daohzl-$chuczl)/$daohts)."</td>";
				$TMP_STR=$TMP_STR."<td align=right>&nbsp;</td>";
				$TMP_STR=$TMP_STR."<td align=right>&nbsp;</td>";
		echo $TMP_STR."</TR>";
sqlsrv_free_stmt($result);
?>
</TABLE></BODY>
