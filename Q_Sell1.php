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
require('Q_Sell-1.php');
if(isset($_POST['paix']) and $_POST['paix']!="")//排序
	$px=$_POST['paix'];
else
	$px="dh.dhrq,unit.shortname";
$_SESSION['mac']="select 0,'<a href=\"JavaScript:dh('+cast(dh.id as varchar(10))+')\">'+dh.dh+'</a>',unit.usercode,unit.shortname,dh.bz,convert(varchar(10),dh.dhrq,120),sum(sj.dinghl),sum(sj.songhl),sum(sj.shisl),case sum(isnull(sj.shisl,0)-isnull(sj.songhl,0)) when 0 then null else sum(isnull(sj.shisl,0)-isnull(sj.songhl,0)) end,sum(sj.shisje),case dh.zt when 1 then '<font color=red>已审核' else '未审核' end from sys_jhdh dh,sys_jhsj sj,sys_unit unit,sys_cp cp where dh.id=sj.dhid and dh.unit=unit.id and sj.mc=cp.id ".$TJ." group by dh.id,dh.dh,dh.dhrq,dh.zt,unit.usercode,unit.shortname,dh.bz order by ".$px;
$_SESSION['mac'].="#"."5,0,0,0,0,0,1,1,1,1,1,0";
$_SESSION['mac'].="#".",8%,8%,15%,21%,8%,6%,6%,6%,6%,10%,6%";
$_SESSION['mac'].="#".",center,center,left,left,center,right,right,right,right,right,center";
$_SESSION['mac'].="#".",单号,客户编号,客户名称,备注,日期,订货量,送货量,实收量,差量,实收金额,状态";
$_SESSION['mac'].="#".$_SESSION['DT1']."至".$_SESSION['DT2']."销售单据表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xdis.php");
$_SESSION['mac']=str_replace("'<a href=\"JavaScript:dh('+cast(dh.id as varchar(10))+')\">'+","",$_SESSION['mac']);
$_SESSION['mac']=str_replace("+'</a>'","",$_SESSION['mac']);
?>
</form>	
</body>
<script language=javascript>
function dh(id)
{
	openwindow('Q_SellDhcx.php?dhid='+id,1024,768);
}
</script>
<script type="text/javascript" defer="defer">setscroll();closeload();</script>

