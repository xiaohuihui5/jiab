<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
$menuright=menuright(39);//取得菜单权限
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
<input type="hidden" name="cwflid" value="<?php echo isset($_POST['cwflid'])?$_POST['cwflid']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<input type="hidden" name="dt2" value="<?php echo isset($_POST['dt2'])?$_POST['dt2']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<?php 
$TJ=" ";
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$TJ.=" and dh.lx in(2,3) and dh.zt=1 and dh.dhrq between '".$_POST['dt1']."' and '".$_POST['dt2']."' ";
}
else
	$TJ.=" and dh.lx in(2,3) and dh.zt=1 and dh.dhrq between '".date('Y-m-d')."' and '".date('Y-m-d',strtotime("+1 day"))."' ";
if(isset($_POST['zt']) and $_POST['zt']!="")
	$TJ.=" and dh.zt in(".$_POST['zt'].") ";

if(isset($_POST['cwflid']) and $_POST['cwflid']!="")
	$TJ.=" and unit.typee in(".$_POST['cwflid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and unit.usercode+unit.shortname+dh.dh like '%".$_POST['cxtj']."%' ";
if(isset($_POST['paix']) and $_POST['paix']!="")//排序
	$px=$_POST['paix'];
else
	$px="x.shortname,x.dhrq";

$macmac="select x.id,0,x.dh,'<input style=\"zoom:50%;\" id=id'+cast(Row_Number()over(order by x.id) as varchar(10))+' value=\"'+cast(x.id as varchar(10))+'\" type=checkbox> ',x.shortname,x.bz,x.dhrq,
cast(case when y.shisje=0 then null else y.shisje end as varchar),x.shr from (select dh.bz,dh.shr,dh.id,dh.dh,unit.shortname,CONVERT(varchar(10),dh.dhrq,120) as dhrq 
from sys_jhdh dh,sys_unit unit where dh.unit=unit.id ".$TJ.") x left join
(select sj.dhid,sum(-1*dh.zf*shisje) as shisje from sys_jhdh dh,sys_jhsj sj,sys_unit unit where dh.id=sj.dhid and dh.unit=unit.id ".$TJ." group by sj.dhid)y on x.id=y.dhid 
order by ".$px;
$macmac.="#"."1,1,1,0,1,1,1,1,1";//1表示单击此行后弹出明细窗口
$macmac.="#".",4%,18%,3%,16%,18%,9%,18%,14%";
$macmac.="#".",center,center,center,left,left,center,right,center";
$macmac.="#".",序,单号,,客户名称,备注,日期,实收金额,审核人";
$macmac.="#销售订单表";
$macmac.="#"."6,0,0,0,0,0,0,1,1,1,1,0";//1表示单击此行求和
$macmac.="#";
include("./inc/xNoCountdis2.php");//录入页面带求和
?>
<input name="count" id="count" value="<?php echo $row;?>" type="hidden">
</form>	
</body>
<script language=javascript>
function mx(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	openwindow('<?php echo $xiam;?>Mx.php?dhid='+id,1280,768);
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

