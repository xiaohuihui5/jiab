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
$tit='��ѯͳ�� <span class="c-gray en">&gt;</span> ���۲�ѯ <span class="c-gray en">&gt;</span> ���۵���';
$lur='<div class="text-c">';
$lur.=require('Q_Sell-.php');
$lur.='<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="����ؼ��ֲ���" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="Q_Sell.php"  class="btn radius"><img border=0 src=im/zhuy.png> ���۵���</a> 
<a href="Q_Sella.php"  class="btn radius"> ������ϸ1</a> 
<a href="Q_Selle.php"  class="btn radius"> ������ϸ2</a> 
<a href="Q_Sellb.php"  class="btn radius"> ����Ʒ����</a> 
<a href="Q_Sellk.php"  class="btn radius"> �ͻ���ϸ</a> 
<a href="Q_Sellc.php"  class="btn radius"> �ͻ�����</a> 
<a href="Q_Selld.php"  class="btn radius"> ���ջ���</a> </span>';
$lnk.='<span class="r"> <a href="xExcel.php" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a href="javascript:openwindow(\'xPrint.php\',850,500)" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
$cha='';
$lie=',����,���,�ͻ�����,��ע,����,������,�ͻ���,ʵ����,����,ʵ�ս��,״̬';
$wid=',8%,8%,15%,21%,8%,6%,6%,6%,6%,10%,6%';
$xuh=',2,3,4,5,6,7,8,9,10,11,12';
$tis='<font color=red>������ſɵ�����ѡ����ϸ���������б���ɰ���Ӧ������!';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language="javascript">
window.Frm.cxtj.focus();
</script>
