<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<html>
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
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<script language="javascript">
var timesi=0;//window.event.clientX;�˴�������������˵���������
function show(){document.getElementById("menu1").style.display="block";
if(timesi==0){document.getElementById("menu1").style.left=document.getElementById("menu1").offsetLeft*1-60;timesi=1;}}
function hide(){document.getElementById("menu1").style.display="none";}
</script>
</head>
<body>
<?php
$menuright=menuright(27);//ȡ�ò˵�Ȩ��
$tit='ë��ҵ�� <span class="c-gray en">&gt;</span> ë������';
$lur='<div class="text-c"><input name="setsh" type="hidden" value="100">
���ڷ�Χ��<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.$_SESSION['DT1'].'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.$_SESSION['DT2'].'"/>
<input id="khid" name="khid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="khmc" name="khmc" value="�ͻ�ѡȡ" readonly  onclick="layer_show2(\'�ͻ�ѡȡ\',\'Select_Kh_Md.php\',\'700\',\'600\')">
<select class="select-box" style="width:65px;height:31px;text-align:center;" name="zt"><option value="">-״̬-</option><option value="1">����</option><option value="0">δ��</option></select>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="����ؼ��ֲ���" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> ë������</a></span>';
$lnk.='<span class="r">';
if($menuright>2)//¼��
$lnk.='<div onMouseMove="show()" onMouseOut="hide()" style="background:#01121ff" class="btn radius">������˨�<br>
    <div id="menu1" style="position:absolute;display:none;margin-top:6px;margin-left:20px;width:130;text-align:left;line-height:25px;background-color:#ffffff;border:1px solid #3980AF">
     <a href="javascript:s_all(1)"><font color=blue>���б������ͨ��</a><br>
     <a href="javascript:s_all(0)"><font color=blue>���б���˲���</a></div></div> ';
$lnk.='<a onclick="Add()" class="btn radius"><img border=0 src=im/add.png> �������۵�[F9]</a> '; 
$lnk.='<a onclick="Tis();" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a onclick="Tis();" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
$cha='';
$lie=',�ֵ�,����,�ͻ�,����,����,ͷ��,����,����,���۽��,ʵ�ս��,��ע,�Ƶ���,״̬,��ӡ,��,ɾ';
$wid=',6%,7%,8%,7%,6%,8%,8%,8%,8%,8%,6%,6%,6%,4%,2%,2%';
$tis='��������ɰ���Ӧ������!';
$xuh=',,3,4,5,6,7,8,9,10,11,12';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
</html>
<script language ="javascript">
window.Frm.cxtj.focus();
function Add()
{
	layer_show2('����ë�����۵�','<?php echo $xiam;?>Add.php','450','720'); //���һ�������Ǹ�һ����ʶ�� 
} 
</script>
