<?php 
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if (isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query="update sys_shengz set lx=-1*lx where id=".$_POST['delrow'];
	require("./inc/xexec.php");
}
if(isset($_POST['shid']) and $_POST['shid']!=0)
{
	$query="update sys_shengz set zt=case zt when 1 then 0 else 1 end,shr='".$_SESSION['uname']."' where id=".$_POST['shid'];
	include("./inc/xexec.php");
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
<input type="hidden" name="khid" value="<?php echo isset($_POST['khid'])?$_POST['khid']:"";?>">
<input type="hidden" name="zhuz" value="<?php echo isset($_POST['zhuz'])?$_POST['zhuz']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<input type="hidden" name="dt2" value="<?php echo isset($_POST['dt2'])?$_POST['dt2']:"";?>">
<?php 
if(isset($_POST['dt1']) and $_POST['dt1']!="")//此处不保存$_SESSION['DT1']是为了不影响新增单的日期
{
	$_SESSION['DT1']=$_POST['dt1'];
	$_SESSION['DT2']=$_POST['dt2'];
	$TJ=" and dh.lx=20 and dh.dhrq between '".$_POST['dt1']."' and '".$_POST['dt2']."' ";
}
else
	$TJ=" and dh.lx=20 and dh.dhrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
if(isset($_POST['khid']) and $_POST['khid']!="")
	$TJ.=" and unit.id in(".$_POST['khid'].") ";
if(isset($_POST['zhuz']) and $_POST['zhuz']!="")
	$TJ.=" and dh.pinz='".$_POST['zhuz']."' ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and unit.shortname+dh.dh+dh.lury like '%".$_POST['cxtj']."%' ";
if(isset($_POST['setsh']) and $_POST['setsh']!=100)//批量审核
{
	$query="update sys_shengz set zt=".$_POST['setsh'].",shr='".$_SESSION['uname']."' where id in(select dh.id from sys_shengz dh,sys_unit unit where dh.unit=unit.id and dh.lx=20 ".$TJ.")";
	require("inc/xexec.php");
}
if(isset($_POST['paix']) and $_POST['paix']!="") $px=$_POST['paix']; else $px="dh.dhrq desc,dh.id";
$menuright=menuright(78);//取得菜单权限
if($menuright==3)
{
	$_SESSION['mac']="select dh.id,gs.fenlmc,CONVERT(varchar(10),dh.dhrq,120) as dhrq,unit.shortname,dh.dh,cp.mc,dh.tous,dh.daohzl,dh.chucj,dh.jine,dh.yunzf,dh.ssje,dh.beiz,dh.lury,case dh.zt when 0 then '<a href=javascript:sh('+cast(dh.id as varchar(10))+')>未审</a>' when 1 then '<a href=javascript:sh('+cast(dh.id as varchar(10))+')><font color=red>已审核</font></a>' end as zt,'<a href=javascript:ed('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')><img border=0 src=im/xiug.png alt=修改此单></a>' as xg,'<a href=javascript:del('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')><img border=0 src=im/shanc.png alt=删除此单></a>' as sc from sys_shengz dh,sys_unit unit,sys_cp cp,sys_maozfd gs where dh.gongsid=gs.id and dh.pinz=cp.id and dh.unit=unit.id ".$TJ." order by ".$px;
	$_SESSION['mac'].="#"."5,0,0,0,0,0,1,1,0,1,1,1,0,0,0,0,0";//1表示单击此行后弹出明细窗口
	$_SESSION['mac'].="#".",6%,7%,8%,7%,6%,8%,8%,8%,8%,6%,8%,8%,4%,4%,2%,2%";
}
else
{
	$_SESSION['mac']="select dh.id,gs.fenlmc,CONVERT(varchar(10),dh.dhrq,120) as dhrq,unit.shortname,dh.dh,cp.mc,dh.tous,dh.daohzl,dh.chucj,dh.jine,dh.yunzf,dh.ssje,dh.beiz,dh.lury,case dh.zt when 0 then '未审' when 1 then '<font color=red>已审核</font>' end as zt,'<a href=javascript:ed('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')><img border=0 src=im/xiug.png alt=修改此单></a>' as xg,'<a href=javascript:del('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')><img border=0 src=im/shanc.png alt=删除此单></a>' as sc from sys_shengz dh,sys_unit unit,sys_cp cp,sys_maozfd gs where dh.gongsid=gs.id and dh.pinz=cp.id and dh.unit=unit.id ".$TJ." order by ".$px;
	$_SESSION['mac'].="#"."5,0,0,0,0,0,1,1,0,1,1,1,0,0,0,0,0";//1表示单击此行后弹出明细窗口
	$_SESSION['mac'].="#".",6%,7%,8%,7%,6%,8%,8%,8%,8%,6%,8%,8%,4%,4%,2%,2%";
}
$_SESSION['mac'].="#".",center,center,center,center,right,right,right,right,center,right,center,center,center,center,center";
$_SESSION['mac'].="#".",日期,客户,单号,猪种,头数,重量,单价,销售金额,费用,实收金额,备注,制单,状态,改,删";
$_SESSION['mac'].="#边猪销售单";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
require("./inc/xdis2.php");
?>
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
		parent.parent.layer.msg('单据已审核,禁止操作！', {icon:2,time:1500});
	else
	{
		window.Frm.scroll.value=document.body.scrollTop;
		layer_show3("修改毛猪销售单","<?php echo $xiam;?>Edit.php?id="+id,"450","720","parent");//最后一个是给标识符  需要父级打开就给  不然就空
	}
}
function dy(id)
{
	openwindow('I_ShengzSellPrint.php?id='+id,700,500);
}
</script>
<script type="text/javascript" defer="defer">setscroll();closeload();</script>
