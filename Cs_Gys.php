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
$menuright=menuright(9);//ȡ�ò˵�Ȩ��
$tit='�������� <span class="c-gray en">&gt;</span> ��Ӧ������';
$lur='<div class="text-c">
<input id="gysid" name="gysid" type="hidden"><input type="text" class="input-text" style="width:80px;text-align:center;" id="gysmc" name="gysmc" value="��Ӧ��ѡȡ" readonly  onclick="layer_show2(\'��Ӧ��ѡȡ\',\'Select_Gys_Md.php\',\'700\',\'600\')"/>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="����ؼ��ֲ���" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="Cs_Gys.php"  class="btn radius"><img border=0 src=im/zhuy.png> ��Ӧ������</a>
<a href="Cs_GysFenl.php"  class="btn radius"> ��Ӧ�̷���</a> 
</span>';
$lnk.='<span class="r">';
if($menuright>1)//¼��
$lnk.='<a onclick="layer_show2(\'������Ӧ��\',\''.$xiam.'Add.php\',\'700\',\'600\')" class="btn radius"><img border=0 src=im/add.png> ������Ӧ��</a> '; 
$lnk.='<a href="xExcel_NoCountdis.php"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="��ӡ��ҳ����" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
$cha='';
if($menuright>1)//����Ȩ��
{
$lie=",��,����,���,��Ӧ������,��ϵ��,�绰,��ַ,����,״̬,��";
$wid=",4%,10%,6%,14%,8%,8%,38%,4%,4%,4%";
}
else
{
$lie=",��,����,���,��Ӧ������,��ϵ��,�绰,��ַ,����,״̬";
$wid=",4%,10%,6%,14%,8%,8%,42%,4%,4%";
}
$xuh=',,3,4,5,6,7,8,9,10,11';
$tis="<font color=red>���Ӧ�е�״̬,�����û���ö�Ӧ��Ӧ��,���ú�Ĺ�Ӧ����¼��Ͳ�ѯʱ���ɼ�";
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>