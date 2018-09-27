<?php 
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<BODY>
<table border="1" class="tableborder3">
<?php 
$row=0;
$query = "select dh.dh,convert(varchar(10),dh.dhrq,120),sum(dh.zf*sj.shisje),dh.bz from sys_jhdh dh,sys_jhsj sj where dh.id in(".$_REQUEST['dhid'].") and dh.id=sj.dhid group by dh.dh,dh.dhrq,dh.bz";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$row=$row+1;
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td width="20%" align="center"><?php echo $row;?></td>
		<td width="20%" align=center><?php echo $line[0];?></td> 
		<td width="20%" align=center><?php echo $line[1];?></td>
		<td width="20%" align=right><?php echo $line[2];?></td>
		<td width="20%"><?php echo $line[3];?></td>
	</tr>
<?php
$hjjine+=$line[2];
}
sqlsrv_free_stmt($result);
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td colspan="3"><font color=red>ºÏ¼Æ</font></td>
		<td><font color=red><?php echo $hjjine;?></font></td>
		<td></td>
	</tr>
</table>
</body>
