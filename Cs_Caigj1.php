<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query="update sys_selljg set lx=-1*lx where lx>0 and id=".$_POST['delrow'];
	include("./inc/xexec.php");
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;if(nKeyCode==120) {parent.Add();}}</script>
</head>
<body >
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="delrow" value="0">
<input type="hidden" name="edtrow" value="0">
<input type="hidden" name="shid" value="0">
<input type="hidden" name="gysid" value="<?php echo isset($_POST['gysid'])?$_POST['gysid']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<?php 
$TJ=" and a.lx=26 ";
if(isset($_POST['gysid']) and $_POST['gysid']!="")
	$TJ.=" and gys.id in(".$_POST['gysid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and gys.usercode+gys.shortname+isnull(gys.linkman,'') like '%".$_POST['cxtj']."%' ";
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$_SESSION['DT1']=$_POST['dt1'];
	$_SESSION['DT2']=$_POST['dt2'];
	$TJ.=" and '".$_POST['dt1']."'<=erq and '".$_POST['dt2']."'>=brq ";
}
if(isset($_POST['paix']) and $_POST['paix']!="")//排序
	$px=$_POST['paix'];
else
	$px="gys.shortname,a.dh";

$menuright=menuright(11);//取得菜单权限
$macmac="select a.id,0,a.dh,CONVERT(varchar(10),a.dhrq,120),gys.shortname,CONVERT(varchar(10),a.brq,120),CONVERT(varchar(10),a.erq,120),a.lury,a.beiz,'',
'<a href=javascript:cp('+cast(a.id as varchar(10))+')><img border=0 src=im/copy.png alt=复制此单></a>',
'<a href=javascript:ed('+cast(a.id as varchar(10))+')><img border=0 src=im/xiug.png alt=修改此单></a>' as xg,
'<a href=javascript:del('+cast(a.id as varchar(10))+')><img border=0 src=im/shanc.png alt=删除此单></a>' as sc
 from sys_selljg a,sys_unit gys where gys.id=a.unitid ".$TJ." order by ".$px;
if($menuright>1)//录入权限
{
$macmac.="#"."9,1,1,1,1,1,1,1,1,0,0,0,0";//此处1表示单击此行后弹出编辑明细窗口
$macmac.="#".",4%,11%,10%,20%,10%,10%,6%,10%,6%,5%,4%,4%";
}
else
{
$macmac.="#"."8,1,1,1,1,1,1,1,1";//此处1表示单击此行后弹出编辑明细窗口
$macmac.="#".",4%,15%,10%,21%,15%,15%,10%,10%";
}
$macmac.="#".",center,center,center,left,center,center,center,center,center,center,center,center";
$macmac.="#".",序,单号,制单日期,供应商名称,起始日期,结束日期,制单,备注,状态,复制新单,修改,删除";
$macmac.="#供应商报价表";
$macmac.="#";
$macmac.="#";
include("./inc/xNoCountOneRowOpen.php");
?>
</form>	
</body>
<script language=javascript>
function mx(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	openwindow2('<?php echo $xiam;?>Mx.php?dhid='+id,1200,768);
}
function ed(id)
{	
	window.Frm.scroll.value=document.body.scrollTop;
	layer_show3("供应商采购价修改","<?php echo $xiam;?>Edit.php?dhid="+id,"400","400","parent");//最后一个是给标识符  需要父级打开就给  不然就空
}
function cp(id)
{	
	window.Frm.scroll.value=document.body.scrollTop;
	layer_show3("复制供应商采购价","<?php echo $xiam;?>Copy.php?dhid="+id,"400","400","parent");//最后一个是给标识符  需要父级打开就给  不然就空
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

