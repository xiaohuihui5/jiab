<?php require('./inc/xhead.php');?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<script language="javascript" src="./inc/xmy.js?i=2"></script>
</head>
<body>
<p align=center><table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="100%" bordercolor="#111111">
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<?php 
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$_SESSION['DT1']=$_POST['dt1'];
	$_SESSION['DT2']=$_POST['dt2'];
}
$query="select pinz,tous,zl,convert(varchar(10),rq,120) from sys_maozpd where lx=1 and rq='".$_POST['dt1']."'";//昨日盘点 斤
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$cunl_tous[$line[0]]=$line[1];//盘点
	$cunl_zl[$line[0]]=$line[2];
}       
sqlsrv_free_stmt($result);
$pd_rq=$_POST['dt1'];
$query="select sum(sj.sl),sj.cpid,sum(sj.songhl),sum(sj.shisje)/sum(sj.songhl) from sys_maozsj sj,sys_maozdh dh where dh.dhrq between '".$_POST['dt1']."' and '".$_POST['dt2']."' and dh.lx=9 and dh.id=sj.dhid group by sj.cpid";//今日采购 斤
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$caig_tous[$line[1]]=$line[0];//+采购头数
	$cunl_zl[$line[1]]+=$line[2];//+出场重量
	$junj[$line[1]]=sprintf("%1.2f",$line[3]);//采购均价
}       
sqlsrv_free_stmt($result);
$query="select sum(sj.dhsl),sj.mc,sum(sj.songhl) from sys_jhdh dh,sys_jhsj sj where dh.dhrq between '".$pd_rq."' and '".$_POST['dt2']."' and dh.lx=5 and dh.id=sj.dhid group by sj.mc";//-生产入库 斤
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$tuz_tous[$line[1]]=$line[0];//屠宰头数
	$cunl_zl[$line[1]]-=$line[2];//屠宰重量
}       
sqlsrv_free_stmt($result);
$query="select sum(tous),pinz,sum(daohzl) from sys_shengz where daohrq between '".$pd_rq."' and '".$_POST['dt2']."' and lx=19 group by pinz";//-今日销售 斤
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$sell_tous[$line[1]]=$line[0];//销售头数
	$cunl_zl[$line[1]]-=$line[2];//销售重量
}       
sqlsrv_free_stmt($result);
$query="select id,mc from sys_cp where yn=1 and typeb=1 order by id";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$mz_cunl_tous=$cunl_tous[$line[0]]+$caig_tous[$line[0]]-$sell_tous[$line[0]]-$tuz_tous[$line[0]];
	if($mz_cunl_tous!=0 || $mz_cunl_tous!="")	$junz=sprintf("%1.2f",$cunl_zl[$line[0]]/$mz_cunl_tous);
	$zje=sprintf("%1.2f",$cunl_zl[$line[0]]*$junj[$line[0]]);
	echo"<tr><td width=10% align=center>".$line[1]."</td>
<td width=10% align=center>".$cunl_tous[$line[0]]."</td>
<td width=10% align=center>".$caig_tous[$line[0]]."</td>
<td width=10% align=center>".$sell_tous[$line[0]]."</td>
<td width=10% align=center>".$tuz_tous[$line[0]]."</td>
<td width=10% align=center>".$mz_cunl_tous."</td>
<td width=10% align=center>".$junz."</td>
<td width=10% align=center>".$cunl_zl[$line[0]]."</td>
<td width=10% align=center>".$junj[$line[0]]."</td>
<td width=10% align=center>".$zje."</td></tr>";
}       
sqlsrv_free_stmt($result);
?>
</form>
</table><br><br>
<tr><td colspan=6 align=center></td></tr>

</body>
<script type="text/javascript" defer="defer">setscroll();closeload();</script>
