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
</head>
<body >
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<?php
$menuright=menuright(21);//ȡ�ò˵�Ȩ��
$tit='�������� <span class="c-gray en">&gt;</span> �ͻ�Ʒ��';
$lur='<div class="text-c">
<input id="khid" name="khid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="khmc" name="khmc" value="�ͻ�����ѡȡ" readonly  onclick="layer_show2(\'�ͻ�����ѡȡ\',\'select_khfenl_s.php\',\'500\',\'500\')">
<input id="cpid" name="cpid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpmc" name="cpmc" value="��Ʒѡȡ" readonly  onclick="layer_show2(\'��Ʒѡȡ\',\'Select_Cp_Md.php\',\'700\',\'600\')">
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="����ؼ��ֲ���" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> �ͻ�Ʒ��</a> </span> ';
$lnk.='<span class="r">';
if($menuright>1)//¼��
$lnk.='<a onclick="javascript:update1()" class="btn radius">���桾F8��</a> <a onclick="layer_show2(\'��ӿͻ�����Ʒ��\',\''.$xiam.'Add.php\',\'800\',\'800\')" class="btn radius"><img border=0 src=im/add.png> ��ͻ�����Ʒ��</a> 
<a onclick="layer_show(\'���ƿͻ�Ʒ��\',\''.$xiam.'Copy.php\',\'600\',\'500\')" class="btn radius"> ����Ʒ��</a> ';
$lnk.='<a href="xExcel_NoCountdis.php"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="��ӡ��ҳ����" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a>
</span> ';
$cha='';
if($menuright>1)//¼��Ȩ��
{
	$lie=',��,��������,�ͻ�Ʒ�����,�ͻ�Ʒ��,�ͻ�����,����,����ֵ,��λ,���,��׼Ʒ�����,��˾��Ʒ,��λ,ɾ';
	$wid=',3%,10%,8%,22%,13%,4%,4%,4%,7%,8%,9%,4%,4%';
}
else//��ѯȨ��
{
	$lie=',��,��������,�ͻ�Ʒ�����,�ͻ�Ʒ��,�ͻ�����,����,����ֵ,��λ,���,��׼Ʒ�����,��˾��Ʒ,��λ';
	$wid=',4%,9%,9%,18%,8%,4%,4%,10%,8%,10%,12%,4%';
}
$xuh=',,3,4,5,6';
$tis='<font color=red>��ѯʱ����Ʒ���ࡢ��Ʒ��������';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language=javascript>
function update1()//�ύ��ϸ����
{ 
	window.hqlist.Frm.submit();
	//javascript:location.replace(location.href);//����תˢ��
}
</script>