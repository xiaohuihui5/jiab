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
function show(){document.getElementById("menu").style.display="block";
if(timesi==0){document.getElementById("menu").style.left=document.getElementById("menu").offsetLeft*1-60;timesi=1;}}
function hide(){document.getElementById("menu").style.display="none";}
</script>
</head>
<body>
<?php
$menuright=menuright(35);//ȡ�ò˵�Ȩ��
$tit='ë��ҵ�� <span class="c-gray en">&gt;</span> �ָ�ӹ�';
$lur='<div class="text-c">
���ڷ�Χ��<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>
<input id="gysid" name="gysid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="gysmc" name="gysmc" value="��Ӧ��ѡȡ" readonly  onclick="layer_show2(\'��Ӧ��ѡȡ\',\'Select_Gys_Md.php\',\'700\',\'600\')">
<select class="select-box" style="width:65px;height:31px;text-align:center;" name="zt"><option value="">-״̬-</option><option value="1">����</option><option value="0">δ��</option></select>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="����ؼ��ֲ���" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="I_Shengcjg.php"  class="btn radius"> �����ӹ�</a>
 <a href="I_Shengcjg_a.php"  class="btn radius"> �����ӹ�</a>
 <a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> �ָ�ӹ�</a>
</span>';
$lnk.='<span class="r">';
if($menuright>1)//¼��
$lnk.='<a onclick="Tis();" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a onclick="Tis();" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
$cha='';
$lie=',����,ʱ��,��Ӧ��,Ʒ��,�ָ������,�ָ������,����ͷ��,����,����,��ע,״̬,��';
$wid=',8%,4%,15%,6%,10%,10%,9%,9%,9%,12%,6%,2%';
$tis='';
$xuh=',2,3,4,5,6,7,8,9,10';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
</html>
