<?php require('./inc/xhead.php');require('./inc/xpage_uplib.php');?>
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
</head>
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
</head>
<?php 
$tit='��ѯͳ�� <span class="c-gray en">&gt;</span> ë��ɹ�';
$lur='<div class="text-c">�ɹ����ڣ�<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>��<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>';
$lur.='  <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> ë��ɹ���</a> </span>';
$lnk.='<span class="r"> <a href="xExcel.php" class="btn radius"><img border=0 src=im/daoc.png>����</a> <a href="javascript:openwindow(\'xPrint.php\',850,500)" class="btn radius"><img border=0 src=im/dy.png>��ӡ</a> </span> ';
$cha='';
$lie=',����,��Ӧ��,Ʒ��,ͷ��,��������,��������,������,������,Ӧ�����,���ӷ�,�ܳɱ�,·��(KG/ͷ),����,��Ӧ�̵绰,���ƺ�/��ע';
$wid=',7%,8%,6%,4%,6%,6%,5%,5%,6%,7%,8%,8%,6%,8%,10%';
$xuh='';
$tis='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php",$tis,$xuh,$yul);
?>
</body>
</html>
