<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<head>
<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="inc/rank.js"></script>
<link rel="stylesheet" href="./inc/style.css" type="text/css">
</head>
<body>
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<?php
$menuright=menuright(8);//取得菜单权限
$tit='基础资料 <span class="c-gray en">&gt;</span> 客户资料';
$lur='<div class="text-c">
<input id="khjgid" name="khlxid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khlxmc" name="khlxmc" value="客户类型" readonly onclick="layer_show2(\'客户类型选取\',\'Select_KhLx_Md.php\',\'700\',\'600\')">  
<input id="khflid" name="khflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khflmc" name="khflmc" value="客户分类" readonly onclick="layer_show2(\'客户分类选取\',\'Select_KhFl_Md.php\',\'700\',\'600\')">  
<input id="khxlid" name="khxlid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khxlmc" name="khxlmc" value="客户线路" readonly onclick="layer_show2(\'客户线路选取\',\'Select_KhXl_Md.php\',\'700\',\'600\')">  
<input id="khid" name="khid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="khmc" name="khmc" value="客户选取" readonly  onclick="layer_show2(\'客户选取\',\'Select_Kh_Md.php\',\'700\',\'600\')">
<select class="select-box" style="width:65px;height:31px;text-align:center;" name="zhuangt"><option value="">状态</option><option value="0">停用</option><option value="1">启用</option></select>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/> <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="Cs_Kh.php"  class="btn radius"><img border=0 src=im/zhuy.png> 客户资料</a> 
<a href="Cs_KhLx.php"  class="btn radius"> 客户类型</a> 
<a href="Cs_KhFenl.php"  class="btn radius"> 客户分类</a> 
<a href="Cs_KhXianl.php"  class="btn radius"> 客户线路</a> 
<a href="Cs_CwFenl.php"  class="btn radius"> 财务分类</a>  
</span>';
$lnk.='<span class="r">';
if($menuright>1)//录入
$lnk.='<a onclick="layer_show2(\'新增客户资料\',\''.$xiam.'Add.php\',\'600\',\'730\')" class="btn radius"><img border=0 src=im/add.png> 添加客户</a> '; 
$lnk.='<a href="xExcel_NoCountdis.php"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="打印当页数据" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span>&nbsp;';
$cha='';
if($menuright>1)//区分权限
{
$lie=",序,客户分类,编号,客户简称,客户全称,客户线路,客户类型,打单价,打单位,日配送,微信号,状态,改";
$wid=",4%,10%,6%,14%,21%,10%,10%,4%,4%,4%,5%,4%,4%";
}
else
{
$lie=",序,客户分类,编号,客户简称,客户全称,客户线路,客户类型,打单价,打单位,日配送,微信号,状态";
$wid=",4%,10%,6%,14%,25%,10%,10%,4%,4%,4%,5%,4%";
}
$xuh=",,3,4,5,6,7,8,9,10,11,12,13";
$tis="<font color=red>点击状态列,可启用或禁用该客户,禁用后的客户在录入时不可见！系统使用的都是客户简称,故简称不能为空！";
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
