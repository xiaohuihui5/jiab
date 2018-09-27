<?php require('./inc/xhead.php');?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<body>
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="jihts" value="<?php echo isset($_POST['jihts'])?$_POST['jihts']:"";?>">
<input type="hidden" name="junz" value="<?php echo isset($_POST['junz'])?$_POST['junz']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<table border="0" class="tableborder3">
<?php 
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$_SESSION['DT1']=$_POST['dt1'];
}
$query="select sj.mc,case when sj.fudw is null then sum(sj.dinghl) else sum(sj.dinghl*cp.huansz) end from sys_jhdh dh,sys_jhsj sj,sys_cp cp where sj.mc=cp.id and dh.id=sj.dhid and dh.dhrq='".$_SESSION['DT1']."' and dh.lx=2 group by sj.mc,sj.fudw";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC))
{
	$cpsj[$line[0]]+=$line[1];//客户订货量
}       
sqlsrv_free_stmt($result);

$query="select typea,id,isnull(xis,1) from sys_cp order by typea";//需分割量
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC))
{
	$fgsj[$line[0]]=$fgsj[$line[0]]+$cpsj[$line[1]]/$line[2];
	$dhsj[$line[0]]=$dhsj[$line[0]]+$cpsj[$line[1]];
}       
sqlsrv_free_stmt($result);

$query="select id,fenlmc,cast(bil as varchar) from sys_cpyfl where bil>0 order by id";
$result=sqlsrv_query($conn,$query);
$row=0;
while($line=sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC))
{
	$chayl=sprintf("%1.2f",$line[2]/100*$_POST['jihts']*$_POST['junz']-$fgsj[$line[0]]);
	$chayts=sprintf("%1.1f",($line[2]/100*$_POST['jihts']*$_POST['junz']-$fgsj[$line[0]])/$_POST['junz']);
	$jiagl=sprintf("%1.2f",$line[2]/100*$_POST['jihts']*$_POST['junz']);
	$row=$row+1;
	$chayts_hj+=$chayts;
	$chayl_hj+=$chayl;
	$dinghl_hj+=$dhsj[$line[0]];
	$jihsc_hj+=sprintf("%1.2f",$fgsj[$line[0]]);
	$jiagl_hj+=$jiagl;
	echo "<tr onclick='k(this)' onMouseOver='v(this)' onMouseOut='o(this)'><td width=5% align=center>".$row."</td>";
	echo "<td width=10%>",$line[1],"</td>";
	echo "<td width=10%>",sprintf("%1.1f",$dhsj[$line[0]]),"</td>";
	echo "<td width=10%>",sprintf("%1.1f",$fgsj[$line[0]]),"</td>";
	echo "<td width=10%>",isset($_POST['jihts'])?$jiagl:"","</td>";
if($chayl>0)
	echo "<td width=15%>",isset($_POST['jihts'])?$chayl:"","</td>";
else
	echo "<td width=15%><font color=red>",isset($_POST['jihts'])?$chayl:"","<font></td>";
	echo "<td width=10% align=center>",isset($_POST['jihts'])?$_POST['jihts']:"","</td>";
	echo "<td width=15% align=center>",sprintf("%1.2f",$line[2]),"</td>";
	echo "<td width=15%>",isset($_POST['junz'])?$chayts:"","</td>";
	echo "</tr>";
}
sqlsrv_free_stmt($result);
echo"<tr><td colspan=2><font color=red>合计</font></td><td><font color=red>".$dinghl_hj."</font></td><td><font color=red>".$jihsc_hj."</font></td><td><font color=red>".$jiagl_hj."</font></td><td><font color=red>".$chayl_hj."</font></td><td></td><td><font color=red>84%</font></td><td><font color=red>".$chayts_hj."</font></td></tr>";
?>
</table>
</form>
</body>
<script type="text/javascript" defer="defer">setscroll()</script>
<script type="text/javascript" defer="defer">closeload()</script>
