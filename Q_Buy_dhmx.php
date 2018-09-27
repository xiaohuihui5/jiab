<?php 
require('./inc/xhead.php');
$query = "select 0,a.dh,CONVERT(varchar(10),a.dhrq,120),b.shortname,a.lury,a.bz,a.id from sys_jhdh a,sys_unit b,sys_jhsj sj where a.lx=2 and a.unit=b.id and a.id=sj.dhid and sj.mc=".$_REQUEST['cpid']." and b.id=".$_REQUEST['khid']." and a.dhrq='".$_REQUEST['shrq']."'";
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$dh=$line[1];
$rq=$line[2];
$gys=$line[3];
$lry=$line[4];
$bz=$line[5];
$shr=$line[0];
$dhid=$line[6];
sqlsrv_free_stmt($result);

$DHMC="采购单";
$unitname="客户";
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script language="javascript" src="./inc/xbigrmb.js"></script>
<title><?php echo $DHMC;?></title>
</head>
<body>
<table border="0"  cellspacing="0" cellpadding="0" bordercolorlight="#4F71C1" bordercolordark="#B1C9F3" width="98%" align=center>
<tr><td align=center colspan=3 style="LINE-HEIGHT: 30px"><font style="font-size:30px;font-family: 黑体"><b><?php echo $DHMC;?></b></font></td></tr>
<tr>
<td width=35%>&nbsp;&nbsp;&nbsp;供应商名称:<?php echo $gys;?></td>
<td width=30%>&nbsp;&nbsp;&nbsp;</td>
<td width=35%>单号:<?php echo $dh;?></td>
</tr>
<tr>
<td width=35%>&nbsp;&nbsp;&nbsp;到货日期:<?php echo $rq;?></td>
<td width=30%>制单人:<?php echo $lry;?></td>
<td width=35%>审核人:<?php echo $shr;?></td>
</tr>
</table>
<table border="0"  cellspacing="0" cellpadding="0" bordercolorlight="#4F71C1" bordercolordark="#B1C9F3" width="98%" align=center>
<tr>
<Td  align=center><b>序号</b></Td>
<Td  align=center><b>商品编码</b></Td>
<Td  align=center><b>商品名称</b></Td>
<Td  align=center><b>规格</b></Td>
<Td  align=center><b>订货量</b></Td>
<Td  align=center><b>到货量</b></Td>
<Td  align=center><b>实收量</b></Td>
<Td  align=center><b>单位</b></Td>
<Td  align=center><b>单价</b></Td>
<Td  align=center><b>金额</b></Td>
<Td  align=center><b>备注</b></Td>
</tr>
<?php 
$row=0;
$query = "select cp.id,cp.bh,cp.mc,cp.gg,sj.dinghl,sj.fudw,sj.songhl,sj.shisl,cp.dw,sj.dj,sj.shisje,sj.bz,dh.zt,sj.paix,cp.huansz,sj.chukl from sys_jhsj sj,sys_cp cp,sys_jhdh dh where dh.id=sj.dhid and sj.mc=cp.id and sj.dhid=".$dhid." order by sj.paix";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
$line[4]=$line[4]==0?"":$line[4];
$line[6]=$line[6]==0?"":$line[6];
$line[7]=$line[7]==0?"":$line[7];
$line[9]=$line[9]==0?"":$line[9];
$line[10]=$line[10]==0?"":$line[10];
	$row=$row+1;
	if($line[0]==$_REQUEST['cpid'])
	{
?>
	<tr bgcolor="#d2e9ff">
		<td width="4%" align="center"><?php echo $row;?></td>
		<td width="6%" align="center"><?php echo $line[1];?></td>
		<td width="24%"><?php echo $line[2];?></td>
		<td width="8%"><?php echo $line[3];?></td>
		<td width="6%"><?php echo $line[4];?></td>
		<td width="6%"><?php echo $line[5];?></td>
		<td width="6%"><?php echo $line[6];?></td>
		<td width="6%"><?php echo $line[7];?></td>
		<td width="6%" align=center><?php echo $line[8];?></td> 
		<td width="6%"><?php echo $line[9];?></td>
		<td width="6%" align=right></td> 
		<td width="8%" align=right><?php echo $line[10];?></td>
		<td width="8%"><?php echo $line[11];?></td>
	</tr>
<?php
	}
else
	{
?>
	<tr onMouseOut="o(this)">
		<td width="4%" align="center"><?php echo $row;?></td>
		<td width="6%" align="center"><?php echo $line[1];?></td>
		<td width="24%"><?php echo $line[2];?></td>
		<td width="8%"><?php echo $line[3];?></td>
		<td width="6%"><?php echo $line[4];?></td>
		<td width="6%"><?php echo $line[5];?></td>
		<td width="6%"><?php echo $line[6];?></td>
		<td width="6%"><?php echo $line[7];?></td>
		<td width="6%" align=center><?php echo $line[8];?></td> 
		<td width="6%"><?php echo $line[9];?></td>
		<td width="6%" align=right></td> 
		<td width="8%" align=right><?php echo $line[10];?></td>
		<td width="8%"><?php echo $line[11];?></td>
	</tr>
<?php
	}
$hjdinghl+=$line[4];
$hjsonghl+=$line[6];
$hjshisl+=$line[7];
$hjjine+=$line[10]; 
}
sqlsrv_free_stmt($result);
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td width="4%" align="center"></td>
		<td width="6%" align="center"></td>
		<td width="24%"></td>
		<td width="8%"><font color=red>合计</font></td>
		<td width="6%"><font color=red><?php echo $hjdinghl;?></font></td>
		<td width="6%"></td>
		<td width="6%"><font color=red><?php echo $hjsonghl;?></font></td>
		<td width="6%"><font color=red><?php echo $hjshisl;?></font></td>
		<td width="6%"></td> 
		<td width="6%"></td>
		<td width="6%"></td> 
		<td width="8%" align=right><font color=red><?php echo $hjjine;?></font></td>
		<td width="8%"></td>
	</tr>
</table>
</body>

