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
$menuright=menuright(7);//ȡ�ò˵�Ȩ��
$tit='�������� <span class="c-gray en">&gt;</span> ��Ʒ����';
$lur='<div class="text-c">
<input id="cpflid" name="cpflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpflmc" name="cpflmc" value="һ������" readonly onclick="layer_show2(\'һ������ѡȡ\',\'Select_CpFl_Md.php\',\'700\',\'600\')">  
<input id="cpxlid" name="cpxlid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpxlmc" name="cpxlmc" value="��������" readonly onclick="layer_show2(\'��������ѡȡ\',\'Select_CpXl_Md.php\',\'700\',\'600\')">  
<input id="cpswid" name="cpylid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpylmc" name="cpylmc" value="��������" readonly onclick="layer_show2(\'��������ѡȡ\',\'Select_CpSw_Md.php\',\'700\',\'600\')"> 
<input id="cpid" name="cpid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpmc" name="cpmc" value="��Ʒѡȡ" readonly  onclick="layer_show2(\'��Ʒѡȡ\',\'Select_Cp_Md.php\',\'700\',\'600\')">
<select class="select-box" style="width:65px;height:31px;text-align:center;" name="zhuangt"><option value="">״̬</option><option value="0">ͣ��</option><option value="1">����</option></select>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="����ؼ��ֲ���" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="Cs_Cp.php" class="btn radius"><img border=0 src=im/zhuy.png> ��Ʒ����</a> 
<a href="Cs_CpFenl.php"  class="btn radius">һ������</a> <a href="Cs_CpDafl.php"  class="btn radius">��������</a>  
<a href="Cs_CpSw.php"  class="btn radius">��������</a>    
<a href="Cs_Cpxis.php"  class="btn radius">�ӹ�ϵ��</a> </span>';
$lnk.='<span class="r">';
if($menuright>1)//¼��
$lnk.='<a onclick="layer_show2(\'��Ʒ����--��Ӳ�Ʒ\',\''.$xiam.'Add.php\',\'600\',\'500\')" class="btn radius"><img border=0 src=im/add.png> ��Ӳ�Ʒ</a> '; 
$lnk.='<a href="xExcel_NoCountdis.php"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="��ӡ��ҳ����" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
$cha='';
if($menuright>1)//¼��Ȩ��
{
	$lie=',��,һ��,����,���,��Ʒ����,��λ,���,����,��������,ͼƬ,����,״̬,��';
	$wid=',3%,10%,10%,8%,15%,6%,8%,4%,10%,8%,8%,6%,4%';
}
else//��ѯȨ��
{
	$lie=',��,һ��,����,���,��Ʒ����,��λ,���,����,��������,ͼƬ,����,״̬';
	$wid=',3%,10%,10%,8%,19%,6%,8%,4%,10%,8%,8%,6%';
}
$xuh=',,3,4,5,6';
$tis='<font color=red>��ѯʱ����Ʒ���ࡢ��Ʒ��������';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
