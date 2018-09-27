<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
$menuright=menuright(35);
if(isset($_POST['shid']))
{
	$query="update sys_jiagsc set fgzt=fgzt^1,fgshr='".$_SESSION['xuname']."' where id=".$_REQUEST['shid'];
	sqlsrv_query($conn,$query);
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js?i=2"></script>
</head>
<body>
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="delrow" value="0">
<input type="hidden" name="edtrow" value="0">
<input type="hidden" name="shid" value="0">
<input type="hidden" name="selid" value="">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<input type="hidden" name="dt2" value="<?php echo isset($_POST['dt2'])?$_POST['dt2']:"";?>">
<input type="hidden" name="zt" value="<?php echo isset($_POST['zt'])?$_POST['zt']:"";?>">
<?php 
$TJ="";
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$_SESSION['DT1']=$_POST['dt1'];
	$_SESSION['DT2']=$_POST['dt2'];
}
$TJ.=" and jiagrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
if(isset($_POST['zt']) and $_POST['zt']!="")
	$TJ.=" and fgzt=".$_POST['zt'];
if(isset($_POST['setsh']) and $_POST['setsh']!=100)//批量审核,由财务部审核
{
	$query="update sys_jiagsc set fgzt=".$_POST['setsh'].",fgshr='".$_SESSION['xuname']."' where id>0 ".$TJ;
	require("inc/xexec.php");
}

if(isset($_POST['paix']) and $_POST['paix']!="")//排序
	$px=$_POST['paix'];
else
	$px="jiagrq desc";
if($menuright==3)
	$shenh="case fgzt when 0 then '<a href=javascript:sh('+cast(jg.id as varchar(10))+')>待审</a>' else '<a href=javascript:sh('+cast(jg.id as varchar(10))+')><font color=red>已审</font></a>' end";
else
	$shenh="case fgzt when 0 then '待审' else '<font color=red>已审</font>' end";
$_SESSION['mac']="select jg.id,CONVERT(varchar(10),jiagrq,120),shij,unit,cp.mc,fgbianzs,fgbianzz,daietg,suiy,bany,bz,".$shenh.",'<a href=javascript:ed('+cast(jg.id as varchar(10))+','+cast(jg.fgzt as varchar(10))+')><img border=0 src=im/xiug.png alt=修改此行数据></a>' from sys_jiagsc jg,sys_cp cp where jg.lx=1 and jg.pinz=cp.id and jg.fgzt is not null ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."4,0,0,0,0,1,1,1,1,1,0,0,0";
$_SESSION['mac'].="#".",8%,4%,15%,6%,10%,10%,9%,9%,9%,12%,6%,2%";
$_SESSION['mac'].="#".",center,center,left,center,right,right,right,right,right,left,center,center";
$_SESSION['mac'].="#".",日期,时间,供应商,品种,分割边猪数,分割边猪重,带耳头骨,碎油,板油,备注,状态,改";
$_SESSION['mac'].="#".$_SESSION['DT1']."至".$_SESSION['DT2']."分割精加工数据";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xdis.php");
?>
</form>
</body>
<script language=javascript>
function sh(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.shid.value=id;
	window.Frm.submit();
}
function ed(id,zt)
{	
	if(zt==1)
		parent.parent.layer.msg('此分割精加工数据已审核,不能修改！', {icon:2,time:1500});
	else
	{
		window.Frm.scroll.value=document.body.scrollTop;
		layer_show3("修改分割精加工数据","<?php echo $xiam;?>Edit.php?id="+id,"450","600","parent");//最后一个是给标识符  需要父级打开就给  不然就空
	}
}
function dis(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.selid.value=id;
	window.Frm.submit();
}
</script>
<script type="text/javascript" defer="defer">setscroll();closeload();</script>



