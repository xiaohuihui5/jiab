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
if(isset($_POST['paix']) and $_POST['paix']!="")//����
	$px=$_POST['paix'];
else
	$px="dhrq";
$_SESSION['mac']="select 0,convert(varchar(10),dh.dhrq,120) as dhrq,unit.shortname,cast(sum(sj.dinghl) as varchar),cast(sum(sj.songhl) as varchar),cast(sum(sj.shisl) as varchar),case sum(isnull(sj.shisl,0)-isnull(sj.songhl,0)) when 0 then null else sum(isnull(sj.shisl,0)-isnull(sj.songhl,0)) end,sum(sj.shisje) from sys_jhdh dh,sys_jhsj sj,sys_unit unit,sys_cp cp where dh.id=sj.dhid and dh.unit=unit.id and sj.mc=cp.id $TJ group by dhrq,unit.shortname order by ".$px;
$_SESSION['mac'].="#"."2,0,0,1,1,1,1,1";
$_SESSION['mac'].="#".",10%,40%,10%,10%,10%,10%,10%";
$_SESSION['mac'].="#".",left,center,right,right,right,right,right";
$_SESSION['mac'].="#".",����,�ͻ�����,������,�ͻ���,ʵ����,����,ʵ�ս��";
$_SESSION['mac'].="#".$_SESSION['DT1']."��".$_SESSION['DT2']."���۰��ջ��ܱ�";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xdis.php");
?>
</form>	
</body>
<script type="text/javascript" defer="defer">setscroll();closeload();</script>

