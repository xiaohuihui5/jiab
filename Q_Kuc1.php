<?php require('./inc/xhead.php');?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_REQUEST['scroll'])?$_REQUEST['scroll']:0;?>">
<table border="0" class="tableborder3">
<?php 
$TJ="";
$TJ1="";
if(isset($_REQUEST['dt1']) and $_REQUEST['dt1']!="")
{
	$_SESSION['DT1']=$_REQUEST['dt1'];
	$_SESSION['DT2']=$_REQUEST['dt2'];
	$chaxrq=$_REQUEST['dt1'];
	$TJ.=' and dh.dhrq between \''.$_REQUEST['dt1'].'\' and \''.$_REQUEST['dt2'].'\' ';
}
else
{
 	$TJ.=" and dh.dhrq between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
	$chaxrq=date('Y-m-d');
}
if(isset($_REQUEST['cpflid']) and $_REQUEST['cpflid']!="")
	$TJ1.=" and cp.dfl in(".$_REQUEST['cpflid'].") ";
if(isset($_REQUEST['cpid']) and $_REQUEST['cpid']!="")
	$TJ1.=" and cp.id in(".$_REQUEST['cpid'].") ";
if(isset($_REQUEST['cxtj']) and $_REQUEST['cxtj']!="")
	$TJ1.=" and cp.bh+cp.mc like '%".$_REQUEST['cxtj']."%' ";
//取最近盘点日期
	$query="select CONVERT(varchar(10),max(dhrq),120) from sys_jhdh where lx=32 and dhrq<='".$chaxrq."'";
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
		if($line[0]!='')
			$pandrq=$line[0];
	}       
	sqlsrv_free_stmt($result);
//取最近盘点日期

//期初库存
//1.最近盘点数据
	$query="select cp.id,sum(sj.songhl),sum(shisje) from sys_jhdh dh,sys_cp cp,sys_jhsj sj where sj.dhid=dh.id and dh.lx in(32) and dh.dhrq='".$pandrq."' and sj.mc=cp.id group by cp.id";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$qickc[$line[0]]=$line[1];
		$qicje[$line[0]]=$line[2];
	}
	sqlsrv_free_stmt($result);
//1.最近盘点数据
      //本期入库 
	$query="select cp.id,sum(sj.songhl),sum(sj.shisje) from sys_jhdh dh,sys_cp cp,sys_jhsj sj where sj.dhid=dh.id and dh.lx in(7) and dh.dhrq>'".$pandrq."' and dh.dhrq<'".$_SESSION['DT1']."' and sj.mc=cp.id group by cp.id";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$qickc[$line[0]]+=$line[1];
		$qicje[$line[0]]+=$line[2];
	}
	sqlsrv_free_stmt($result);
     //本期出库
	$query="select cp.id,sum(sj.songhl),sum(sj.shisje) from sys_jhdh dh,sys_cp cp,sys_jhsj sj where sj.dhid=dh.id and dh.lx in(8) and dh.dhrq>'".$pandrq."' and dh.dhrq<'".$_SESSION['DT1']."' and sj.mc=cp.id group by cp.id";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$qickc[$line[0]]-=$line[1];
		$qicje[$line[0]]-=$line[2];
	}
	sqlsrv_free_stmt($result);
//计算期初库存
      //本期入库 
	$query="select cp.id,sum(sj.songhl),sum(sj.shisje) from sys_jhdh dh,sys_cp cp,sys_jhsj sj where sj.dhid=dh.id and dh.lx in(7) and sj.mc=cp.id  ".$TJ1.$TJ." group by cp.id";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$ruksl[$line[0]]=$line[1];
		$rukje[$line[0]]=$line[2];
	}
	sqlsrv_free_stmt($result);
//入库数量
//出库数量
     //本期出库
	$query="select cp.id,sum(sj.songhl),sum(sj.shisje) from sys_jhdh dh,sys_cp cp,sys_jhsj sj where sj.dhid=dh.id and dh.lx in(8) and sj.mc=cp.id  ".$TJ1.$TJ." group by cp.id";

	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$chuksl[$line[0]]=$line[1];
		$chukje[$line[0]]=$line[2];
	}
	sqlsrv_free_stmt($result);
//出库数量
$qckczl_hj=0;
$rukzl_hj=0;
$chukzl_hj=0;
$kczl_hj=0;
$kcje_hj=0;
$query="select cp.id,ltrim(cp.mc),cp.dw,cp.bh from sys_cp cp where cp.yn=1 ".$TJ1." group by cp.mc,cp.dw,cp.id,cp.bh order by cp.mc";
$result=sqlsrv_query($conn,$query);
$row=0;
while($line=sqlsrv_fetch_array($result))
{
   $kucsl[$line[0]]=($qickc[$line[0]]+$ruksl[$line[0]]-$chuksl[$line[0]]);
   $kucje[$line[0]]=($qicje[$line[0]]+$rukje[$line[0]]-$chukje[$line[0]]);
	if($kucsl[$line[0]]<>0 || $qickc[$line[0]]<>0 )
	{
$row+=1;
echo "<tr>
<td align=center width=5%>".$row."</td>
<td align=center width=10%>".$line[3]."</td>
<td align=center width=15%>".$line[1]."</td>
<td align=center width=10%>".$line[2]."</td>
<td align=lift width=12%>".$qickc[$line[0]]."</td>
<td align=lift width=12%>".$ruksl[$line[0]]."</td>
<td align=lift width=12%>".$chuksl[$line[0]]."</td>
<td align=lift width=12%>".$kucsl[$line[0]]."</td>
<td align=lift width=12%>".$kucje[$line[0]]."</td>
</tr>";
$qckczl_hj+=$qckczl[$line[0]];
$rukzl_hj+=$ruksl[$line[0]];
$chukzl_hj+=$chuksl[$line[0]];
$kczl_hj+=$kucsl[$line[0]];
$kcje_hj+=$kucje[$line[0]];
	}
}
sqlsrv_free_stmt($result);
?>
<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
	<td align="center" colspan=4><font color=red>合      计</td>
	<td align="center"><font color=red><?php echo $qckczl_hj;?></td>
	<td align="center"><font color=red><?php echo $rukzl_hj;?></td>
	<td align="center"><font color=red><?php echo $chukzl_hj;?></td>
	<td align="center"><font color=red><?php echo $kczl_hj;?></td>
	<td align="center"><font color=red><?php echo $kcje_hj;?></td>
</tr>
</form>
<script type="text/javascript" defer="defer">setscroll();closeload();</script>