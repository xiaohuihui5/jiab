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
if(isset($_POST['gysid']) and $_POST['gysid']!="")
	$TJ.=" and sj.gysid in(".$_POST['gysid'].") ";
if(isset($_POST['paix']) and $_POST['paix']!="")//����
	$px=$_POST['paix'];
else
	$px="dh.dhrq desc,cp.typec,cp.bh,sj.fudw";
$_SESSION['mac']="select 0,cp.mc,case when sj.fudw is null then cp.dw else sj.fudw end,case when sj.fudw is null then cast(cast(sj.dinghl*sj.chg as float) as varchar)+isnull(sj.fudw,'') else cast(sj.dinghl as varchar)+isnull(sj.fudw,'') end,unit.shortname,khpm.mc,khpm.gg,khpm.dw,cast(sj.dinghl as varchar)+isnull(sj.fudw,''),sj.bz from sys_jhdh dh,sys_jhsj sj,sys_cp cp,sys_unit unit,sys_khpm khpm where dh.id=sj.dhid and cp.id=sj.mc and dh.unit=unit.id and sj.khpmid=khpm.id ".$TJ." and dh.lx=2 order by ".$px;
$_SESSION['mac'].="#"."2,0,0,1,0,0,0,0,1,0";
$_SESSION['mac'].="#".",15%,4%,10%,20%,15%,6%,4%,10%,16%";
$_SESSION['mac'].="#".",center,center,center,center,center,center,center,center";
$_SESSION['mac'].="#".",��׼Ʒ��,��λ,������,�ͻ�,�ͻ�Ʒ��,���,��λ,������,��ע";
$_SESSION['mac'].="#".$_SESSION['DT1']."��".$_SESSION['DT2']."�ͻ���������Ʒ���ܱ�";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xdis3.php");
?>
</form>	
</body>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

