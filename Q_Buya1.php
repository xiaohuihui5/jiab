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
if(isset($_POST['paix']) and $_POST['paix']!="")//����
	$px=$_POST['paix'];
else
	$px="dh.dhrq,unit.shortname,dh.dh,sj.paix";
$_SESSION['mac']="select 0,convert(varchar(10),dh.dhrq,120),unit.shortname,'<a href=\"JavaScript:dh('+cast(dh.id as varchar(10))+')\">'+dh.dh+'</a>',cp.mc,cp.dw,cast(dh.zf*sj.dinghl as varchar),cast(dh.zf*sj.songhl as varchar),cast(dh.zf*sj.shisl as varchar),case isnull(sj.shisl,0)-isnull(sj.songhl,0) when 0 then null else cast(isnull(sj.shisl,0)-isnull(sj.songhl,0) as varchar) end,cast(sj.dj as varchar),dh.zf*sj.shisje,sj.bz from sys_jhdh dh,sys_jhsj sj,sys_unit unit,sys_cp cp where dh.id=sj.dhid and dh.unit=unit.id and sj.mc=cp.id ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."5,0,0,0,0,0,1,1,1,1,0,1,0";
$_SESSION['mac'].="#".",8%,12%,8%,20%,4%,6%,6%,6%,6%,6%,6%,12%";
$_SESSION['mac'].="#".",center,center,center,center,center,right,right,right,right,right,right,center";
$_SESSION['mac'].="#".",����,��Ӧ��,����,��Ʒ����,��λ,����,�ͻ���,ʵ����,����,����,���,��ע";
$_SESSION['mac'].="#".$_SESSION['DT1']."��".$_SESSION['DT2']."�ɹ���ϸ��";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xdis2.php");
$_SESSION['mac']="select 0,convert(varchar(10),dh.dhrq,120),unit.shortname,dh.dh,cp.mc,cp.dw,cast(dh.zf*sj.dinghl as varchar),cast(dh.zf*sj.songhl as varchar),cast(dh.zf*sj.shisl as varchar),case isnull(sj.shisl,0)-isnull(sj.songhl,0) when 0 then null else cast(isnull(sj.shisl,0)-isnull(sj.songhl,0) as varchar) end,cast(sj.dj as varchar),dh.zf*sj.shisje,sj.bz from sys_jhdh dh,sys_jhsj sj,sys_unit unit,sys_cp cp where dh.id=sj.dhid and dh.unit=unit.id and sj.mc=cp.id ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."5,0,0,0,0,0,1,1,1,1,0,1,0";
$_SESSION['mac'].="#".",8%,12%,8%,20%,4%,6%,6%,6%,6%,6%,6%,12%";
$_SESSION['mac'].="#".",center,center,center,center,center,right,right,right,right,right,right,center";
$_SESSION['mac'].="#".",����,��Ӧ��,����,��Ʒ����,��λ,����,�ͻ���,ʵ����,����,����,���,��ע";
$_SESSION['mac'].="#".$_SESSION['DT1']."��".$_SESSION['DT2']."�ɹ���ϸ��";
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

