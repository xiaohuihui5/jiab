<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
$menuright=menuright(73);//ȡ�ò˵�Ȩ��
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query="update sys_jhdh set lx=-1*lx where lx>0 and id=".$_POST['delrow'];
	include("./inc/xexec.php");
}
if(isset($_POST['shid']) and $_POST['shid']!=0)
{
	$query="update sys_jhdh set zt=case zt when 1 then 0 else 1 end,shr='".$_SESSION['uname']."' where id=".$_POST['shid'];
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
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<input type="hidden" name="dt2" value="<?php echo isset($_POST['dt2'])?$_POST['dt2']:"";?>">
<?php 
$TJ=" ";
if(isset($_POST['dt1']) and $_POST['dt1']!="")
	$TJ.=" and dh.lx=1 and dh.dhrq between '".$_POST['dt1']."' and '".$_POST['dt2']."' ";
else
	$TJ.=" and dh.lx=1 and dh.dhrq between '".date('Y-m-d')."' and '".date('Y-m-d',strtotime("+1 day"))."' ";
if(isset($_POST['zt']) and $_POST['zt']!="")
	$TJ.=" and dh.zt in(".$_POST['zt'].") ";

if(isset($_POST['gysid']) and $_POST['gysid']!="")
	$TJ.=" and unit.id in(".$_POST['gysid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and unit.usercode+unit.shortname+dh.dh like '%".$_POST['cxtj']."%' ";
if(isset($_POST['paix']) and $_POST['paix']!="")//����
	$px=$_POST['paix'];
else
	$px="x.dhrq desc,x.usercode,x.shortname";
if(isset($_POST['setsh']) and $_POST['setsh']!=100)//�������,�ɲ������
{
	$query="update sys_jhdh set zt=".$_POST['setsh'].",shr='".$_SESSION['uname']."' where id in(select dh.id from sys_jhdh dh,sys_unit unit where dh.lx=1 and dh.unit=unit.id ".$TJ.")";
	require("inc/xexec.php");
}
if($menuright>2)//���
	$shenh="case dh.zt when 0 then '<a href=javascript:sh('+cast(dh.id as varchar(10))+')>δ��' when 1 then '<a href=javascript:sh('+cast(dh.id as varchar(10))+')><font color=red>����</font></font>' when 9 then '<a href=javascript:sh('+cast(dh.id as varchar(10))+')><font color=blue>�Ѵ�</font></font>'  end as zt";
else
	$shenh="case dh.zt when 1 then '<font color=red>����</font>' when 9 then '<font color=blue>�Ѵ�</font>' else 'δ��' end as zt";
$macmac="select x.id,0,x.dh,x.usercode+x.shortname,x.bz,x.dhrq,cast(y.dinghl as varchar),y.songhl,y.shisl,case y.shisl-y.songhl when 0 then null else cast(y.shisl-y.songhl as varchar) end,cast(y.shisje as varchar),x.lury,x.zt,x.fz,x.xg,x.sc from 
(select dh.bz,dh.lury,dh.id,dh.dh,unit.usercode,unit.shortname,CONVERT(varchar(10),dh.dhrq,120) as dhrq,".$shenh.",
'<a href=\"javascript:copy('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')\"><img border=0 src=im/copy.png></a>' as fz,
'<a href=\"javascript:ed('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')\"><img border=0 src=im/xiug.png></a>' as xg,
'<a href=\"JavaScript:del('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')\"><img border=0 src=im/shanc.png></a>' as sc 
from sys_jhdh dh,sys_unit unit where dh.unit=unit.id ".$TJ.") x left join
(select sj.dhid,sum(dinghl)as dinghl,sum(songhl)as songhl,sum(shisl) as shisl,sum(shisje) as shisje from sys_jhdh dh,sys_jhsj sj,sys_unit unit where dh.id=sj.dhid and dh.unit=unit.id ".$TJ." group by sj.dhid)y on x.id=y.dhid 
order by ".$px;
if($menuright>1)//¼��Ȩ��
{
$macmac.="#"."1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0";//1��ʾ�������к󵯳���ϸ����
$macmac.="#".",4%,10%,16%,16%,9%,6%,6%,6%,4%,6%,5%,3%,3%,3%,3%";
}
else
{
$macmac.="#"."1,1,1,1,1,1,1,1,1,1,1,1,1,1";//1��ʾ�������к󵯳���ϸ����
$macmac.="#".",4%,10%,16%,16%,9%,6%,6%,6%,4%,6%,11%,6%";
}
$macmac.="#".",center,center,left,left,center,center,right,right,right,right,right,center,center,center,center";
$macmac.="#".",��,����,��Ӧ������,��ע,��������,������,������,ʵ����,����,ʵ�ս��,�Ƶ���,״̬,��,��,ɾ";
$macmac.="#�ɹ������б�";
$macmac.="#"."5,0,0,0,0,0,1,1,1,1,1,0,0,0,0,0";//1��ʾ�����������
$macmac.="#";
include("./inc/xNoCountdis2.php");//¼��ҳ������
?>
</form>	
</body>
<script language=javascript>
function mx(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	openwindow('<?php echo $xiam;?>Mx.php?dhid='+id,1280,768);

//alert(id);
}
function ed(id,zt)
{	
	if(zt==1)
		parent.parent.layer.msg('���������,��ֹ������', {icon:2,time:1500});
	else
	{
		window.Frm.scroll.value=document.body.scrollTop;
		layer_show3("�޸Ĳɹ�����","<?php echo $xiam;?>Edit.php?dhid="+id,"500","500","parent");//���һ���Ǹ���ʶ��  ��Ҫ�����򿪾͸�  ��Ȼ�Ϳ�
	}
}
function copy(id)
{	
	window.Frm.scroll.value=document.body.scrollTop;
	layer_show3("���Ʋɹ�����","<?php echo $xiam;?>Copy.php?dhid="+id,"500","500","parent");//���һ���Ǹ���ʶ��  ��Ҫ�����򿪾͸�  ��Ȼ�Ϳ�
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

