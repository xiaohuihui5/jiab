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
<STYLE type=text/css>
body{font-family:"΢���ź�";}
#th{width:100%;border:0px solid #ccc;}
.cl{float:right;margin-right:18px;width:100%;text-align:right;}
.ss{width: 130px;border: 0px solid #ccc;height: 30px;}
table tr th{height:30px;font-size:12px;padding:0px!important;line-height:30px!important;}
.seldiv {width:400;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
.user{
background-image: url(im/day.png);/*����Сͼ��*/
background-position: 5px 6px;/*Сͼ����input��λ��*/
background-repeat: no-repeat;/*����Сͼ�겻�ظ�*/
}
</STYLE>
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
if(isset($_POST['dt1']) and $_POST['dt1']!="")//�˴�������$_SESSION['DT1']��Ϊ�˲�Ӱ��������������
{
	$_SESSION['DT1']=$_POST['dt1'];
	$_SESSION['DT2']=$_POST['dt2'];
	$TJ=" and dh.lx=19 and dh.dhrq between '".$_POST['dt1']."' and '".$_POST['dt2']."' ";
}
else
	$TJ=" and dh.lx=19 and dh.dhrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
if(isset($_POST['khid']) and $_POST['khid']!="")
	$TJ.=" and unit.id in(".$_POST['khid'].") ";
if(isset($_POST['zhuz']) and $_POST['zhuz']!="")
	$TJ.=" and dh.pinz='".$_POST['zhuz']."' ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and unit.shortname+dh.dh+dh.lury like '%".$_POST['cxtj']."%' ";
if(isset($_POST['setsh']) and $_POST['setsh']!=100)//�������
{
	$query="update sys_shengz set zt=".$_POST['setsh'].",shr='".$_SESSION['uname']."' where id in(select dh.id from sys_shengz dh,sys_unit unit where dh.unit=unit.id and dh.lx=19 ".$TJ.")";
	require("inc/xexec.php");
}
if(isset($_POST['paix']) and $_POST['paix']!="") $px=$_POST['paix']; else $px="dh.dhrq desc,dh.id";
$menuright=menuright(27);//ȡ�ò˵�Ȩ��
if($menuright==3)
{
	$_SESSION['mac']="select dh.id,gs.fenlmc,CONVERT(varchar(10),dh.dhrq,120) as dhrq,unit.shortname,dh.dh,cp.mc,dh.tous,dh.daohzl,dh.chucj,dh.jine,dh.ssje,dh.beiz,dh.lury,case dh.zt when 0 then '<a href=javascript:sh('+cast(dh.id as varchar(10))+')>δ��</a>' when 1 then '<a href=javascript:sh('+cast(dh.id as varchar(10))+')><font color=red>�����</font></a>' end as zt,'<input id=\"c1\" type=\"button\" data-clipboard-target=\"p1\" class=\"btn radius user\" value=\"\">' as dy,'<a href=javascript:ed('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')><img border=0 src=im/xiug.png alt=�޸Ĵ˵�></a>' as xg,'<a href=javascript:del('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')><img border=0 src=im/shanc.png alt=ɾ���˵�></a>' as sc from sys_shengz dh,sys_unit unit,sys_cp cp,sys_maozfd gs where dh.gongsid=gs.id and dh.pinz=cp.id and dh.unit=unit.id ".$TJ." order by ".$px;
	$_SESSION['mac'].="#"."5,0,0,0,0,0,1,1,0,1,1,0,0,0,0,0,0";//1��ʾ�������к󵯳���ϸ����
	$_SESSION['mac'].="#".",6%,7%,8%,7%,6%,8%,8%,8%,8%,8%,6%,6%,6%,4%,2%,2%";
}
else
{
	$_SESSION['mac']="select dh.id,gs.fenlmc,CONVERT(varchar(10),dh.dhrq,120) as dhrq,unit.shortname,dh.dh,cp.mc,dh.tous,dh.daohzl,dh.chucj,dh.jine,dh.ssje,dh.beiz,dh.lury,case dh.zt when 0 then 'δ��' when 1 then '<font color=red>�����</font>' end as zt,'<input id=\"c1\" type=\"button\" data-clipboard-target=\"p1\" class=\"btn radius user\" value=\"\">' as dy,'<a href=javascript:ed('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')><img border=0 src=im/xiug.png alt=�޸Ĵ˵�></a>' as xg,'<a href=javascript:del('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')><img border=0 src=im/shanc.png alt=ɾ���˵�></a>' as sc from sys_shengz dh,sys_unit unit,sys_cp cp,sys_maozfd gs where dh.gongsid=gs.id and dh.pinz=cp.id and dh.unit=unit.id ".$TJ." order by ".$px;
	$_SESSION['mac'].="#"."5,0,0,0,0,0,1,1,0,1,1,0,0,0,0,0";//1��ʾ�������к󵯳���ϸ����
	$_SESSION['mac'].="#".",6%,7%,8%,7%,6%,8%,8%,8%,8%,8%,6%,6%,6%,4%,2%,2%";
}
$_SESSION['mac'].="#".",center,center,center,center,right,right,right,right,right,center,center,center,center,center,center";
$_SESSION['mac'].="#".",����,�ͻ�,����,����,ͷ��,����,����,���۽��,ʵ�ս��,��ע,�Ƶ���,״̬,��ӡ,��,ɾ";
$_SESSION['mac'].="#ë�����۵�";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
require("./inc/xdis2.php");
?>
</body>
<script type="text/javascript" src="inc/ZeroClipboard.js"></script>
<script type="text/javascript">
var clip1= null;
clip1 = new ZeroClipboard.Client();
clip1.setHandCursor(true);
clip1.setText('<?php echo $_REQUEST['dhid'];?>;p11.fr3;1;0;1;=)(=');
clip1.glue('c1');
</script>
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
		layer_show3("�޸�ë�����۵�","<?php echo $xiam;?>Edit.php?id="+id,"450","720","parent");//���һ���Ǹ���ʶ��  ��Ҫ�����򿪾͸�  ��Ȼ�Ϳ�
	}
}
function dy(id)
{
	openwindow('I_ShengzSellPrint.php?id='+id,700,500);
}
</script>
<script type="text/javascript" defer="defer">setscroll();closeload();</script>
