<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<head>
<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="inc/rank.js"></script>
<link rel="stylesheet" href="./inc/style.css" type="text/css">
</head>
<body>
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<?php
$menuright=menuright(8);//ȡ�ò˵�Ȩ��
$tit='�������� <span class="c-gray en">&gt;</span> �ͻ�����';
$lur='<div class="text-c">
<input id="khjgid" name="khlxid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khlxmc" name="khlxmc" value="�ͻ�����" readonly onclick="layer_show2(\'�ͻ�����ѡȡ\',\'Select_KhLx_Md.php\',\'700\',\'600\')">  
<input id="khflid" name="khflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khflmc" name="khflmc" value="�ͻ�����" readonly onclick="layer_show2(\'�ͻ�����ѡȡ\',\'Select_KhFl_Md.php\',\'700\',\'600\')">  
<input id="khxlid" name="khxlid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khxlmc" name="khxlmc" value="�ͻ���·" readonly onclick="layer_show2(\'�ͻ���·ѡȡ\',\'Select_KhXl_Md.php\',\'700\',\'600\')">  
<input id="khid" name="khid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="khmc" name="khmc" value="�ͻ�ѡȡ" readonly  onclick="layer_show2(\'�ͻ�ѡȡ\',\'Select_Kh_Md.php\',\'700\',\'600\')">
<select class="select-box" style="width:65px;height:31px;text-align:center;" name="zhuangt"><option value="">״̬</option><option value="0">ͣ��</option><option value="1">����</option></select>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="����ؼ��ֲ���" id=""  name="cxtj"/> <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="Cs_Kh.php"  class="btn radius"><img border=0 src=im/zhuy.png> �ͻ�����</a> 
<a href="Cs_KhLx.php"  class="btn radius"> �ͻ�����</a> 
<a href="Cs_KhFenl.php"  class="btn radius"> �ͻ�����</a> 
<a href="Cs_KhXianl.php"  class="btn radius"> �ͻ���·</a> 
<a href="Cs_CwFenl.php"  class="btn radius"> �������</a>  
</span>';
$lnk.='<span class="r">';
if($menuright>1)//¼��
$lnk.='<a onclick="layer_show2(\'�����ͻ�����\',\''.$xiam.'Add.php\',\'600\',\'730\')" class="btn radius"><img border=0 src=im/add.png> ��ӿͻ�</a> '; 
$lnk.='<a href="xExcel_NoCountdis.php"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="��ӡ��ҳ����" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span>&nbsp;';
$cha='';
if($menuright>1)//����Ȩ��
{
$lie=",��,�ͻ�����,���,�ͻ����,�ͻ�ȫ��,�ͻ���·,�ͻ�����,�򵥼�,��λ,������,΢�ź�,״̬,��";
$wid=",4%,10%,6%,14%,21%,10%,10%,4%,4%,4%,5%,4%,4%";
}
else
{
$lie=",��,�ͻ�����,���,�ͻ����,�ͻ�ȫ��,�ͻ���·,�ͻ�����,�򵥼�,��λ,������,΢�ź�,״̬";
$wid=",4%,10%,6%,14%,25%,10%,10%,4%,4%,4%,5%,4%";
}
$xuh=",,3,4,5,6,7,8,9,10,11,12,13";
$tis="<font color=red>���״̬��,�����û���øÿͻ�,���ú�Ŀͻ���¼��ʱ���ɼ���ϵͳʹ�õĶ��ǿͻ����,�ʼ�Ʋ���Ϊ�գ�";
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
