<?php require('./inc/xhead.php');?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<script language="javascript" src="./inc/xmy.js?i=2"></script>
</head>
<body>
<table class="tableborder3" border=0>
<form action="" method=post name="Frm">
<?php 
require('Q_Sell-1.php');
if(isset($_POST['paix']) and $_POST['paix']!="")//ÅÅĞò
	$px=$_POST['paix'];
else
	$px="xl.fenlmc,unit.typeb";
$query="select xl.fenlmc,unit.shortname,cp.mc,cast(sum(sj.dinghl) as varchar),sj.bz,isnull(sj.fudw,'') from sys_jhdh dh,sys_jhsj sj,sys_unit unit,sys_khxianl xl,sys_cp cp where cp.typeb=1 and dh.id=sj.dhid and sj.mc=cp.id and dh.unit=unit.id and unit.typec=xl.id ".$TJ." group by xl.fenlmc,unit.typeb,unit.typeb,unit.shortname,sj.bz,cp.mc,sj.fudw order by ".$px;
$result=sqlsrv_query($conn,$query);
$tp1="";
$mid=0;
$dingh_hj=0;
while($line=sqlsrv_fetch_array($result))
{
	$dingh_hj+=$line[3];
	if($line[0]!=$tp1)
	{
		if($tp1!="") 
			echo str_replace("@@",$mid,$dis);
		$dis="<tr onclick=\"k(this)\" onMouseOver=\"v(this)\" onMouseOut=\"o(this)\">
<td rowspan=@@ width=20%>".$line[0]."</td>
<td width=20%>".$line[1]."</td>
<td width=20%>".$line[2]."</td>
<td width=20%>".(float)$line[3].$line[5]."</td>
<td width=20%>".$line[4]."</td>";
		$mid=1;
	}
	else
	{
		$dis.="<tr onclick=\"k(this)\" onMouseOver=\"v(this)\" onMouseOut=\"o(this)\">
<td width=20%>".$line[1]."</td>
<td width=20%>".$line[2]."</td>
<td width=20%>".(float)$line[3].$line[5]."</td>
<td width=20%>".$line[4]."</td>";
		$mid++;
	}
$tp1=$line[0];
}
if($mid!=0)	echo str_replace("@@",$mid,$dis);
sqlsrv_free_stmt($result);
echo "<tr onclick=\"k(this)\" onMouseOver=\"v(this)\" onMouseOut=\"o(this)\"><td colspan=3 align=center><font color=red>ºÏ        ¼Æ</td><td align=center><font color=red>".$dingh_hj."</td><td></td></tr>";
?>
</form>
</table>
</body>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>
