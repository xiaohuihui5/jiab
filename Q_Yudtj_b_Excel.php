<?php 
require("inc/xhead.php");
header("Content-Disposition: attachment; filename=".$_SESSION['DT1']."客户订货统计表.xls");
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
<p align=center><br><font size=4><b><?php echo $_SESSION['DT1']."客户订货统计表";?></b></font></p>
<?php 
	$cp_id="0";
	$kh_id="0";
	for($i=0;$i<=600;$i++)//产品
		for($j=1;$j<=1000;$j++)//客户
		$Data[$i][$j]=0;
$TJ=$_SESSION['mac'];
	$query="select sj.mc,dh.unit,cast(sum(sj.dinghl) as varchar),cp.typec from sys_jhdh dh,sys_jhsj sj,sys_unit unit,sys_cp cp where dh.id=sj.dhid and dh.unit=unit.id and sj.mc=cp.id ".$TJ." group by sj.mc,dh.unit,cp.typec having sum(sj.dinghl)>0";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$cp_id=$cp_id.",".$line[0];
		$kh_id=$kh_id.",".$line[1];
		$Data[$line[0]][$line[1]]=$line[2];
		$dfl_dingh[$line[3]]+=$line[2];
	}
?>
<TABLE border="1">
<TBODY>
<TR>
	<TH noWrap rowspan=2>&nbsp;&nbsp;<font color=black>商品二级分类&nbsp;&nbsp;</TH>
	<TH noWrap rowspan=2>分类合计</TH>
	<TH noWrap rowspan=2>&nbsp;&nbsp;<font color=black>商品名称&nbsp;&nbsp;</TH>
	<TH noWrap rowspan=2><font color=black>规格</TH>
	<TH noWrap rowspan=2><font color=black>单位</TH>
	<TH noWrap rowspan=2>&nbsp;<font color=black>合计&nbsp;</TH>
<?php 
	$query="select count(*),unit.typec from sys_unit unit where unit.id in(".$kh_id.") group by unit.typec";
	$result=sqlsrv_query($conn,$query);
	$xl_id="0";
	while($line=sqlsrv_fetch_array($result))
	{
		$xl_id=$xl_id.",".$line[1];
		$xl_kh[$line[1]]=$line[0];//取出每条线路有多少个客户
	}
	sqlsrv_free_stmt($result);

	$query="select xl.fenlmc,xl.id from sys_khxianl xl where xl.id in(".$xl_id.") order by xl.id";
	$result=sqlsrv_query($conn,$query);
	$TMP_STR="";
	while($line=sqlsrv_fetch_array($result))
	{
		$TMP_STR=$TMP_STR."<td colspan=".$xl_kh[$line[1]]." align=center>".$line[0]."</td>";
	}
	sqlsrv_free_stmt($result);
	echo $TMP_STR."</TR>";//显示线路名称

	$total_kh=0;
	$query="select shortname,id from sys_unit where id in(".$kh_id.") order by typed,usercode";
	$result=sqlsrv_query($conn,$query);
	$TMP_STR="<TR>";
	while($line=sqlsrv_fetch_array($result))
	{
		$total_kh+=1;
		$now_kh[$total_kh]=$line[1];
		$TMP_STR=$TMP_STR."<td><font size=2>".$line[0]."</td>";
	}
	sqlsrv_free_stmt($result);
	echo $TMP_STR;
?>
</TR>
<?php 
$total_cp_hj=0;
$query="select cp.mc,cp.id,cp.gg,cp.dw,fl.fenlmc,fl.id from sys_cp cp,sys_cpxfl fl where cp.id in(".$cp_id.") and cp.typec=fl.id order by fl.bianh,cp.bh";
$result=sqlsrv_query($conn,$query);
$tp1='';
$mid=0;
while($line=sqlsrv_fetch_array($result))
{
		$cp_hj=0;
		for($i=1;$i<=$total_kh;$i++)
				$cp_hj=$cp_hj+$Data[$line[1]][$now_kh[$i]];//产品合计
		$total_cp_hj=$total_cp_hj+$cp_hj;

	if($line[4]!=$tp1)
	{
		if($tp1!='') echo str_replace("@@",$mid,$TMP_STR.'</TR>');
		$TMP_STR='<TR class="relativeTag"><TD class="fixedHeaderCol" rowspan=@@>'.$line[4].'</TD><TD class="fixedHeaderCol" rowspan=@@ align=center>'.$dfl_dingh[$line[5]].'</TD><TD class="fixedHeaderCol">'.$line[0].'</TD><TD class="fixedHeaderCol" align=center>'.$line[2].'</TD><TD class="fixedHeaderCol" align=center>'.$line[3].'</TD><TD align=right class="fixedHeaderCol">'.$cp_hj.'</TD>';
		for($i=1;$i<=$total_kh;$i++)
		{
			$Data[0][$now_kh[$i]]=$Data[0][$now_kh[$i]]+$Data[$line[1]][$now_kh[$i]];//客户合计

			if($Data[$line[1]][$now_kh[$i]]!=0)
				$TMP_STR=$TMP_STR.'<td align=right>'.$Data[$line[1]][$now_kh[$i]].'</td>';
			else
				$TMP_STR=$TMP_STR.'<td>&nbsp;</td>';
		}
		$mid=1;
	}
	else
	{
		$TMP_STR=$TMP_STR.'<TR class="relativeTag"><TD class="fixedHeaderCol">'.$line[0].'</TD><TD class="fixedHeaderCol" align=center>'.$line[2].'</TD><TD class="fixedHeaderCol" align=center>'.$line[3].'</TD><TD align=right class="fixedHeaderCol">'.$cp_hj.'</TD>';
		for($i=1;$i<=$total_kh;$i++)
		{
			$Data[0][$now_kh[$i]]=$Data[0][$now_kh[$i]]+$Data[$line[1]][$now_kh[$i]];//客户合计

			if($Data[$line[1]][$now_kh[$i]]!=0)
				$TMP_STR=$TMP_STR.'<td align=right>'.$Data[$line[1]][$now_kh[$i]].'</td>';
			else
				$TMP_STR=$TMP_STR.'<td>&nbsp;</td>';
		}
		$mid++;
	}
$tp1=$line[4];
}
if($mid!=0)	echo str_replace("@@",$mid,$TMP_STR);
sqlsrv_free_stmt($result);

		$TMP_STR="<TR><TD align=center colspan=5><font color=red>总合计</TD><TD align=right><font color=red>".$total_cp_hj."</TD>";
		for($i=1;$i<=$total_kh;$i++)
		{
			if($Data[0][$now_kh[$i]]!=0)
				$TMP_STR=$TMP_STR."<td align=right><font color=red>".$Data[0][$now_kh[$i]]."</td>";
			else
				$TMP_STR=$TMP_STR."<td>&nbsp;</td>";
		}
		echo $TMP_STR."</TR>";
?>
</TBODY></TABLE></DIV></BODY></HTML>
