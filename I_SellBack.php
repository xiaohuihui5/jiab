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
$menuright=menuright(16);//ȡ�ò˵�Ȩ��
$tit='���۹��� <span class="c-gray en">&gt;</span> �����˻�¼��';
$lur='<div class="text-c">
���ڷ�Χ��<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>

<input id="khflid" name="khflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khflmc" name="khflmc" value="�ͻ�����" readonly onclick="layer_show2(\'�ͻ�����ѡȡ\',\'Select_KhFl_Md.php\',\'700\',\'600\')">  
<input id="khjgid" name="khxlid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khxlmc" name="khxlmc" value="�ͻ���·" readonly onclick="layer_show2(\'�ͻ���·ѡȡ\',\'Select_KhXl_Md.php\',\'700\',\'600\')">  
<input id="khid" name="khid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="khmc" name="khmc" value="�ͻ�ѡȡ" readonly  onclick="layer_show2(\'�ͻ�ѡȡ\',\'Select_Kh_Md.php\',\'700\',\'600\')">
<select class="select-box" style="width:65px;height:31px;text-align:center;" name="zt"><option value="">-״̬-</option><option value="1">����</option><option value="0,9">δ��</option></select>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="����ؼ��ֲ���" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> ��������</a> <a href="javascript:openwindow2(\''.$xiam.'_No.php\',500,680)" class="btn radius"> δ�µ��ͻ�</a></span>';
$lnk.='<span class="r">';
if($menuright>1)//¼��
$lnk.='<a onclick="Add()" class="btn radius"><img border=0 src=im/add.png> ���˻���[F9]</a> '; 
$lnk.='<a onclick="Tis();" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a onclick="Tis();" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
$cha='';
if($menuright>1)//����Ȩ��
{
	$lie=',��,����,�ͻ�����,��ע,�˻�����,�˻���,�˻����,�Ƶ���,״̬,��,ɾ';
	$wid=',4%,10%,16%,24%,10%,10%,10%,6%,4%,3%,3%';
}
else
{
	$lie=',��,����,�ͻ�����,��ע,�˻�����,�˻���,�˻����,�Ƶ���,״̬';
	$wid=',4%,10%,16%,24%,10%,10%,10%,9%,7%';
}
$xuh=',,3,4,5,6,7,8';
$tis='��������ɰ���Ӧ�����򣬵��Ӧ�пհ״��ɵ�����ϸ���롢�޸Ĵ���!';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language="javascript">
window.Frm.cxtj.focus();
function Add()
{
	layer_show2('���������˻���','<?php echo $xiam;?>Add.php','500','500'); //���һ�������Ǹ�һ����ʶ�� 
} 
</script>
