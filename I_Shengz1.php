<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
$menuright=menuright(25);
if(isset($_REQUEST['delrow']))
{
	$query="update sys_shengz set lx=-1*lx where lx>0 and id=".$_REQUEST['delrow'];
	include("./inc/xexec.php");
}
if(isset($_REQUEST['shid']))
{
	$query="update sys_shengz set zt=zt^1,shr='".$_SESSION['uname']."' where id=".$_REQUEST['shid'];
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
$TJ.=" and sz.daohrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
if(isset($_POST['gysid']) and $_POST['gysid']!="")
	$TJ.=" and sz.unit=".$_POST['gysid'];
if(isset($_POST['zt']) and $_POST['zt']!="")
	$TJ.=" and sz.zt=".$_POST['zt'];
if(isset($_POST['setsh']) and $_POST['setsh']!=100)//�������,�ɲ������
{
	$query="update sys_shengz set zt=".$_POST['setsh'].",shr='".$_SESSION['uname']."' where id in(select id from sys_shengz sz where sz.lx=20 ".$TJ.")";
	require("inc/xexec.php");
}

if(isset($_POST['paix']) and $_POST['paix']!="")//����
	$px=$_POST['paix'];
else
	$px="sz.daohrq desc";
if($menuright>2)
	$shenh="case zt when 0 then '<a href=javascript:sh('+cast(sz.id as varchar(10))+')>����</a>' else '<a href=javascript:sh('+cast(sz.id as varchar(10))+')><font color=red>����</font></a>' end";
else
	$shenh="case zt when 0 then '����' else '<font color=red>����</font>' end";
$_SESSION['mac']="select 0,CONVERT(varchar(10),sz.daohrq,120),unit.shortname,cp.mc,sz.tous,sz.chuczl,sz.daohzl,sz.chucj,sz.danj,sz.yunzf,sz.jine,cast(cast((sz.daohzl-sz.chuczl)/sz.tous as decimal(10,1)) as varchar),sz.cheph+sz.beiz,sz.lury,".$shenh.",'<a href=javascript:dy('+cast(sz.id as varchar(10))+')><img border=0 src=im/day.png title=��ӡë��ɹ���></a>','<a href=javascript:ed('+cast(sz.id as varchar(10))+','+cast(sz.zt as varchar(10))+')><img border=0 src=im/xiug.png alt=�޸Ĵ�������></a>','<a href=javascript:del('+cast(sz.id as varchar(10))+','+cast(sz.zt as varchar(10))+')><img border=0 src=im/shanc.png alt=ɾ����������></a>' from sys_shengz sz,sys_unit unit,sys_cp cp where sz.lx=20 and sz.pinz=cp.id and sz.unit=unit.id ".$TJ." order by ".$px;
if($menuright>2)
{
$_SESSION['mac'].="#"."4,0,0,0,0,1,1,0,0,1,1,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",7%,6%,5%,5%,7%,7%,6%,6%,7%,7%,7%,13%,5%,4%,4%,2%,2%";
}
else
{
$_SESSION['mac'].="#"."4,0,0,0,0,1,1,0,0,1,1,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",7%,6%,5%,5%,7%,7%,6%,6%,7%,7%,7%,13%,5%,4%,4%,2%,2%";
}
$_SESSION['mac'].="#".",center,center,center,center,right,right,right,right,right,right,center,left,center,center,center,center,center";
$_SESSION['mac'].="#".",����,��Ӧ��,Ʒ��,ͷ��,������,������,������,������,���ӷ�,Ӧ�����,·��(��/ͷ),���ƺ�/��ע,�Ƶ���,״̬,��ӡ,��,ɾ";
$_SESSION['mac'].="#".$_SESSION['DT1']."��".$_SESSION['DT2']."����ɹ�����";
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
		parent.parent.layer.msg('���������,��ֹ������', {icon:2,time:1500});
	else
	{
		window.Frm.scroll.value=document.body.scrollTop;
		layer_show3("�޸�ë��ɹ���","<?php echo $xiam;?>Edit.php?id="+id,"450","720","parent");//���һ���Ǹ���ʶ��  ��Ҫ�����򿪾͸�  ��Ȼ�Ϳ�
	}
}
function dy(id)
{
	openwindow('I_ShengzPrint.php?id='+id,700,500);
}
</script>
<script type="text/javascript" defer="defer">setscroll();closeload();</script>



