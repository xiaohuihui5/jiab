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
$menuright=menuright(8);//ȡ�ò˵�Ȩ��
$tit='�������� <span class="c-gray en">&gt;</span> �ͻ���·';
if($menuright>1)//¼��
	$lur='<div class="text-c">���:&nbsp;<input type="text" class="input-text" style="width:100px" id="bianh" name="bianh" onkeydown="if(event.keyCode==13){window.Frm.fenlmc.select();}else  if(event.keyCode==39){window.IFrm.fenlmc.select();}">&nbsp;�ͻ���·:&nbsp;<input type="text" class="input-text" style="width:150px"  id="fenlmc" name="fenlmc" onkeydown="if(event.keyCode==13){sub();}">&nbsp; <input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;����&nbsp;&nbsp;" onclick="sub();">';
else
	$lur='<div class="text-c"><input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="����ؼ��ֲ���" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="Cs_Kh.php"  class="btn radius"> �ͻ�����</a> 
<a href="Cs_KhLx.php"  class="btn radius"> �ͻ�����</a> 
<a href="Cs_KhFenl.php"  class="btn radius"> �ͻ�����</a> 
<a href="Cs_KhXianl.php"  class="btn radius"><img border=0 src=im/zhuy.png> �ͻ���·</a> 
<a href="Cs_CwFenl.php"  class="btn radius"> �������</a>  
</span>';
$lnk.=' <span class="r"><a href="xExcel_NoCountdis.php"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="��ӡ��ҳ����" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span>&nbsp;';
$cha='';
$lie=",��,���,�ͻ���·,���ͻ���,����,�޸�";
$wid=",10%,20%,50%,10%,5%,5%";
$tis="";
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php",$tis,$xuh,$yul);
?>
</body>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script lanuage ="javascript">
function sub()
{
	if($("input[name=fenlmc]").val()=="" || $("input[name=fenlmc]").val()==null)
	{
		parent.layer.msg('������ӡ���鲻��Ϊ��', {icon:2,time:1500});
		return false;
	}
	else
	{
		window.Frm.submit();
		window.Frm.reset();
		window.Frm.bianh.focus();
	}
}
window.Frm.bianh.focus();
</script>
