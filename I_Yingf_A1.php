<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
$menuright=menuright(14);//取得菜单权限
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
$query="select fukdh from sys_fuksj where id=".$_POST['delrow'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$fukdh=$line[0];

	$query="update sys_fuksj set lx=-1*lx,caozy='".$_SESSION['uname']."' where lx>0 and id=".$_POST['delrow'];
	include("./inc/xexec.php");
	$query="update sys_jhdh set zt=1 where zt=100 and id in(".$fukdh.")";
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
<input type="hidden" name="gysid" value="<?php echo isset($_POST['gysid'])?$_POST['gysid']:"";?>">
<input type="hidden" name="gysflid" value="<?php echo isset($_POST['gysflid'])?$_POST['gysflid']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<input type="hidden" name="dt2" value="<?php echo isset($_POST['dt2'])?$_POST['dt2']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<?php 
$TJ=" ";
if(isset($_POST['dt1']) and $_POST['dt1']!="")
	$TJ.=" and dh.lx in(1,-1) and dh.rq between '".$_POST['dt1']."' and '".$_POST['dt2']."' ";
else
	$TJ.=" and dh.lx in(1,-1) and dh.rq between '".date('Y-m-d')."' and '".date('Y-m-d',strtotime("+1 day"))."' ";
if(isset($_POST['gysflid']) and $_POST['gysflid']!="")
	$TJ.=" and unit.typeb in(".$_POST['gysflid'].") ";
if(isset($_POST['gysid']) and $_POST['gysid']!="")
	$TJ.=" and unit.id in(".$_POST['gysid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and unit.usercode+unit.shortname+dh.dh like '%".$_POST['cxtj']."%' ";
if(isset($_POST['paix']) and $_POST['paix']!="")//排序
	$px=$_POST['paix'];
else
	$px="dh.fukrq desc,dh.gysid";

$macmac="select 0,dh.id,convert(varchar(10),dh.fukrq,120),convert(varchar(10),dh.rq,120),unit.shortname,dh.bz,dh.yingfk,dh.shifk,'<a href=javascript:mx('+cast(dh.id as varchar)+')><img border=0 src=im/menufile.gif alt=付款明细></a>',case dh.lx when 1 then '正常' else '<font color=gray>已作废</font>' end,dh.lury,'<a href=\"JavaScript:del('+cast(dh.id as varchar(10))+',0)\"><img border=0 src=im/shanc.png></a>',dh.caozy from sys_fuksj dh,sys_unit unit where dh.gysid=unit.id ".$TJ." order by ".$px;
$macmac.="#"."1,0,0,0,0,0,0,0,0,0,0,0,0";//1表示单击此行后弹出明细窗口
$macmac.="#".",3%,10%,10%,15%,11%,15%,15%,4%,4%,5%,3%,5%";
$macmac.="#".",center,center,center,center,left,right,right,center,center,center,center,center";
$macmac.="#".",序,付款日期,制单日期,供应商名称,备注,应付款,实付款,明细,状态,制单人,作废,操作员";
$macmac.="#供应商付款单";
$macmac.="#"."5,0,0,0,0,0,1,1,0,0";//1表示单击此行求和
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
	layer_show3('付款单明细','<?php echo $xiam;?>Mx.php?dh_id='+id,'850','700'); //最后一个参数是给一个标识符 
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

