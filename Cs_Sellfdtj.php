<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<head>
<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script language="javascript" src="./inc/xmy.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="inc/rank.js"></script>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;if(nKeyCode==120) {Add();}}</script>
</head>
<body >
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<?php
$menuright=menuright(20);//ȡ�ò˵�Ȩ��
$tit='�������� <span class="c-gray en">&gt;</span> �������ۼ۸�';
$lur='<div class="text-c"><input id="khflid" name="khflid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="khflmc" name="khflmc" value="�ͻ�����" readonly  onclick="layer_show2(\'�ͻ�����ѡȡ\',\'Select_KhFl_Md.php\',\'700\',\'600\')"/><input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="����ؼ��ֲ���" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="Cs_Sellfljg.php"  class="btn radius"> ���������</a> <a href="Cs_Sellfdjg.php"  class="btn radius"> ���ͻ����</a> <a href="Cs_Sellfdtj.php"  class="btn radius"><img border=0 src=im/zhuy.png> ���ͻ��ؼ�</a></span>';
$lnk.='<span class="r">';
if($menuright>1)//¼��
$lnk.='<a onclick="Add()" class="btn radius"><img border=0 src=im/add.png> �����۸��[F9]</a> '; 
$lnk.='<a onclick="Tis();" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a onclick="Tis();" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
$cha='';
if($menuright>1)//����Ȩ��
{
	$lie=",��,����,�Ƶ�����,�ͻ�����,��������,��������,�Ƶ�,��ע,��,��,ɾ";
	$wid=",4%,11%,10%,20%,10%,10%,6%,16%,5%,4%,4%";
}
else
{
	$lie=",��,����,�Ƶ�����,�ͻ�����,��������,��������,�Ƶ���,��ע";
	$wid=",4%,15%,10%,21%,15%,15%,10%,10%";
}
$xuh=',,3,4,5,6,7,8';
$tis="<font color=red>����¼��ʱϵͳ���ͻ��ؼۡ��ͻ��۸񡢷���۸��Ⱥ�˳��ƥ��۸�.";
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language="javascript">
window.Frm.cxtj.focus();
function Add()
{
	layer_show2('�����ͻ����۱�','<?php echo $xiam;?>Add.php','500','500'); //���һ�������Ǹ�һ����ʶ�� 
} 
</script>
