<?php 
include("inc/xhead.php");
$query = "select dh.lury from sys_shengz dh where dh.id=".$_GET['id'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$lury=$line[0];
$DHMC="深圳市华和土猪销售有限公司";

//得出总行数
$query="select count(*) from sys_jhsj sj where sj.dhid=".$_REQUEST['dhid'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$total_row=$line[0];
sqlsrv_free_stmt($result);
//得出总行数
///页码
$total_page=floor($total_row/15)+1;
if($total_row%15==0)
	$total_page=$total_page-1;
$now_page=1;
///页码
?>
<head>
<STYLE type=text/css>
 {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-TOP: 0px
}
BODY {
	FONT-SIZE: 11px; FONT-FAMILY: 宋体; BACKGROUND-POSITION: 50% top; MARGIN: 0px; COLOR: #000; BACKGROUND-REPEAT: repeat-x
}
TD {
	FONT-SIZE: 14px; LINE-HEIGHT: 20px; FONT-FAMILY: 宋体
}
</STYLE>
<script language="javascript" src="inc/xbigrmb.js"></script>
</head>
<BODY leftMargin=0 topMargin=0 marginheight="0" marginwidth="0" onload="oPrintCtl.Print(true);window.close();">
<table border="0" cellspacing="0" cellpadding="0" bordercolorlight="#4F71C1" bordercolordark="#B1C9F3" width="94%" align=center>
<tr><td align=center style="LINE-HEIGHT: 30px"><font style="font-size:28px;font-family: 黑体"><b><?php echo $DHMC;?></b></font></td></tr>
<tr><td align=center style="LINE-HEIGHT: 28px"><font style="font-size:26px"><b>毛猪采购单</b></font></td></tr>
</table>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="94%" align=center>
<tr>
<Td  align=center><b>序</b></Td>
<Td  align=center><b>日期</b></Td>
<Td  align=center><b>供应商</b></Td>
<Td  align=center><b>品种</b></Td>
<Td  align=center><b>头数</b></Td>
<Td  align=center><b>到场重</b></Td>
<Td  align=center><b>单价</b></Td>
<Td  align=center><b>应付猪款</b></Td>
<Td  align=center><b>&nbsp;&nbsp;备注&nbsp;&nbsp;</b></Td>
</tr>
<?php 
$query="select CONVERT(varchar(10),sz.daohrq,120),unit.shortname,cp.mc,sz.tous,sz.daohzl,sz.chucj,sz.jine,sz.beiz from sys_shengz sz,sys_unit unit,sys_cp cp where sz.lx=1 and sz.pinz=cp.id and sz.unit=unit.id and sz.id=".$_REQUEST['id']." order by sz.id";
$result=sqlsrv_query($conn,$query);
$tous=0;
$zl=0;
$je=0;
$row=0;
while($line=sqlsrv_fetch_array($result))
{
	$row++;
	echo "<tr>";
	echo "<td align=center>".$row."</td>";
	echo "<td align=center>".$line[0]."</td>";
	echo "<td>".$line[1]."</td>";
	echo "<td align=center>".$line[2]."</td>";
	echo $line[3]==0?"<td></td>":"<td align=right>".sprintf("%1.2f",$line[3])."</td>";
	echo $line[4]==0?"<td></td>":"<td align=right>".sprintf("%1.2f",$line[4])."</td>";
	echo $line[5]==0?"<td></td>":"<td align=right>".sprintf("%1.2f",$line[5])."</td>";
	echo $line[6]==0?"<td></td>":"<td align=right>".sprintf("%1.2f",$line[6])."</td>";
	echo "<td>".$line[7]."</td>";
	echo "</tr>";
	$tous+=$line[3];
	$zl+=$line[4];
	$je+=$line[6];
	if($row%10==0 && $row!=$total_row)//分页
	{
	echo '</table><table border="0"  cellspacing="0" cellpadding="0" bordercolorlight="#4F71C1" bordercolordark="#B1C9F3" align=center  width="100%"><tr><td width=22%>&nbsp;&nbsp;操作员:'.$lury.'</td><td width=22%>送货单位:</Td><td width=22%>接收人:</Td><td width=22%>审核:</Td><td width=12%>第&nbsp;'.$now_page.'/'.$total_page.'&nbsp;页</Td></tr><tr><td colspan=4><div style="page-break-after: always;"></div></td></tr></table>';
	echo '<table border="0" cellspacing="0" cellpadding="0" bordercolorlight="#4F71C1" bordercolordark="#B1C9F3" width="94%" align=center>
<tr><td align=center colspan=4 style="LINE-HEIGHT: 30px"><font style="font-size:28px;font-family: 黑体"><b><?php echo $DHMC;?></b></font></td></tr>
<tr><td align=center colspan=4 style="LINE-HEIGHT: 20px"><font style="font-size:20px"><b>生猪入库单</b></font></td></tr>
</table>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="94%" align=center>
<tr>
<Td  align=center><b>序</b></Td>
<Td  align=center><b>日期</b></Td>
<Td  align=center><b>供应商</b></Td>
<Td  align=center><b>品种</b></Td>
<Td  align=center><b>头数</b></Td>
<Td  align=center><b>到场重</b></Td>
<Td  align=center><b>单价</b></Td>
<Td  align=center><b>应付猪款</b></Td>
<Td  align=center><b>&nbsp;&nbsp;备注&nbsp;&nbsp;</b></Td>
</tr>';
$now_page+=1;
	}
}
while($row<10)//补充空格
{
	echo "<tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
	$row++;
}
	echo "<tr><td align=center colspan=4>合          计</td><td align=right>".(float)sprintf("%1.2f",$tous)."</td><td align=right>".(float)sprintf("%1.2f",$zl)."</td><td></td><td align=right>￥".(float)sprintf("%1.2f",$je)."</td><td align=right></td></tr>";
?>
</table>
<table border="0"  cellspacing="0" cellpadding="0" bordercolorlight="#4F71C1" bordercolordark="#B1C9F3" align=center  width="100%"><tr><td width=22%>&nbsp;&nbsp;制单人:<?php echo $lury;?></td><td width=22%>送货单位:</Td><td width=22%>经手人:</Td><td width=22%>审核:</Td><td width=12%></Td></tr></table>
<object style="display:none" id="oPrintCtl" classid="clsid:CA03A5A8-9890-49BE-BA4A-8C524EB06441" codebase="eprintdemo.cab#Version=3,0,0,13" VIEWASTEXT>
</body>
<script language ="javascript">
	window.print();
</script>
