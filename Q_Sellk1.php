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
	$px="unit.usercode,unit.shortname,dh";
$_SESSION['mac']="select 0,unit.usercode,unit.shortname,dh.bz,convert(varchar(10),dh.dhrq,120) as rq,'<a href=\"JavaScript:dh('+cast(dh.id as varchar(10))+')\">'+dh.dh+'</a>',cast(sum(sj.dinghl) as varchar),cast(sum(sj.songhl) as varchar),cast(sum(sj.shisl) as varchar),case sum(isnull(sj.shisl,0)-isnull(sj.songhl,0)) when 0 then null else sum(isnull(sj.shisl,0)-isnull(sj.songhl,0)) end,sum(sj.shisje) from sys_jhdh dh,sys_jhsj sj,sys_unit unit,sys_cp cp where dh.id=sj.dhid and dh.unit=unit.id and sj.mc=cp.id $TJ group by unit.usercode,unit.shortname,convert(varchar(10),dh.dhrq,120),dh.id,dh.dh,dh.bz order by ".$px;
$_SESSION['mac'].="#"."5,0,0,0,0,0,1,1,1,1,1";
$_SESSION['mac'].="#".",8%,14%,10%,8%,10%,10%,10%,10%,10%,10%";
$_SESSION['mac'].="#".",center,left,left,center,center,center,center,center,center,right";
$_SESSION['mac'].="#".",客户编号,客户名称,备注,日期,单号,订货量,送货量,实收量,差量,实收金额";
$_SESSION['mac'].="#".$_SESSION['DT1']."至".$_SESSION['DT2']."客户销售明细表";
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
	openwindow('I_Sell1Mx.php?dhid='+id,1024,768);
}
</script>
<script type="text/javascript" defer="defer">setscroll();closeload();</script>

