<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query="update sys_selljg set lx=-1*lx where lx>0 and id=".$_POST['delrow'];
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
<input type="hidden" name="khflid" value="<?php echo isset($_POST['khflid'])?$_POST['khflid']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<?php 
$TJ=" and a.lx=25 ";
if(isset($_POST['khflid']) and $_POST['khflid']!="")
	$TJ.=" and a.unitid in(".$_POST['khflid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and b.fenlmc like '%".$_POST['cxtj']."%' ";
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$TJ.=" and '".$_POST['dt1']."'<=erq and '".$_POST['dt2']."'>=brq ";
}
if(isset($_POST['paix']) and $_POST['paix']!="")//����
	$px=$_POST['paix'];
else
	$px="b.bianh";

$menuright=menuright(20);//ȡ�ò˵�Ȩ��
$macmac="select a.id,0,a.dh,CONVERT(varchar(10),a.dhrq,120),b.fenlmc,CONVERT(varchar(10),a.brq,120),CONVERT(varchar(10),a.erq,120),a.lury,a.beiz,
'<a href=javascript:cp('+cast(a.id as varchar(10))+')><img border=0 src=im/copy.png alt=���ƴ˵�></a>',
'<a href=javascript:ed('+cast(a.id as varchar(10))+')><img border=0 src=im/xiug.png alt=�޸Ĵ˵�></a>' as xg,
'<a href=javascript:del('+cast(a.id as varchar(10))+')><img border=0 src=im/shanc.png alt=ɾ���˵�></a>' as sc
 from sys_selljg a,sys_khfenl b where b.id=a.unitid ".$TJ." order by ".$px;
if($menuright>1)//¼��Ȩ��
{
$macmac.="#"."11,1,1,1,1,1,1,1,1,0,0,0";//�˴�1��ʾ�������к󵯳��༭��ϸ����
$macmac.="#".",4%,11%,10%,20%,10%,10%,6%,16%,5%,4%,4%";
}
else
{
$macmac.="#"."8,1,1,1,1,1,1,1,1";//�˴�1��ʾ�������к󵯳��༭��ϸ����
$macmac.="#".",4%,15%,10%,21%,15%,15%,10%,10%";
}
$macmac.="#".",center,center,center,left,center,center,center,center,center,center,center";
$macmac.="#".",��,����,�Ƶ�����,�ͻ���������,��ʼ����,��������,�Ƶ�,��ע,�����µ�,�޸�,ɾ��";
$macmac.="#���ͻ��������ۼ۸��";
$macmac.="#";
$macmac.="#";
include("./inc/xNoCountOneRowOpen.php");
?>
</form>	
</body>
<script language=javascript>
function mx(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	openwindow('<?php echo $xiam;?>Mx.php?dhid='+id,1200,768);
}
function ed(id)
{	
	window.Frm.scroll.value=document.body.scrollTop;
	layer_show3("�޸ķ��౨�۱�","<?php echo $xiam;?>Edit.php?dhid="+id,"400","400","parent");//���һ���Ǹ���ʶ��  ��Ҫ�����򿪾͸�  ��Ȼ�Ϳ�
}
function cp(id)
{	
	window.Frm.scroll.value=document.body.scrollTop;
	layer_show3("���Ʒ��౨�۱�","<?php echo $xiam;?>Copy.php?dhid="+id,"400","400","parent");//���һ���Ǹ���ʶ��  ��Ҫ�����򿪾͸�  ��Ȼ�Ϳ�
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

