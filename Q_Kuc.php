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
$tit='����ѯ <span class="c-gray en">&gt;</span> �������';
$lur='<div class="text-c">
����ѡ��<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/>
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>
<input id="cpflid" name="cpflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpflmc" name="cpflmc" value="��Ʒ����ѡȡ" readonly onclick="layer_show2(\'��Ʒ����ѡȡ\',\'Select_CpFl_Md.php\',\'700\',\'650\')">  
<input id="cpid" name="cpid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpmc" name="cpmc" value="��Ʒѡȡ" readonly  onclick="layer_show2(\'��Ʒѡȡ\',\'Select_Cp_Md.php\',\'700\',\'600\')">
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="����ؼ��ֲ���" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> �������</a></span>';
$lnk.='<span class="r"><a href="javascript:exc();"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a></span>'; 
$cha='';
$lie=',��,��Ʒ����,��Ʒ����,��λ,�ڳ����,�������,���ڳ���,��ĩ���,�����';
$wid=',5%,10%,15%,10%,12%,12%,12%,12%,12%';
$xuh='';
$tis='<font color=red>������ſɵ�����ѡ����ϸ���������б���ɰ���Ӧ������!';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language="javascript">
function exc()
{
	window.location='Q_Kucexcel.php?dt1='+window.Frm.dt1.value+'&dt2='+window.Frm.dt2.value+'&cpflid='+window.Frm.cpflid.value+'&cpid='+window.Frm.cpid.value+'&cxtj='+window.Frm.cxtj.value;
}	
</script>