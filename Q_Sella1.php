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
	$px="dh.dhrq,unit.shortname,dh.dh,sj.paix";
$_SESSION['mac']="select 0,convert(varchar(10),dh.dhrq,120),unit.shortname,'<a href=\"JavaScript:dh('+cast(dh.id as varchar(10))+')\">'+dh.dh+'</a>',cp.mc,cp.dw,cast(sj.dinghl*sj.chg as float),khpm.mc,khpm.gg,khpm.dw,cast(sj.dinghl as varchar),cast(sj.songhl as varchar),cast(sj.shisl as varchar),case isnull(sj.shisl,0)-isnull(sj.songhl,0) when 0 then null else cast(isnull(sj.shisl,0)-isnull(sj.songhl,0) as varchar) end,cast(sj.dj as varchar),sj.shisje,sj.bz from sys_jhdh dh,sys_jhsj sj,sys_unit unit,sys_cp cp,sys_khpm khpm where dh.id=sj.dhid and dh.unit=unit.id and sj.mc=cp.id and sj.khpmid=khpm.id ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."5,0,0,0,0,0,1,0,0,0,1,1,1,1,0,1,0";
$_SESSION['mac'].="#".",7%,10%,7%,10%,3%,6%,10%,4%,3%,6%,6%,6%,5%,5%,6%,6%";
$_SESSION['mac'].="#".",center,center,center,center,center,right,center,right,right,right,right,right,center";
$_SESSION['mac'].="#".",日期,客户名称,单号,标准品名,单位,发货量,客户品名,规格,单位,订货量,送货量,实收量,差量,单价,金额,备注";
$_SESSION['mac'].="#".$_SESSION['DT1']."至".$_SESSION['DT2']."销售明细表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xdis2.php");
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

