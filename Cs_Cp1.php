<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query='update sys_cp set yn=yn^1 where id='.$_POST['delrow'];
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
<input type="hidden" name="edtrow" value="0">
<input type="hidden" name="cpflid" value="<?php echo isset($_POST['cpflid'])?$_POST['cpflid']:"";?>">
<input type="hidden" name="cpxlid" value="<?php echo isset($_POST['cpxlid'])?$_POST['cpxlid']:"";?>">
<input type="hidden" name="zhuangt" value="<?php echo isset($_POST['zhuangt'])?$_POST['zhuangt']:"";?>">
<input type="hidden" name="cpid" value="<?php echo isset($_POST['cpid'])?$_POST['cpid']:"";?>">
<input type="hidden" name="cpylid" value="<?php echo isset($_POST['cpylid'])?$_POST['cpylid']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<?php 
$TJ="";
if(isset($_POST['zhuangt']) and $_POST['zhuangt']!="")
	$TJ.=" and cp.yn in(".$_POST['zhuangt'].") ";
if(isset($_POST['cpflid']) and $_POST['cpflid']!="")
	$TJ.=" and cp.typeb in(".$_POST['cpflid'].") ";
if(isset($_POST['cpxlid']) and $_POST['cpxlid']!="")
	$TJ.=" and cp.typec in(".$_POST['cpxlid'].") ";
if(isset($_POST['cpylid']) and $_POST['cpylid']!="")
	$TJ.=" and cp.typea in(".$_POST['cpylid'].") ";
if(isset($_POST['cpid']) and $_POST['cpid']!="")
	$TJ.=" and cp.id in(".$_POST['cpid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and cp.bh+cp.mc+cpfenl.fenlmc+cp.dw like '%".$_POST['cxtj']."%' ";
if(isset($_POST['paix']) and $_POST['paix']!="")//排序
	$px=$_POST['paix'];
else
	$px="cpfenl.bianh,xfl.id,cp.bh";
if(menuright(7)>1)//录入权限
{
$_SESSION['mac']="select 0,0,cpfenl.fenlmc,xfl.fenlmc,cp.bh,cp.mc,cp.dw,cp.gg,cast(cp.huansz as varchar),yfl.fenlmc,case cp.img when null then '&nbsp;' else '<img src=\"upfile\cpimg\'+cp.img+'\" width=50 height=50>' end,left(cp.miaos,20),case cp.yn when 0 then '<a href=javascript:yn('+cast(cp.id as varchar(10))+')><font color=gray>停用</a>' else '<a href=javascript:yn('+cast(cp.id as varchar(10))+')>启用</a>' end,'<a href=javascript:ed('+cast(cp.id as varchar(10))+')><img border=0 src=im/xiug.png alt=修改该产品></a>' from sys_cp cp,sys_cpdfl cpfenl,sys_cpxfl xfl,sys_cpyfl yfl where cp.typea=yfl.id and cp.typec=xfl.id and xfl.typeb=cpfenl.id ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."13,0,0,0,0,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",3%,10%,10%,8%,15%,6%,8%,4%,10%,8%,8%,6%,4%";
}
else//查询权限
{
$_SESSION['mac']="select 0,0,cpfenl.fenlmc,xfl.fenlmc,cp.bh,cp.mc,cp.dw,cp.gg,cast(cp.huansz as varchar),yfl.fenlmc,case cp.img when null then '&nbsp;' else '<img src=\"upfile\cpimg\'+cp.img+'\" width=50 height=50>' end,left(cp.miaos,20),case cp.yn when 0 then '<font color=gray>停用</font>' else '启用' end from sys_cp cp,sys_cpdfl cpfenl,sys_cpxfl xfl,sys_cpyfl yfl where cp.typea=yfl.id and cp.typec=xfl.id and xfl.typeb=cpfenl.id ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."12,0,0,0,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",3%,10%,10%,8%,19%,6%,8%,4%,10%,8%,8%,6%";
}
$_SESSION['mac'].="#".",center,center,center,center,center,center,center,center,center,center,center,center,center";
$_SESSION['mac'].="#".",序,一类,二类,编号,产品名称,单位,规格,换算,生产分类,图片,描述,状态";
$_SESSION['mac'].="#产品资料";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xNoCountdis.php");
$_SESSION['mac']="select 0,0,cpfenl.fenlmc,xfl.fenlmc,cp.bh,cp.mc,cp.dw,cp.gg,cast(cp.huansz as varchar),yfl.fenlmc,case cp.img when null then '&nbsp;' else '<img src=\"upfile\cpimg\'+cp.img+'\" width=50 height=50>' end,left(cp.miaos,20),case cp.yn when 0 then '停用' else '启用' end from sys_cp cp,sys_cpdfl cpfenl,sys_cpxfl xfl,sys_cpyfl yfl where cp.typea=yfl.id and cp.typec=xfl.id and xfl.typeb=cpfenl.id ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."12,0,0,0,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",3%,10%,10%,8%,19%,6%,8%,4%,10%,8%,8%,6%";
$_SESSION['mac'].="#".",center,center,center,center,center,center,center,center,center,center,center,center,center";
$_SESSION['mac'].="#".",序,一类,二类,编号,产品名称,单位,规格,换算,生产分类,图片,描述,状态";
$_SESSION['mac'].="#产品资料";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
?>
</form>	
</body>
<script language=javascript>
function ed(id)
{	
	window.Frm.scroll.value=document.body.scrollTop;
	layer_show3("产品资料--修改产品","<?php echo $xiam;?>Edit.php?eid="+id,"600","500","parent");//最后一个是给标识符  需要父级打开就给  不然就空
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

