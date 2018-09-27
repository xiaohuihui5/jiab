<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query='update sys_unit set yn=yn^1 where id='.$_POST['delrow'];
	include('./inc/xexec.php');
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
<input type="hidden" name="delrow" value="0">
<input type="hidden" name="dis" value="0">
<input type="hidden" name="edtrow" value="0">
<input type="hidden" name="gysid" value="<?php echo isset($_POST['gysid'])?$_POST['gysid']:"";?>">
<input type="hidden" name="cpid" value="<?php echo isset($_POST['cpid'])?$_POST['cpid']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<?php 
$TJ="";
if(isset($_POST['gysid']) and $_POST['gysid']!="")
	$TJ.=" and gys.id in(".$_POST['gysid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and gys.usercode+gys.shortname+isnull(gys.linkman,'') like '%".$_POST['cxtj']."%' ";
if(isset($_POST['paix']) and $_POST['paix']!="")//排序
	$px=$_POST['paix'];
else
	$px="fl.fenlmc,gys.usercode";

if(menuright(9)>1)//录入权限
{
$_SESSION['mac']="select 0,0,fl.fenlmc,gys.usercode,gys.shortname,gys.linkman,gys.phone,gys.address,case gys.typea when 1 then '<font color=blue>现金</font>' else '月结' end,
case gys.yn when 0 then '<a href=javascript:yn('+cast(gys.id as varchar(10))+')><font color=gray>停用</a>' else '<a href=javascript:yn('+cast(gys.id as varchar(10))+')>启用</a>' end,
'<a href=javascript:ed('+cast(gys.id as varchar(10))+')><img border=0 src=im/xiug.png alt=修改此单></a>' from sys_unit gys,sys_gysfenl fl where gys.mode=1 and gys.typeb=fl.id ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."10,0,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",4%,10%,6%,14%,8%,8%,38%,4%,4%,4%";
}
else
{
$_SESSION['mac']="select 0,0,fl.fenlmc,gys.usercode,gys.shortname,gys.linkman,gys.phone,gys.address,case gys.typea when 1 then '<font color=blue>现金</font>' else '月结' end,case gys.yn when 0 then '<font color=red>已停' else '在用' end from sys_unit gys,sys_gysfenl fl where gys.mode=1 and fl.id=gys.typeb ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."9,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",4%,10%,6%,14%,8%,8%,42%,4%,4%";
}
$_SESSION['mac'].="#".",center,center,center,center,center,center,center,center,center,center";
$_SESSION['mac'].="#".",序,分类,编号,供应商名称,联系人,电话,地址,结算,状态,改";
$_SESSION['mac'].="#"."供应商资料";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xNoCountdis.php");
$_SESSION['mac']="select 0,0,fl.fenlmc,gys.usercode,gys.shortname,gys.linkman,gys.phone,gys.address,case gys.typea when 1 then '现金' else '月结' end,case gys.yn when 0 then '已停' else '在用' end from sys_unit gys,sys_gysfenl fl where gys.mode=1 and fl.id=gys.typeb ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."9,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",4%,10%,6%,14%,8%,8%,42%,4%,4%";
$_SESSION['mac'].="#".",center,center,center,center,center,center,center,center,center,center";
$_SESSION['mac'].="#".",序,分类,编号,供应商名称,联系人,电话,地址,结算,状态,改";
$_SESSION['mac'].="#"."供应商资料";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
?>
</form>	
</body>
<script language=javascript>
function ed(id)
{	
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.submit();
	layer_show3("修改供应商","<?php echo $xiam;?>Edit.php?eid="+id,"700","600","parent");//最后一个是给标识符  需要父级打开就给  不然就空
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>
