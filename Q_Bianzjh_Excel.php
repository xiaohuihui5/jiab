<?php 
require("inc/xhead.php");
header("Content-Disposition: attachment; filename=".$_SESSION['DT1']."边猪发货计划.xls");
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
<table border="1">
<p align=center><br><font size=4><b><?php echo $_SESSION['DT1']."边猪发货计划";?></b></font></p>
<?php
$tmpstr='<tr><td align=center rowspan=2><b>客户名称</td><td align=center rowspan=2><b>带皮白条(一级)</td><td align=center rowspan=2><b>发货头数</td><td align=center colspan=16><b>实际发货重量</td></tr><tr><td></td>';
for($i=1;$i<=15;$i++)
{
	$tmpstr.='<td align=center><b>'.$i.'</td>';
}
echo $tmpstr.'</tr>';
$TJ=$_SESSION['mac'];
$query="select unit.shortname,sum(sj.dinghl) from sys_jhdh dh,sys_jhsj sj,sys_unit unit where dh.id=sj.dhid and dh.unit=unit.id and unit.typec=1 and sj.mc=6 ".$TJ." group by unit.shortname order by unit.shortname";
$result=sqlsrv_query($conn,$query);
$dingh_hj=0;
while($line=sqlsrv_fetch_array($result))
{
	$dingh_hj+=$line[1];
	echo "<tr><td rowspan=2>".$line[0]."</td><td rowspan=2>".$line[1]."</td><td rowspan=2></td><td>编码</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td></tr>
			<tr><td>重量</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
}
sqlsrv_free_stmt($result);
echo "<tr><td align=center><font color=red>合        计</td><td align=center><font color=red>".$dingh_hj."</td></tr>";
echo "<tr><td colspan=3><font size=4><b>内脏</td><td colspan=4><font size=4><b>猪肚</td><td colspan=4><font size=4><b>猪脚</td><td colspan=4><font size=4><b>猪手</td><td colspan=4><font size=4><b>带耳头骨</td></tr>";
echo '</table><br><br><br><br><table border="1"><p align=center><br><font size=4><b>定安黑猪发货重量</b></font></p>';
$tmpstr='<tr><td></td>';
for($i=1;$i<=20;$i++)
{
	$tmpstr.='<td align=center><b>'.$i.'</td>';
}
echo $tmpstr.'</tr>';
echo '<tr><td align=center><b>编码</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></tr>';
echo '<tr><td align=center><b>重量</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></tr>';
?>
</table>
</table>
</BODY>
