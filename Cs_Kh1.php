<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query='update sys_unit set yn=yn^1 where id='.$_POST['delrow'];
	include('./inc/xexec.php');
}
if(isset($_POST['dadj']) and $_POST['dadj']!=0)
{
	$query="update sys_unit set dadj=dadj^1 where id=".$_POST['dadj'];
	include("./inc/xexec.php");
}
if(isset($_POST['dydw']) and $_POST['dydw']!=0)
{
	$query="update sys_unit set dydw=dydw^1 where id=".$_POST['dydw'];
	include("./inc/xexec.php");
}
if(isset($_POST['meirsh']) and $_POST['meirsh']!=0)
{
	$query="update sys_unit set meirsh=meirsh^1 where id=".$_POST['meirsh'];
	include("./inc/xexec.php");
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<body >
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="delrow" value="0">
<input type="hidden" name="edtrow" value="0">
<input type="hidden" name="dydw" value="0">
<input type="hidden" name="dadj" value="0">
<input type="hidden" name="meirsh" value="0">
<input type="hidden" name="khid" value="<?php echo isset($_POST['khid'])?$_POST['khid']:"";?>">
<input type="hidden" name="khflid" value="<?php echo isset($_POST['khflid'])?$_POST['khflid']:"";?>">
<input type="hidden" name="khlxid" value="<?php echo isset($_POST['khlxid'])?$_POST['khlxid']:"";?>">
<input type="hidden" name="khxlid" value="<?php echo isset($_POST['khxlid'])?$_POST['khxlid']:"";?>">
<input type="hidden" name="zhuangt" value="<?php echo isset($_POST['zhuangt'])?$_POST['zhuangt']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<?php 
$TJ="";
if(isset($_POST['khlxid']) and $_POST['khlxid']!="")
	$TJ.=" and unit.typea in(".$_POST['khlxid'].") ";
if(isset($_POST['khflid']) and $_POST['khflid']!="")
	$TJ.=" and unit.typeb in(".$_POST['khflid'].") ";
if(isset($_POST['khxlid']) and $_POST['khxlid']!="")
	$TJ.=" and unit.typec in(".$_POST['khxlid'].") ";
if(isset($_POST['khid']) and $_POST['khid']!="")
	$TJ.=" and unit.id in(".$_POST['khid'].") ";
if(isset($_POST['zhuangt']) and $_POST['zhuangt']!="")
	$TJ.=" and unit.yn in(".$_POST['zhuangt'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and (unit.usercode like '%".$_POST['cxtj']."%' or unit.shortname like '%".$_POST['cxtj']."%' or unit.piny like '%".$_POST['cxtj']."%') ";

if(isset($_POST['paix']) and $_POST['paix']!="")//排序
	$px=$_POST['paix'];
else
	$px="fl.bianh,unit.usercode";


if(menuright(8)>1)//录入权限
{
$_SESSION['mac']="select 0,0,fl.fenlmc,unit.usercode,'<div title=\"'+unit.shortname+'\" style=\"overflow:hidden;\">'+unit.shortname+'</div>','<div title=\"'+unit.name+'\" style=\"overflow:hidden;\">'+unit.name+'</div>',
fz.fenlmc,jg.fenlmc,
case unit.dadj when 0 then '<a href=javascript:dadj('+cast(unit.id as varchar(10))+')><font color=red>否</a>' else '<a href=javascript:dadj('+cast(unit.id as varchar(10))+')>是</a>' end,
case unit.dydw when 0 then '<a href=javascript:dydw('+cast(unit.id as varchar(10))+')><font color=red>斤</a>' else '<a href=javascript:dydw('+cast(unit.id as varchar(10))+')>公斤</a>' end,
case unit.meirsh when 0 then '<a href=javascript:meirsh('+cast(unit.id as varchar(10))+')><font color=red>否</a>' else '<a href=javascript:meirsh('+cast(unit.id as varchar(10))+')>是</a>' end,
unit.weixh,
case unit.yn when 0 then '<a href=javascript:yn('+cast(unit.id as varchar(10))+')><font color=gray>停用</a>' else '<a href=javascript:yn('+cast(unit.id as varchar(10))+')>启用</a>' end,
'<a href=javascript:ed('+cast(unit.id as varchar(10))+')><img border=0 src=im/xiug.png alt=修改此单></a>'
from sys_unit unit,sys_khfenl fl,sys_khleix jg,sys_khxianl fz where unit.typea=jg.id and unit.typeb=fl.id and unit.typec=fz.id and unit.mode=2 ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."13,0,0,0,0,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",4%,10%,6%,14%,21%,10%,10%,4%,4%,4%,5%,4%,4%";
}
else
{
$_SESSION['mac']="select 0,0,fl.fenlmc,unit.usercode,'<div title=\"'+unit.shortname+'\" style=\"overflow:hidden;\">'+unit.shortname+'</div>','<div title=\"'+unit.name+'\" style=\"overflow:hidden;\">'+unit.name+'</div>',
fz.fenlmc,jg.fenlmc,
case unit.dadj when 0 then '<a href=javascript:dadj('+cast(unit.id as varchar(10))+')><font color=red>否</a>' else '<a href=javascript:dadj('+cast(unit.id as varchar(10))+')>是</a>' end,
case unit.dydw when 0 then '<a href=javascript:dydw('+cast(unit.id as varchar(10))+')><font color=red>斤</a>' else '<a href=javascript:dydw('+cast(unit.id as varchar(10))+')>公斤</a>' end,
case unit.meirsh when 0 then '<a href=javascript:meirsh('+cast(unit.id as varchar(10))+')><font color=red>否</a>' else '<a href=javascript:meirsh('+cast(unit.id as varchar(10))+')>是</a>' end,
unit.weixh,
case unit.yn when 0 then '<a href=javascript:yn('+cast(unit.id as varchar(10))+')><font color=gray>停用</a>' else '<a href=javascript:yn('+cast(unit.id as varchar(10))+')>启用</a>' end 
from sys_unit unit,sys_khfenl fl,sys_khleix jg,sys_khxianl fz where unit.typea=jg.id and unit.typeb=fl.id and unit.typec=fz.id and unit.mode=2 ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."12,0,0,0,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",4%,10%,6%,14%,25%,10%,10%,4%,4%,4%,5%,4%";
}
$_SESSION['mac'].="#".",center,center,center,center,center,center,center,center,center,center,center,center,center";
$_SESSION['mac'].="#".",序,客户分类,编号,客户简称,客户全称,客户线路,客户类型,打单价,打单位,日配送,微信号,状态,改";
$_SESSION['mac'].="#客户资料表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include('./inc/xNoCountdis.php');
$_SESSION['mac']="select 0,0,fl.fenlmc,unit.usercode,unit.shortname,unit.name,fz.fenlmc,jg.fenlmc,case unit.dadj when 0 then '否' else '是' end,case unit.dydw when 0 then '斤' else '公斤' end,case unit.meirsh when 0 then '否' else '是' end,unit.weixh,case unit.yn when 0 then '停用' else '启用' end from sys_unit unit,sys_khfenl fl,sys_khleix jg,sys_khxianl fz where unit.typea=jg.id and unit.typeb=fl.id and unit.typec=fz.id and unit.mode=2 ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."12,0,0,0,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",4%,10%,6%,14%,25%,10%,10%,4%,4%,4%,5%,4%";
$_SESSION['mac'].="#".",center,center,center,center,center,center,center,center,center,center,center,center,center";
$_SESSION['mac'].="#".",序,客户分类,编号,客户简称,客户全称,客户线路,客户类型,打单价,打单位,日配送,微信号,状态";
$_SESSION['mac'].="#客户资料表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
?>
</form>	
</body>
<script language=javascript>
function ed(id)
{	
	window.Frm.scroll.value=document.body.scrollTop;
	//window.Frm.submit();
	layer_show3("修改客户资料","<?php echo $xiam;?>Edit.php?eid="+id,"600","730","parent");//最后一个是给标识符  需要父级打开就给  不然就空
}
function dadj(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.dadj.value=id;
	window.Frm.submit();
}
function dydw(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.dydw.value=id;
	window.Frm.submit();
}
function meirsh(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.meirsh.value=id;
	window.Frm.submit();
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

