<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<head>
<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" /><!--$lur��ʾģ��-->
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<body >
<?php
$menuright=menuright(7);//ȡ�ò˵�Ȩ��
$tit='�������� <span class="c-gray en">&gt;</span> ��������';
$lur='<div class="text-c"><input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:250px" placeholder="����ؼ���ģ������" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="Cs_Cp.php"  class="btn radius"> ��Ʒ����</a> 
<a href="Cs_CpFenl.php"  class="btn radius"> һ������</a> 
<a href="Cs_CpDafl.php"  class="btn radius"><img border=0 src=im/zhuy.png> ��������</a> 
<a href="Cs_CpSw.php"  class="btn radius"> ��������</a> 
<a href="Cs_Cpxis.php"  class="btn radius">�ӹ�ϵ��</a> </span> ';
if($menuright>1)//¼��
	$lnk.='<span class="r"><a onclick="layer_show2(\'��������--��������\',\''.$xiam.'Add.php\',\'800\',\'700\')" class="btn radius"><img border=0 src=im/add.png> ��ӷ���</a> <a href="xExcel_NoCountdis.php"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="��ӡ��ҳ����" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
else
	$lnk.='<span class="r"><a href="xExcel_NoCountdis.php"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="��ӡ��ҳ����" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
$cha='';
$lie=",��,һ������,���,��������,����Ʒ��,����,��";
$wid=",10%,25%,10%,25%,20%,6%,4%";
$tis="!";
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php",$tis,$xuh,$yul);
?>
</body>

