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
	$px="cp.typec";
$_SESSION['mac']="select 0,cp.mc,cp.dw,sum(sj.dinghl*sj.chg),khpm.mc,khpm.gg,khpm.dw,sum(sj.dinghl),sum(sj.songhl),sum(sj.shisl),case sum(isnull(sj.shisl,0)-isnull(sj.songhl,0)) when 0 then null else sum(isnull(sj.shisl,0)-isnull(sj.songhl,0)) end,cast(case isnull(sum(sj.shisl),0) when 0 then null else cast(sum(sj.shisje)/sum(sj.shisl) as decimal(10,2)) end as varchar),sum(sj.shisje),fl.fenlmc from sys_jhdh dh,sys_jhsj sj,sys_unit unit,sys_cp cp,sys_cpxfl fl,sys_khpm khpm where dh.id=sj.dhid and dh.unit=unit.id and sj.mc=cp.id and cp.typec=fl.id and sj.khpmid=khpm.id ".$TJ." group by khpm.mc,khpm.gg,khpm.dw,cp.mc,cp.dw,cp.typec,fl.fenlmc order by ".$px;
$_SESSION['mac'].="#"."2,0,0,1,0,0,0,1,1,1,1,0,1,0";
$_SESSION['mac'].="#".",10%,4%,8%,10%,5%,4%,8%,8%,8%,6%,6%,9%,10%";
$_SESSION['mac'].="#".",center,center,center,center,center,center,right,right,right,right,center,right,center";
$_SESSION['mac'].="#".",标准品名,单位,发货量,客户品名,规格,单位,订货量,送货量,实收量,差量,均价,实收金额,商品类别";
$_SESSION['mac'].="#".$_SESSION['DT1']."至".$_SESSION['DT2']."销售按商品汇总表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xdis.php");
?>
</form>	
</body>
<script type="text/javascript" defer="defer">setscroll();closeload();</script>

