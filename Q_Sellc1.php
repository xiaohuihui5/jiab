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
	$px="unit.typea,unit.usercode,unit.shortname";
$_SESSION['mac']="select 0,unit.shortname,cast(sum(sj.dinghl) as varchar),sum(sj.songhl),sum(sj.shisl),case sum(isnull(sj.shisl,0)-isnull(sj.songhl,0)) when 0 then null else sum(isnull(sj.shisl,0)-isnull(sj.songhl,0)) end,sum(sj.shisje) from sys_jhdh dh,sys_jhsj sj,sys_unit unit,sys_cp cp where dh.id=sj.dhid and dh.unit=unit.id and sj.mc=cp.id $TJ group by unit.typea,unit.usercode,unit.shortname order by ".$px;
$_SESSION['mac'].="#"."1,0,1,1,1,1,1";
$_SESSION['mac'].="#".",50%,10%,10%,10%,10%,10%";
$_SESSION['mac'].="#".",left,right,right,right,right,right,right";
$_SESSION['mac'].="#".",客户名称,订货量,送货量,实收量,差量,实收金额";
$_SESSION['mac'].="#".$_SESSION['DT1']."至".$_SESSION['DT2']."销售按客户汇总表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xdis.php");
?>
</form>	
</body>
<script type="text/javascript" defer="defer">setscroll();closeload();</script>

