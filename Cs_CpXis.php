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
$menuright=menuright(7);//取得菜单权限
$tit='基础资料 <span class="c-gray en">&gt;</span> 产品资料';
$lur='<div class="text-c">
<input id="cpswid" name="cpylid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpylmc" name="cpylmc" value="生产分类" readonly onclick="layer_show2(\'生产分类选取\',\'Select_CpSw_Md.php\',\'700\',\'600\')"> 
<input id="cpid" name="cpid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpmc" name="cpmc" value="产品选取" readonly  onclick="layer_show2(\'产品选取\',\'Select_Cp_Md.php\',\'700\',\'600\')">
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="Cs_Cp.php" class="btn radius"> 产品资料</a> 
<a href="Cs_CpFenl.php"  class="btn radius">一级分类</a> <a href="Cs_CpDafl.php"  class="btn radius">二级分类</a>  
<a href="Cs_CpSw.php"  class="btn radius">生产分类</a>    
<a href="Cs_Cpxis.php"  class="btn radius"><img border=0 src=im/zhuy.png> 加工系数</a> </span>';
$lnk.='<span class="r"><a href="xExcel_NoCountdis.php"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="打印当页数据" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
if($menuright>1)//录入权限
{
	$lie=',序,生产分类,编号,产品名称,单位,规格,加工系数,改';
	$wid=',5%,20%,10%,20%,10%,10%,20%,5%';
}
else//查询权限
{
	$lie=',序,生产分类,编号,产品名称,单位,规格,加工系数';
	$wid=',5%,20%,10%,20%,10%,10%,25%';
}
$xuh=',,3,4,5,6';
$tis='<font color=red>查询时按产品分类、产品代码排序';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
