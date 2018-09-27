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
$query = "select sj.id,cp.bh,cp.mc,cp.gg,cast(sj.dinghl as varchar),sj.fudw,cast(sj.songhl as varchar),cast(sj.shisl as varchar),cp.dw,sj.dj,sj.shisje,sj.bz,dh.zt,sj.paix,cp.huansz,sj.mc from sys_jhsj sj,sys_cp cp,sys_jhdh dh where dh.id=sj.dhid and sj.mc=cp.id and sj.dhid=".$_REQUEST['dhid']." order by sj.paix";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$row=$row+1;
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td width="4%" align="center"><?php echo $row;?></td>
		<td width="4%" align="center"><?php echo $line[13];?></td>
		<td width="6%" align="center"><?php echo $line[1];?></td>
		<td width="15%"><?php echo $line[2];?></td>
		<td width="8%"><?php echo $line[3];?></td>
		<td width="7%"><?php echo $line[4];?></td>
		<td width="5%"><?php echo $line[5];?></td>
		<td width="7%"><?php echo $line[6];?></td>
		<td width="7%"><?php echo $line[7];?></td>
		<td width="5%" align=center><?php echo $line[8];?></td> 
		<td width="7%"><?php echo $line[9];?></td>
		<td width="8%" align=right><?php echo $line[10];?></td>
		<td width="17%"><?php echo $line[11];?></td>
	</tr>
<?php
$hjdinghl+=$line[4];
$hjsonghl+=$line[6];
$hjshisl+=$line[7];
$hjjine+=$line[10];
}
sqlsrv_free_stmt($result);
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td colspan="5"><font color=red>ºÏ¼Æ</font></td>
		<td><font color=red><?php echo $hjdinghl;?></font></td>
		<td></td>
		<td><font color=red><?php echo $hjsonghl;?></font></td>
		<td><font color=red><?php echo $hjshisl;?></font></td>
		<td></td> 
		<td></td>
		<td><font color=red><?php echo $hjjine;?></font></td>
		<td colspan="2"></td>
	</tr>
</table>
</body>
