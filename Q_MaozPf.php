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
<body>
<?php
$menuright=menuright(75);//取得菜单权限
$tit='查询统计 <span class="c-gray en">&gt;</span> 毛猪销售';
$lur='<div class="text-c">销售日期：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>至<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>';
$lur.=' <input id="cpid" name="cpid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpmc" name="cpmc" value="猪种选取" readonly  onclick="layer_show2(\'猪种选取\',\'Select_Cp_Md.php\',\'700\',\'600\')"> <input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/> <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> 毛猪销售统计表</a> </span>';
$lnk.='<span class="r"> <a href="xExcel.php" class="btn radius"><img border=0 src=im/daoc.png>导出</a> <a href="javascript:openwindow(\'xPrint.php\',850,500)" class="btn radius"><img border=0 src=im/dy.png>打印</a> </span> ';
$cha='';
$lie=',日期,销售客户,猪种,头数,重量,销售单价,到场均价,销售金额,成本金额,毛利额,毛利率,备注';
$wid=',8%,15%,6%,6%,8%,8%,8%,8%,8%,8%,7%,10%';
$xuh=',2,3,4,5,6,7,8,9,10,11,12';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
</html>
<script lanuage ="javascript">window.Frm.cxtj.focus();</script>
