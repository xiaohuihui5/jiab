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
</head>
<body>
<?php
$tit='查询统计 <span class="c-gray en">&gt;</span> 毛猪存栏';
$lur='<div class="text-c">
昨日：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/> 
今日：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> 毛猪存栏</a></span>';
$lnk.='<span class="r"><a href="javascript:exc();"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a></span>'; 
$cha='';
$lie=',品种,昨日存栏,本期采购,本期销售,本期生产,今日存栏,头均重/公斤,总重,均价,存栏金额';
$wid=',10%,10%,10%,10%,10%,10%,10%,10%,10%,10%';
$xuh=',,';
$tis='<font color=red>“昨日”日期要选择有毛猪盘点的日期</font>';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php",$tis,$xuh,$yul);
?>
</body>
</html>
