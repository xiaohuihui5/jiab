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
$tit='查询统计 <span class="c-gray en">&gt;</span> 采购查询 <span class="c-gray en">&gt;</span> 按日汇总';
$lur='<div class="text-c">';
$lur.=require('Q_Buy-.php');
$lur.='<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="Q_Buy.php"  class="btn radius"> 采购单据</a> 
<a href="Q_Buya.php"  class="btn radius"> 采购明细</a> 
<a href="Q_Buyb.php"  class="btn radius"> 按商品汇总</a> 
<a href="Q_Buyk.php"  class="btn radius"> 供应商明细</a> 
<a href="Q_Buyc.php"  class="btn radius"> 供应商汇总</a> 
<a href="Q_Buyd.php"  class="btn radius"><img border=0 src=im/zhuy.png> 按日汇总</a> </span>';
$lnk.='<span class="r"> <a href="xExcel.php" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a href="javascript:openwindow(\'xPrint.php\',850,500)" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
$lie=',日期,订货量,到货量,实收量,差量,实收金额';
$wid=',50%,10%,10%,10%,10%,10%';
$xuh=',2,3,4,5,6,7';
$tis='<font color=red>点击列标题可按对应列排序!';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script lanuage="javascript">
window.Frm.cxtj.focus();
</script>
