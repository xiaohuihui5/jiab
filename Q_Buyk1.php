<?php
require('./inc/xhead.php');
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<body >
<form action="" method=post name="Frm">
<table border="1" class="tableborder3">
<?php
require('Q_Buy-1.php');
if(isset($_POST['paix']) and $_POST['paix']!="")//排序
	$px=$_POST['paix'];
else
	$px="unit.usercode,unit.shortname,dh";
$_SESSION['mac']="select 0,unit.usercode,unit.shortname,dh.bz,convert(varchar(10),dh.dhrq,120) as rq,'<a href=\"JavaScript:dh('+cast(dh.id as varchar(10))+')\">'+dh.dh+'</a>',sum(dh.zf*sj.shisje),case dh.zt when 1 then '<font color=red>已审核</font>' when 100 then '<font color=orange>已付款</font>' else '未审核' end from sys_jhdh dh,sys_jhsj sj,sys_unit unit,sys_cp cp where dh.id=sj.dhid and dh.unit=unit.id and sj.mc=cp.id $TJ group by dh.zt,unit.usercode,unit.shortname,convert(varchar(10),dh.dhrq,120),dh.id,dh.dh,dh.bz order by ".$px;
$_SESSION['mac'].="#"."5,0,0,0,0,0,1,0";
$_SESSION['mac'].="#".",10%,20%,20%,10%,10%,20%,10%";
$_SESSION['mac'].="#".",center,left,left,center,center,right,center";
$_SESSION['mac'].="#".",供应商编号,供应商名称,备注,日期,单号,实收金额,状态";
$_SESSION['mac'].="#".$_SESSION['DT1']."至".$_SESSION['DT2']."供应商采购明细表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xdis.php");
$_SESSION['mac']="select 0,unit.usercode,unit.shortname,dh.bz,convert(varchar(10),dh.dhrq,120) as rq,dh.dh,sum(dh.zf*sj.shisje),case dh.zt when 1 then '已审核' when 100 then '已付款' else '未审核' end from sys_jhdh dh,sys_jhsj sj,sys_unit unit,sys_cp cp where dh.id=sj.dhid and dh.unit=unit.id and sj.mc=cp.id $TJ group by unit.usercode,unit.shortname,convert(varchar(10),dh.dhrq,120),dh.id,dh.dh,dh.bz,dh.zt order by ".$px;
$_SESSION['mac'].="#"."5,0,0,0,0,0,1";
$_SESSION['mac'].="#".",10%,20%,20%,10%,20%,20%";
$_SESSION['mac'].="#".",center,left,left,center,center,right";
$_SESSION['mac'].="#".",供应商编号,供应商名称,备注,日期,单号,实收金额";
$_SESSION['mac'].="#".$_SESSION['DT1']."至".$_SESSION['DT2']."供应商采购明细表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
?>
</form>	
</body>
<script language=javascript>
function dh(id)
{
	openwindow('Q_BuyDhcx.php?dhid='+id,1024,768);
}
</script>
<script type="text/javascript" defer="defer">setscroll();closeload();</script>

