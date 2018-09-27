<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
$menuright=menuright(35);
if(isset($_POST['delrow']))
{
	$query="insert into sys_caoz(caozsj,riq,neir,leix) select getdate(),a.jiagrq,'".$_SESSION['xuname']."删除供应商为'+a.unit+'的生产加工数据<b>',3 from sys_jiagsc a where a.id=".$_REQUEST['delrow'];
	sqlsrv_query($conn,$query);

	$query="update sys_bzjiag set lx=-1 where id=".$_REQUEST['delrow'];
	sqlsrv_query($conn,$query);
}
if(isset($_POST['shid']))
{
	$query="update sys_bzjiag set zhuangt=zhuangt^1,shr='".$_SESSION['xuname']."' where id=".$_REQUEST['shid'];
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
$TJ.=" and jg.jiagrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
if(isset($_POST['zt']) and $_POST['zt']!="")
	$TJ.=" and bz.zhuangt=".$_POST['zt'];
if(isset($_POST['setsh']) and $_POST['setsh']!=100)//批量审核,由财务部审核
{
	$query="update sys_bzjiag set zhuangt=".$_POST['setsh'].",shr='".$_SESSION['xuname']."' where id in(select id from sys_jiagsc where lx=1 ".$TJ.")";
	require("inc/xexec.php");
}

if(isset($_POST['paix']) and $_POST['paix']!="")//排序
	$px=$_POST['paix'];
else
	$px="jg.jiagrq desc";
if($menuright==3)
	$shenh="case bz.zhuangt when 0 then '<a href=javascript:sh('+cast(bz.id as varchar(10))+')>待审</a>' else '<a href=javascript:sh('+cast(bz.id as varchar(10))+')><font color=red>已审</font></a>' end";
else
	$shenh="case bz.zhuangt when 0 then '待审' else '<font color=red>已审</font>' end";
$_SESSION['mac']="select bz.id,CONVERT(varchar(10),jg.jiagrq,120),jg.shij,jg.unit,cp.mc,jg.bianzs,jg.bianzz,bz.sl,bz.zl,bz.zhut,bz.zhuj,bz.bany,bz.suiy,cast(jg.bianzz-(bz.zl+bz.zhut+bz.zhuj+bz.bany+bz.suiy) as decimal(10,2)),cast((jg.bianzz-(bz.zl+bz.zhut+bz.zhuj+bz.bany+bz.suiy))/jg.bianzs as decimal(10,2)),bz.bz,".$shenh.",'<a href=javascript:ed('+cast(bz.id as varchar(10))+','+cast(bz.zhuangt as varchar(10))+')><img border=0 src=im/xiug.png alt=修改此行数据></a>','<a href=javascript:del('+cast(bz.id as varchar(10))+','+cast(bz.zhuangt as varchar(10))+')><img border=0 src=im/delete.gif alt=删除此行数据></a>' from sys_bzjiag bz,sys_jiagsc jg,sys_cp cp where jg.lx=1 and bz.lx=1 and bz.jiagscid=jg.id and jg.pinz=cp.id ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."4,0,0,0,0,1,1,1,1,1,1,1,1,1,0,0,0,0";
$_SESSION['mac'].="#".",8%,4%,10%,5%,5%,6%,8%,8%,6%,6%,6%,6%,6%,6%,5%,3%,2%";
$_SESSION['mac'].="#".",center,center,center,center,center,right,center,right,right,right,right,right,right,center,left,center,center";
$_SESSION['mac'].="#".",日期,时间,供应商,品种,边猪数,边猪重,加工边猪数,加工边猪重,猪头,猪脚,板油,碎油,总损耗,头损,备注,状态,改";
$_SESSION['mac'].="#".$_SESSION['DT1']."至".$_SESSION['DT2']."边猪精加工数据";
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
		parent.parent.layer.msg('此边猪精加工数据已审核,不能修改！', {icon:2,time:1500});
	else
	{
		window.Frm.scroll.value=document.body.scrollTop;
		layer_show3("修改边猪精加工数据","<?php echo $xiam;?>Edit.php?id="+id,"450","600","parent");//最后一个是给标识符  需要父级打开就给  不然就空
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



