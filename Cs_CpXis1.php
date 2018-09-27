<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
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
<input type="hidden" name="cpid" value="<?php echo isset($_POST['cpid'])?$_POST['cpid']:"";?>">
<input type="hidden" name="cpylid" value="<?php echo isset($_POST['cpylid'])?$_POST['cpylid']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<?php 
$TJ=" and cpfenl.bil>0";
if(isset($_POST['cpylid']) and $_POST['cpylid']!="")
	$TJ.=" and cp.typea in(".$_POST['cpylid'].") ";
if(isset($_POST['cpid']) and $_POST['cpid']!="")
	$TJ.=" and cp.id in(".$_POST['cpid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and cp.bh+cp.mc+cpfenl.fenlmc+cp.dw like '%".$_POST['cxtj']."%' ";
if(isset($_POST['paix']) and $_POST['paix']!="")//排序
	$px=$_POST['paix'];
else
	$px="cpfenl.bianh,cp.bh";
if(menuright(7)>1)//录入权限
{
$_SESSION['mac']="select 0,0,cpfenl.fenlmc,cp.bh,cp.mc,cp.dw,cp.gg,cast(cp.xis as varchar),'<a href=javascript:ed('+cast(cp.id as varchar(10))+')><img border=0 src=im/xiug.png alt=修改该产品加工系数></a>' from sys_cp cp,sys_cpyfl cpfenl where cp.typea=cpfenl.id ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."8,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",5%,20%,10%,20%,10%,10%,20%,5%";
}
else//查询权限
{
$_SESSION['mac']="select 0,0,cpfenl.fenlmc,cp.bh,cp.mc,cp.dw,cp.gg,cast(cp.xis as varchar) from sys_cp cp,sys_cpyfl cpfenl where cp.typea=cpfenl.id ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."7,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",5%,20%,10%,20%,10%,10%,25%";
}
$_SESSION['mac'].="#".",center,center,center,center,center,center,center,center";
$_SESSION['mac'].="#".",序,生产分类,编号,产品名称,单位,规格,加工系数,改";
$_SESSION['mac'].="#产品加工系数表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xNoCountdis.php");
?>
</form>	
</body>

<script language=javascript>
function ed(id)
{	
	window.Frm.scroll.value=document.body.scrollTop;
	layer_show3("产品资料--修改产品加工系数","<?php echo $xiam;?>Edit.php?eid="+id,"600","500","parent");//最后一个是给标识符  需要父级打开就给  不然就空
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

