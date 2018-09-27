<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query="update sys_maozdh set lx=-1*lx where lx>0 and id=".$_POST['delrow'];
	include("./inc/xexec.php");
}
if(isset($_POST['shid']) and $_POST['shid']!=0)
{
	$query="update sys_maozdh set zt=case zt when 1 then 0 else 1 end,shr='".$_SESSION['uname']."' where id=".$_POST['shid'];
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
<input type="hidden" name="khid" value="<?php echo isset($_POST['khid'])?$_POST['khid']:"";?>">
<input type="hidden" name="khflid" value="<?php echo isset($_POST['khflid'])?$_POST['khflid']:"";?>">
<input type="hidden" name="khxlid" value="<?php echo isset($_POST['khxlid'])?$_POST['khxlid']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<input type="hidden" name="dt2" value="<?php echo isset($_POST['dt2'])?$_POST['dt2']:"";?>">
<?php 
$TJ=" ";
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$TJ.=" and dh.lx=9 and dh.dhrq between '".$_POST['dt1']."' and '".$_POST['dt2']."' ";
}
else
	$TJ.=" and dh.lx=9 and dh.dhrq between '".date('Y-m-d')."' and '".date('Y-m-d',strtotime("+1 day"))."' ";
if(isset($_POST['zt']) and $_POST['zt']!="")
	$TJ.=" and dh.zt in(".$_POST['zt'].") ";

if(isset($_POST['khflid']) and $_POST['khflid']!="")
	$TJ.=" and unit.flid in(".$_POST['khflid'].") ";
if(isset($_POST['khid']) and $_POST['khid']!="")
	$TJ.=" and unit.id in(".$_POST['khid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and unit.shortname+dh.dh like '%".$_POST['cxtj']."%' ";
if(isset($_POST['paix']) and $_POST['paix']!="")//排序
	$px=$_POST['paix'];
else
	$px="x.dhrq desc,x.shortname";

$menuright=menuright(25);//取得菜单权限
if($menuright>1)//审核
	$shenh="case dh.zt when 0 then '<a href=javascript:sh('+cast(dh.id as varchar(10))+')>未审' when 1 then '<a href=javascript:sh('+cast(dh.id as varchar(10))+')><font color=red>已审</font></font>' when 9 then '<a href=javascript:sh('+cast(dh.id as varchar(10))+')><font color=blue>已打</font></font>'  end as zt";
else
	$shenh="case dh.zt when 1 then '<font color=red>已审</font>' when 9 then '<font color=blue>已打</font>' else '未审' end as zt";

$macmac="select x.id,0,x.fenlmc,x.dh,x.shortname,x.bz,x.dhrq,y.sl,y.songhl,x.zzl,y.shisje,x.yunf,y.songhl-x.zzl,cast((y.songhl-x.zzl)/y.sl as decimal(10,2)),x.koush,y.shisje+isnull(x.yunf,0)-isnull(x.koush,0),x.lury,x.zt,x.xg,x.sc from 
(select gs.fenlmc,dh.yunf,dh.bz,dh.lury,dh.id,dh.dh,unit.shortname,CONVERT(varchar(10),dh.dhrq,120) as dhrq,".$shenh.",dh.zzl,dh.koush,
'<a href=\"javascript:ed('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')\"><img border=0 src=im/xiug.png></a>' as xg,
'<a href=\"JavaScript:del('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')\"><img border=0 src=im/shanc.png></a>' as sc 
from sys_maozdh dh,sys_unit unit,sys_maozfd gs where dh.gongsid=gs.id and dh.gysid=unit.id ".$TJ.") x left join
(select sj.dhid,sum(sl)as sl,sum(songhl)as songhl,sum(shisje) as shisje,sum(feiy) as feiy from sys_maozdh dh,sys_maozsj sj,sys_unit unit where dh.id=sj.dhid and dh.gysid=unit.id ".$TJ." group by sj.dhid)y on x.id=y.dhid 
order by ".$px;
if($menuright>0)//录入权限
{
$macmac.="#"."19,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0";//1表示单击此行后弹出明细窗口
$macmac.="#".",3%,6%,7%,8%,5%,6%,5%,7%,7%,7%,5%,5%,5%,6%,7%,4%,3%,2%,2%";
}
else
{
$macmac.="#"."17,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1";//1表示单击此行后弹出明细窗口
$macmac.="#".",3%,6%,7%,8%,8%,7%,5%,7%,7%,7%,5%,5%,5%,6%,7%,4%,3%";
}
$macmac.="#".",center,center,center,left,left,center,center,center,center,center,center,center,center,center,center,center,center,center,center";
$macmac.="#".",序,分点,单号,供应商名称,备注,采购日期,头数,场外重/斤,回场重/斤,金额,运费,总损耗,头均损耗,扣损耗/元,应付猪款,制单,状态,改,删";
$macmac.="#商品猪采购表";
$macmac.="#"."5,0,0,0,0,0,1,1,1,1,1,1,1,0,1,0,0,0,0";//1表示单击此行求和
$macmac.="#";
include("./inc/xNoCountdis2.php");//录入页面带求和
?>
</form>	
</body>
<script language=javascript>
function mx(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	openwindow('<?php echo $xiam;?>Mx.php?dhid='+id,1024,780);
}
function ed(id,zt)
{	
	if(zt==1)
		parent.parent.layer.msg('单据已审核,禁止操作！', {icon:2,time:1500});
	else
	{
		window.Frm.scroll.value=document.body.scrollTop;
		layer_show3("修改毛猪采购单","<?php echo $xiam;?>Edit.php?dhid="+id,"500","500","parent");//最后一个是给标识符  需要父级打开就给  不然就空
	}
}
function copy(id)
{	
	window.Frm.scroll.value=document.body.scrollTop;
	layer_show3("复制客户订单","<?php echo $xiam;?>Copy.php?dhid="+id,"500","500","parent");//最后一个是给标识符  需要父级打开就给  不然就空
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

