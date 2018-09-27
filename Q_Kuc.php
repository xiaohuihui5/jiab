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
$tit='库存查询 <span class="c-gray en">&gt;</span> 库存数据';
$lur='<div class="text-c">
日期选择：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/>
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>
<input id="cpflid" name="cpflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpflmc" name="cpflmc" value="产品分类选取" readonly onclick="layer_show2(\'产品分类选取\',\'Select_CpFl_Md.php\',\'700\',\'650\')">  
<input id="cpid" name="cpid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpmc" name="cpmc" value="产品选取" readonly  onclick="layer_show2(\'产品选取\',\'Select_Cp_Md.php\',\'700\',\'600\')">
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> 库存数据</a></span>';
$lnk.='<span class="r"><a href="javascript:exc();"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a></span>'; 
$cha='';
$lie=',序,产品编码,产品名称,单位,期初库存,本期入库,本期出库,期末库存,库存金额';
$wid=',5%,10%,15%,10%,12%,12%,12%,12%,12%';
$xuh='';
$tis='<font color=red>点击单号可弹出所选单明细情况，点击列标题可按对应列排序!';
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