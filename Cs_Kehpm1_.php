<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query='delete from sys_khpm where id='.$_POST['delrow'];
	include('./inc/xexec.php');
}
if(isset($_POST['edtrow']) and $_POST['edtrow']!=0)
{
	$query='delete from sys_khpm where khid='.$_POST['edtrow'];
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
<input type="hidden" name="khid" value="<?php echo isset($_POST['khid'])?$_POST['khid']:"";?>">
<input type="hidden" name="cpid" value="<?php echo isset($_POST['cpid'])?$_POST['cpid']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<?php 
$TJ="";
if(isset($_POST['khid']) and $_POST['khid']!="")
	$TJ.=" and khpm.flid in(".$_POST['khid'].") ";
if(isset($_POST['cpid']) and $_POST['cpid']!="")
	$TJ.=" and khpm.cpid in(".$_POST['cpid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and (khpm.bh+khpm.mc+cp.bh+cp.mc like '%".$_POST['cxtj']."%') ";
if(menuright(12)>1)//录入权限
{
$_SESSION['mac']="select 0,0,'<a href=javascript:khdel('+cast(khfenl.id as varchar(10))+')>'+khfenl.fenlmc+'</a>',khpm.bh,khpm.mc,khpm.basecode,khpm.huans,khpm.dw,khpm.gg,cp.bh,cp.mc,cp.dw,cp.gg,
'<a href=javascript:ed('+cast(khpm.id as varchar(10))+')><img border=0 src=im/xiug.png alt=修改></a>','<a href=javascript:del('+cast(khpm.id as varchar(10))+',0)><img border=0 src=im/shanc.png alt=删除此单></a>' from sys_khpm khpm,sys_khfenl khfenl,sys_cp cp,sys_cpxfl fl where fl.id=cp.typec and khfenl.id=khpm.flid and khpm.cpid=cp.id ".$TJ." order by khpm.flid,fl.bianh";
$_SESSION['mac'].="#"."13,0,0,0,0,0,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",5%,8%,8%,10%,10%,6%,6%,8%,8%,9%,6%,8%,4%,4%";
}
else//查询权限
{
$_SESSION['mac']="select 0,0,khfenl.fenlmc,khpm.bh,khpm.mc,khpm.basecode,khpm.huans,khpm.dw,khpm.gg,cp.bh,cp.mc,cp.dw,cp.gg from sys_khpm khpm,sys_khfenl khfenl,sys_cp cp,sys_cpxfl fl where fl.id=cp.typec and khpm.flid=khfenl.id and khpm.cpid=cp.id ".$TJ." order by khpm.flid,fl.bianh";
$_SESSION['mac'].="#"."12,0,0,0,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",5%,9%,9%,10%,8%,4%,10%,8%,10%,12%,8%,8%";
}
$_SESSION['mac'].="#".",center,center,center,center,center,center,center,center,center,center,center,center";
$_SESSION['mac'].="#".",序,客户名称,客户编号,客户品名,单位,规格,公司编号,公司产品,单位,规格,删";
$_SESSION['mac'].="#客户产品资料";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xNoCountdis.php");
//}
//else
//echo "<script language=javascript>layer.msg('请选择客户',{icon:2,time:9999});</script>";
?>
</form>	
</body>
<script language=javascript>
function khdel(id)
{
		parent.parent.layer.confirm('您确定要删除此客户产品吗?',
		{
			btn:["确定","取消"],
			shade:0.2,
			yes:function()
			{
				window.Frm.scroll.value=document.body.scrollTop;
				window.Frm.edtrow.value=id;
				window.Frm.submit();
			},
			btn2:function()
			{
				parent.parent.layer.msg('用户中途取消,此次操作失败!', {icon:2,time:1500});
			}

		}
		);
}
function ed(id)
{	
	window.Frm.scroll.value=document.body.scrollTop;
	layer_show3("客户品名--修改","<?php echo $xiam;?>Edit.php?eid="+id,"600","600","parent");//最后一个是给标识符  需要父级打开就给  不然就空
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

