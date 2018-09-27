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
$tit='查询统计 <span class="c-gray en">&gt;</span> 销售查询 <span class="c-gray en">&gt;</span> 销售单据';
$lur='<div class="text-c">';
$lur.=require('Q_Sell-.php');
$lur.='<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="Q_Sell.php"  class="btn radius"><img border=0 src=im/zhuy.png> 销售单据</a> 
<a href="Q_Sella.php"  class="btn radius"> 销售明细1</a> 
<a href="Q_Selle.php"  class="btn radius"> 销售明细2</a> 
<a href="Q_Sellb.php"  class="btn radius"> 按商品汇总</a> 
<a href="Q_Sellk.php"  class="btn radius"> 客户明细</a> 
<a href="Q_Sellc.php"  class="btn radius"> 客户汇总</a> 
<a href="Q_Selld.php"  class="btn radius"> 按日汇总</a> </span>';
$lnk.='<span class="r"> <a href="xExcel.php" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a href="javascript:openwindow(\'xPrint.php\',850,500)" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
$lie=',单号,编号,客户名称,备注,日期,订货量,送货量,实收量,差量,实收金额,状态';
$wid=',8%,8%,15%,21%,8%,6%,6%,6%,6%,10%,6%';
$xuh=',2,3,4,5,6,7,8,9,10,11,12';
$tis='<font color=red>点击单号可弹出所选单明细情况，点击列标题可按对应列排序!';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language="javascript">
window.Frm.cxtj.focus();
</script>
