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
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}</style>
<?php
$tit='查询统计 <span class="c-gray en">&gt;</span> 客户订货统计 <span class="c-gray en">&gt;</span> 按产品汇总';
$lur='<div class="text-c">';
$lur.=require('Q_Sell-.php');
$lur.='<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> 按产品汇总</a>
<a href="Q_Bianzjh.php"  class="btn radius"> 边猪统计</a>
<a href="javascript:openwindow2(\'Q_Yudtj_b.php\',window.screen.availWidth,window.screen.availHeight)" class="btn radius"> 订货汇总表</a> </span>';
$lnk.='<span class="r"> <a href="xExcel3.php" class="btn radius"><img border=0 src=im/daoc.png>导出</a> <a href="xExcel4.php" class="btn radius"><img border=0 src=im/daoc.png>导出无小计</a> <a href="javascript:openwindow(\'xPrint.php\',850,500)" class="btn radius"><img border=0 src=im/dy.png>打印</a> </span> ';
$cha='';
$lie=',标准品名,单位,订货量,客户,客户品名,规格,单位,订货量,备注';
$wid=',15%,4%,10%,20%,15%,6%,4%,10%,16%';
$xuh=',2,3,4,5,6,7';
$tis='点击列名可按对应列排序!';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language="javascript">
window.Frm.cxtj.focus();
</script>
